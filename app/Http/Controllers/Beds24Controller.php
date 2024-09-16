<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LogsController;
use App\Models\Booking;
use App\Models\Clients;
use App\Models\Permission;
use App\Models\PermissionRoles;
use App\Models\Products;
use App\Models\Role;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Beds24Controller extends BaseController
{

    public $apiEndPoint = 'https://api.beds24.com/v2/bookings?count=999';
    public $apiToken = 'fSNDZE8agMWzbjf7MUS/jPJ7YeHofQNqJ8q35XSiLWmkBUFisRDcY7EuKYZzLmalkbijyyn8ms3ldkXwl9ZjSsoOn+MuzOdJwa9+SRvsCBgfTLFFrsZWAHNIv8iZawLAoybwcu6BHPzeBljdOr3rT8UWV3Vt1HFckwkj3GPof5Y=';

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getBookings(Request $request)
    {
        $client = new Client();
        $responseToken = $client->request('GET', 'https://api.beds24.com/v2/authentication/token', [
            'headers' => [
                'Accept' => 'application/json',
                'refreshToken' => $this->apiToken,
            ],
            'verify' => false
        ]);

        $responseData = json_decode($responseToken->getBody()->getContents(), true);
        $token = $responseData['token'];

        $pageUrl = "https://api.beds24.com/v2/bookings?page=1"; // Start with the first page
        $allData = [];

        do {
            // Make a GET request to the API endpoint
            $response = $client->request('GET',  $pageUrl, [
                'headers' => [
                    'Accept' => 'application/json',
                    'token' =>  $token,
                ],

                'verify' => false
            ]);
            // Get the response body
            $responseBody = $response->getBody()->getContents();

            // Decode the JSON response
            $data = json_decode($responseBody, true);

            // Append the data to the array
            $allData = array_merge($allData, $data['data']);

            // Move to the next page
            $pageUrl =  $data['pages']['nextPageLink'];

            // Introduce a delay of 5 seconds between requests to stay within the credit limit
            sleep(5);
        } while ($pageUrl != null);

        foreach ($allData as $detail) {
            $customer = Customers::updateOrCreate([
                'name' =>  @$detail['firstName'] != '' ||  @$detail['lastName'] != '' ? @$detail['firstName'] . ' ' . @$detail['lastName'] : @$detail['title'],
                'email' => @$detail['email'],
                'phone_no' => @$detail['phone'] ?? @$detail['mobile'],
                'whatsapp_no' => @$detail['phone'] ?? @$detail['mobile'],
                'gender' => @$detail['gender'],
                'address' => @$detail['address'],
                'city' => @$detail['city'],
                'state' => @$detail['state'],
                'country' => @$detail['country'],
                'zip_code' => @$detail['postcode'],
                'relation_id' => @$detail['relation_id'] ?? null,
                'customer_head_id' => @$detail['customer_head_id'] ?? null,
                'customer_type_id' => @$detail['customer_type_id'] ?? 1,
                'customer_source' => @$detail['apiSource'] ?? 'faisal',
                'status' => 1,
            ]);

            $room = Products::where('unitId', $detail['unitId'])->where('product_category_id', 1)->first();

            $booking = Booking::updateOrCreate(['beds24_id' => @$detail['id']], [
                'booking_start' => Carbon::parse($detail['arrival']),
                'booking_end' => Carbon::parse($detail['departure']),
                'day_id' => @$detail['day_id'],
                'customer_id' => @$customer->id,
                'product_id' => @$room->id,
                'no_of_nights' => @$detail['no_of_nights'],
                'num_of_adults' => @$detail['numAdults'],
                'num_of_child' => @$detail['numChild'],
                'beds24_id' => @$detail['id'],
                'charges' => @$detail['price'],
                'discount' => $detail['discount'] ?? 0,
                'tax' => $detail['tax'] ?? 0,
                'comission' => @$detail['comission'],
                'total_amount' => @$detail['price'],
                'comment' => @$detail['comments'],
                'status' => 1,
            ]);
        }
        return redirect()->to('/booking')->with('success', "Booking Sync Successfully!");
    }

    public function index(Request $request, LogsController $logController)
    {
        try {
            $client = new Client();
            $responseToken = $client->request('GET', 'https://api.beds24.com/v2/authentication/token', [
                'headers' => [
                    'Accept' => 'application/json',
                    'refreshToken' => $this->apiToken,
                ],
                'verify' => false
            ]);

            $responseData = json_decode($responseToken->getBody()->getContents(), true);
            $token = $responseData['token'];

            $pageUrl = "https://api.beds24.com/v2/bookings?page=1"; // Start with the first page
            $allData = [];

            do {
                // Make a GET request to the API endpoint
                $response = $client->request('GET',  $pageUrl, [
                    'headers' => [
                        'Accept' => 'application/json',
                        'token' => $token,
                    ],

                    'verify' => false
                ]);
                // Get the response body
                $responseBody = $response->getBody()->getContents();

                // Decode the JSON response
                $data = json_decode($responseBody, true);

                // Append the data to the array
                $allData = array_merge($allData, $data['data']);

                // Move to the next page
                $pageUrl =  $data['pages']['nextPageLink'];

                // Introduce a delay of 5 seconds between requests to stay within the credit limit
                sleep(5);
            } while ($pageUrl != null);

            foreach ($allData as $detail) {
                $customer = Customers::updateOrCreate([
                    'name' =>  @$detail['firstName'] != '' ||  @$detail['lastName'] != '' ? @$detail['firstName'] . ' ' . @$detail['lastName'] : @$detail['title'],
                    'email' => @$detail['email'],
                    'phone_no' => @$detail['phone'] ?? @$detail['mobile'],
                    'whatsapp_no' => @$detail['phone'] ?? @$detail['mobile'],
                    'gender' => @$detail['gender'],
                    'address' => @$detail['address'],
                    'city' => @$detail['city'],
                    'state' => @$detail['state'],
                    'country' => @$detail['country'],
                    'zip_code' => @$detail['postcode'],
                    'relation_id' => @$detail['relation_id'] ?? null,
                    'customer_head_id' => @$detail['customer_head_id'] ?? null,
                    'customer_type_id' => @$detail['customer_type_id'] ?? 1,
                    'customer_source' => @$detail['apiSource'] ?? 'faisal',
                    'status' => 1,
                ]);
                $room = Products::where('unitId', $detail['unitId'])->where('product_category_id', 1)->first();
                // dd($rooom);

                $booking = Booking::updateOrCreate(['beds24_id' => $detail['id'] ? @$detail['id'] : null], [
                    'booking_start' => Carbon::parse($detail['arrival']),
                    'booking_end' => Carbon::parse($detail['departure']),
                    'day_id' => @$detail['day_id'],
                    'customer_id' => @$customer->id,
                    'product_id' => @$room->id,
                    'no_of_nights' => @$detail['no_of_nights'],
                    'num_of_adults' => @$detail['numAdults'],
                    'num_of_child' => @$detail['numChild'],
                    'beds24_id' => $detail['id'] ? @$detail['id'] : null,
                    'charges' => @$detail['price'],
                    'discount' => $detail['discount'] ?? 0,
                    'tax' => $detail['tax'] ?? 0,
                    'comission' => @$detail['comission'],
                    'total_amount' => @$detail['price'],
                    'comment' => @$detail['comments'],
                    'status' => 1,
                ]);
            }

            $bookings = Booking::all();

            $logController->createLog(__METHOD__, 'success', 'Navigated to Booking List.', auth()->user(), '');

            return view('booking.list', compact('data', 'bookings'));
        } catch (Exception $e) {
            dd($e);
            $logController->createLog(__METHOD__, 'success', 'Error Navigated to Booking List.', auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
