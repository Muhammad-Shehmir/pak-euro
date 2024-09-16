<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('charge/getById', [ApiController::class, 'getProductById']);
Route::post('currency/getById', [ApiController::class, 'getCurrencyById']);
Route::post('product/getByCategoryId', [ApiController::class, 'getProductsByCategoryId']);

// Bookings
Route::get('bookings', [ApiController::class, 'getBookings']);
Route::get('booking/{id}', [ApiController::class, 'getBookingById']);
Route::post('booking/save', [ApiController::class, 'storeBooking']);
Route::post('booking/update/{booking}', [ApiController::class, 'updateBooking']);
Route::post('booking/delete/{id}', [ApiController::class, 'deleteBooking']);
// Route::post('booking-detail/save', [ApiController::class, 'saveBookingStatus']);
// Route::get('booking-visits/{id}', [ApiController::class, 'getBookingVisitsById']);
// Route::post('booking-images/save/{booking}', [BookingController::class, 'addImages']);
Route::post('customer-status/save/{booking}', [ApiController::class, 'saveCustomerStatus']);
Route::get('/get-cities/{id}', [ApiController::class, 'getCityByCountryId']);

