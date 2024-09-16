<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\LogsController;
use App\Models\Account;
use App\Models\Appointment;
use App\Models\AppointmentStatus;
use App\Models\Booking;
use App\Models\Charge;
use App\Models\City;
use App\Models\Currencies;
use App\Models\Clients;
use App\Models\CustomerStatus;
use App\Models\DayMaster;
use App\Models\DentalQuadrantDetail;
use App\Models\DoctorTiming;
use App\Models\Patients;
use App\Models\PatientStatus;
use App\Models\Payments;
use App\Models\Procedure;
use App\Models\ProductCategories;
use App\Models\Products;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Currency;

class ApiController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $apiEndPoint = 'https://api.beds24.com/v2/bookings';
    public $apiToken = 'fSNDZE8agMWzbjf7MUS/jPJ7YeHofQNqJ8q35XSiLWmkBUFisRDcY7EuKYZzLmalkbijyyn8ms3ldkXwl9ZjSsoOn+MuzOdJwa9+SRvsCBgfTLFFrsZWAHNIv8iZawLAoybwcu6BHPzeBljdOr3rT8UWV3Vt1HFckwkj3GPof5Y=';

    public function getProductById(Request $request)
    {
        try {
            $charge = Charge::where('id', $request->charge_id)->first();

            return response()->json(['data' => $charge, 'status' => 200], 200);
        } catch (Exception $e) {

            return response()->json(['data' => $e, 'status' => 500], 500);
        }
    }

    public function getCurrencyById(Request $request)
    {
        try {
            $currency = Currencies::where('id', $request->currency_id)->first();

            return response()->json(['data' => $currency, 'status' => 200], 200);
        } catch (Exception $e) {

            return response()->json(['data' => $e, 'status' => 500], 500);
        }
    }

    public function getProductsByCategoryId(Request $request)
    {
        try {
            $products = Products::where('product_category_id', $request->product_category_id)->get();

            return response()->json(['data' => $products, 'status' => 200], 200);
        } catch (Exception $e) {

            return response()->json(['data' => $e, 'status' => 500], 500);
        }
    }

    public function getBookings()
    {
        try {
            $bookings = Booking::with('customer', 'product', 'day', 'customer_status')->get();

            $data = [
                'bookings' => $bookings,
            ];

            return response()->json(['data' => $data, 'status' => 200], 200);
        } catch (Exception $e) {

            return response()->json(['error' => $e, 'status' => 500], 500);
        }
    }

    public function getBookingById(Request $request, $id)
    {
        try {
            $bookings = Booking::with('customer', 'product', 'day', 'customer_status')->where('id', $id)->first();

            return response()->json(['data' => $bookings, 'status' => 200], 200);
        } catch (Exception $e) {

            return response()->json(['error' => $e, 'status' => 500], 500);
        }
    }

    public function storeBooking(Request $request, LogsController $logController)
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
    
            $booking = Booking::create([
                'booking_start' => Carbon::parse($request->booking_start),
                'booking_end' => Carbon::parse($request->booking_end),
                'day_id' => $request->day_id,
                'customer_id' => $request->customer_id,
                'product_id' => $request->product_id,
                'no_of_nights' => $request->no_of_nights,
                'num_of_adults' => $request->num_of_adults,
                'num_of_child' => $request->num_of_child,
                'charges' => $request->charges,
                'discount' => $request->discount,
                'tax' => $request->tax,
                'total_amount' => $request->amount,
                'comment' => $request->comment,
                'status' => 1,
            ]);


            $client = new Client();

            $product = Products::where('id', $request->product_id)->first();
            $customer = Client::where('id', $request->customer_id)->first();
            // Data to be sent in the POST request
            $data = [
                'roomId' => $product->roomId,
                'unitId' => $product->unitId,
                'arrival' => Carbon::parse($request->booking_start)->format('Y-m-d'),
                'departure' => Carbon::parse($request->booking_end)->format('Y-m-d'),
                'title' => $customer->name,
                'firstName' => $customer->name,
                'email' => $customer->email,
                'apiSource' => 'Resort-Management',
                'channel' => 'Resort-Management',
                'phone' => $customer->phone_no,
                'no_of_nights' => $request->no_of_nights,
                'numAdult' => $request->num_of_adults,
                'numChild' => $request->num_of_child,
                'price' => $request->price,
                'tax' => $request->tax,
                'comments' => $request->comment,
                'status' => "new",
                'bookingTime' => Carbon::now()->format('Y-m-d H:i:s'),
            ];
            $json_data = json_encode($data);
            // dd($json_data);

            $response = $client->request('POST', $this->apiEndPoint, [
                'headers' => [
                    'Accept' => 'application/json',
                    'token' => $token,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    [
                        'roomId' => $product->roomId,
                        'unitId' => $product->unitId,
                        'arrival' => Carbon::parse($request->booking_start)->format('Y-m-d'),
                        'departure' => Carbon::parse($request->booking_end)->format('Y-m-d'),
                        'title' => $customer->name,
                        'firstName' => $customer->name,
                        'email' => $customer->email,
                        'apiSource' => 'Resort-Management',
                        'channel' => 'Resort-Management',
                        'phone' => $customer->phone_no,
                        'no_of_nights' => $request->no_of_nights,
                        'numAdult' => $request->num_of_adults,
                        'numChild' => $request->num_of_child,
                        'price' => $request->price,
                        'tax' => $request->tax,
                        'comments' => $request->comment,
                        'status' => "new",
                        'bookingTime' => Carbon::now()->format('Y-m-d H:i:s'),
                    ]
                ],
                'verify' => false
            ]);

            // Get the response body
            $responseData = json_decode($response->getBody()->getContents(), true);

            $logController->createLog(__METHOD__, 'success', 'Booking Created.', auth()->user(), '');

            return response()->json(['data' => $booking, 'status' => 200], 200);
        } catch (Exception $e) {
            // dd($e);

            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return response()->json(['data' => $e, 'status' => 500], 500);
        }
    }

    public function updateBooking(Request $request, Booking $booking, LogsController $logController)
    {
        try {
            // dd($request->all());
            // dd($request->booking_end);
            $booking = Booking::where('id', $booking->id)->update([
                'booking_start' => Carbon::parse($request->booking_start),
                'booking_end' => Carbon::parse($request->booking_end),
                'day_id' => $request->day_id,
                'customer_id' => $request->customer_id,
                'product_id' => $request->product_id,
                'no_of_nights' => $request->no_of_nights,
                'num_of_adults' => $request->num_of_adults,
                'num_of_child' => $request->num_of_child,
                'charges' => $request->charges,
                'discount' => $request->discount,
                'tax' => $request->tax,
                'total_amount' => $request->amount,
                'comment' => $request->comment,
                'status' => 1,
            ]);

            $logController->createLog(__METHOD__, 'success', 'Appointment Updated.', auth()->user(), $booking);

            return response()->json(['data' => $booking, 'status' => 200], 200);
        } catch (Exception $e) {

            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), $booking);

            return response()->json(['data' => $e, 'status' => 200], 200);
        }
    }

    public function deleteBooking($id)
    {
        try {
            $booking = Booking::find($id);
            $booking->delete();

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

            $response = $client->request('POST', $this->apiEndPoint, [
                'headers' => [
                    'Accept' => 'application/json',
                    'token' => $token,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    [
                        'id' => $booking->beds24_id,
                        'status' => "cancelled",
                    ]
                ],
                'verify' => false
            ]);


            session()->flash('success', 'Booking Deleted Successfully!');

            return response()->json(['data' => $booking, 'status' => 200], 200);
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());

            return response()->json(['error' => $e, 'status' => 500], 500);
        }
    }

    public function saveCustomerStatus(Request $request, Booking $booking, LogsController $logController)
    {
        try {
            $customer_status = CustomerStatus::updateOrCreate(['booking_id' => $booking->id], [
                'booking_id' => $booking->id,
                'customer_status' => $request->status,
            ]);
            $logController->createLog(__METHOD__, 'success', 'Patient Status Updated.', auth()->user(), '');

            return response()->json(['data' => $customer_status, 'status' => 200], 200);
        } catch (Exception $e) {

            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return response()->json(['data' => $e, 'status' => 200], 200);
        }
    }

    public function getCityByCountryId($id)
    {
        $city = City::where('country_id', $id)->get();
        if ($city) {
            return response()->json([
                'data' => $city
            ], 200);
        } else {
            return response()->json(['error' => 'City not found'], 404);
        }
    }
}
