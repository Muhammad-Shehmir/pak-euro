<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Appointment;
use App\Models\AppointmentImages;
use App\Models\AppointmentStatus;
use App\Models\AppointmentStatusMaster;
use App\Models\Booking;
use App\Models\Clients;
use App\Models\DayMaster;
use App\Models\Patients;
use App\Models\Payments;
use App\Models\Procedure;
use App\Models\Products;
use App\Models\Quote;
use App\Models\QuoteDetail;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BookingController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, LogsController $logController)
    {
        // dd($request->all());
        try {

            $customers = Customers::all();

            $products = Products::where('status', 1)->where('product_category_id', 1)->get();

            $days = DayMaster::all();

            $logController->createLog(__METHOD__, 'success', 'Navigated to Appointment Index.', auth()->user(), '');

            return view('booking.index', compact('customers', 'products', 'days'));
        } catch (Exception $e) {

            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return view('booking.index')->with('error', $e->getMessage());
        }
    }
    public function RoomAvailabilityindex(Request $request, LogsController $logController)
    {
        try {
            $product_id = $request->product_id;
            $date_from = $request->filled('date_from') ? Carbon::parse($request->date_from)->startOfDay() : Carbon::now()->startOfDay();
            $date_to = $request->filled('date_to') ? Carbon::parse($request->date_to)->endOfDay() : Carbon::now()->endOfDay();
            $allproducts = Products::where('status', 1)->where('product_category_id', 1)->get();
            $query = Products::where('status', 1)->where('product_category_id', 1);

            if ($product_id) {
                $query->where('id', $product_id);
            }

            $products = $query->get();

            $availability = [];
            $bookingDates = [];

            foreach ($products as $product) {
                // Query the database for overlapping bookings for this specific room
                $overlapBooking = Booking::where('product_id', $product->id)
                    ->where(function ($query) use ($date_from, $date_to) {
                        $query->where(function ($query) use ($date_from, $date_to) {
                            $query->where('booking_start', '<=', $date_from)
                                ->where('booking_end', '>=', $date_from);
                        })->orWhere(function ($query) use ($date_from, $date_to) {
                            $query->where('booking_start', '<=', $date_to)
                                ->where('booking_end', '>=', $date_to);
                        });
                    })->first();

                // Determine availability status for this room
                if ($overlapBooking) {
                    $availability[$product->id] = 'Booked';
                    $bookingDates[$product->id] = [$overlapBooking->booking_start, $overlapBooking->booking_end];
                } else {
                    $availability[$product->id] = 'Available';
                    $bookingDates[$product->id] = null;
                }
            }
            
            $logController->createLog(__METHOD__, 'success', 'Navigated to Room Availability Index.', auth()->user(), '');

            return view('booking.room_availability', compact('products', 'product_id', 'date_from', 'date_to', 'availability', 'bookingDates','allproducts'));
        } catch (Exception $e) {
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');
            return view('booking.index')->with('error', $e->getMessage());
        }
    }

    public function addFromQuote(Request $request, LogsController $logController)
    {
        try {
            // Retrieve the selected product ID from the request
            $productId = $request->input('product_id');
            // dd($productId);
            // dd($request->quote_id);
            $customers = Customers::all();
            $products = Products::where('status', 1)->where('product_category_id', 1)->get();
            $days = DayMaster::all();
            $quote = Quote::findOrFail($request->quote_id);
            $groupDetails = QuoteDetail::where('quote_id', $quote->id)->where('product_id', $productId)->get();
            // dd($groupDetails);

            $logController->createLog(__METHOD__, 'success', 'Navigated to Booking Form.', auth()->user(), '');

            return view('booking.add_from_quote', compact('products', 'customers', 'quote', 'groupDetails', 'days'));
        } catch (Exception $e) {

            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return view('booking.add_from_quote')->with('error', $e->getMessage());
        }
    }

    public function storeBooking(Request $request, LogsController $logController)
    {
        try {

            // Convert booking start and end dates to Carbon instances
            $bookingStart = Carbon::parse($request->booking_start);
            $bookingEnd = Carbon::parse($request->booking_end);

            // Check if there are any bookings that overlap with the requested dates
            $overlappingBookings = Booking::where('product_id', $request->product_id)
                ->where(function ($query) use ($bookingStart, $bookingEnd) {
                    $query->where(function ($q) use ($bookingStart, $bookingEnd) {
                        $q->where('booking_start', '<', $bookingEnd)
                            ->where('booking_end', '>', $bookingStart);
                    })
                        ->orWhere(function ($q) use ($bookingStart, $bookingEnd) {
                            $q->where('booking_start', '>=', $bookingStart)
                                ->where('booking_start', '<', $bookingEnd);
                        })
                        ->orWhere(function ($q) use ($bookingStart, $bookingEnd) {
                            $q->where('booking_end', '>', $bookingStart)
                                ->where('booking_end', '<=', $bookingEnd);
                        });
                })
                ->exists();

            if ($overlappingBookings) {
                // Room is not free, show an alert
                return response()->json([
                    'success' => false,
                    'message' => 'Booking already exists for this Date.',
                    'status' => 200,
                ], 200);
            } else {
                // Room is free, create the booking
                $booking = Booking::create([
                    'booking_start' => $bookingStart,
                    'booking_end' => $bookingEnd,
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

                $logController->createLog(__METHOD__, 'success', 'Booking Created.', auth()->user(), '');
                // return response()->json([
                //     'success' => true,
                //     'message' => 'Booking created successfully'], 200);
                // Set success message in session flash
                Session::flash('success', 'New Booking Created Successfully!');

                return response()->json([
                    'success' => true,
                    'message' => 'Booking Created Succesfully!',
                    'status' => 200, // Pass rejected record data
                ], 200);

                // return redirect()->to('/booking')->with('success', 'New Booking Created SuccessFully!');
            }
        } catch (Exception $e) {
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'status' => 200, // Pass rejected record data
            ], 200);
        }
    }
}
