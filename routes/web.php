<?php

use App\Http\Controllers\AccountTypeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CustomerSourceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\ReferralHospitalController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaxesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Beds24Controller;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ChartsOfAccountController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CustomersProfileController;
use App\Http\Controllers\DentalDiseasesController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\DoctorTimingController;
use App\Http\Controllers\ExpenseCategoriesController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ShipperController;
use App\Http\Controllers\HealthRecordController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RecieptController;
use App\Http\Controllers\LabOfTrackingController;
use App\Http\Controllers\LabTrackingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PatientProfileController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\ReceiptPayementController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SecurityDetailController;
use App\Http\Controllers\TreatmentPlanController;
use App\Http\Controllers\UserController;
use App\Models\Account;
use App\Models\Expenses;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [AuthController::class, 'login'])->name('login');

Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/reset', function () {
    return view('auth.reset');
});
Route::get('/forgot', function () {
    return view('auth.forgot');
});

//register
// Route::post('/create', [AuthController::class, 'create'])->name('create');
Route::post('/check', [AuthController::class, 'check'])->name('check');
// Route::get('/verify', [AuthController::class, 'verify'])->name('verify');

//forgot password
Route::get('/password/forgot', [AuthController::class, 'showForgotForm'])->name('forgot.password.form');
Route::post('/password/forgot', [AuthController::class, 'sendResetLink'])->name('forgot.password.link');
Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('reset.password.form');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('reset.password');

//logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);

//patient
Route::get('/client', [ClientController::class, 'index']);
Route::get('/client/add', [ClientController::class, 'add']);
Route::post('/client/add', [ClientController::class, 'store']);
Route::get('/client/edit/{client}', [ClientController::class, 'edit']);
Route::post('/client/edit/{client}', [ClientController::class, 'update'])->name('client.update');
Route::post('/client/delete/{id}', [ClientController::class, 'delete']);

//products
Route::get('/charges', [ChargeController::class, 'index']);
Route::get('/charges/add', [ChargeController::class, 'add']);
Route::post('/charges/add', [ChargeController::class, 'store'])->name('charges.store');
Route::get('/charges/edit/{charge}', [ChargeController::class, 'edit']);
Route::post('/charges/edit/{charge}', [ChargeController::class, 'update'])->name('charges.update');
Route::post('/charges/delete/{id}', [ChargeController::class, 'delete']);

//product categories
Route::get('/product-categories', [ProductCategoryController::class, 'index']);
Route::get('/product-category/add', [ProductCategoryController::class, 'add']);
Route::post('/product-category/add', [ProductCategoryController::class, 'store']);
Route::get('/product-category/edit/{productCategory}', [ProductCategoryController::class, 'edit']);
Route::post('/product-category/edit/{productCategory}', [ProductCategoryController::class, 'update']);
Route::post('/product-category/delete/{id}', [ProductCategoryController::class, 'delete']);

//customer Source
Route::get('/customer-source', [CustomerSourceController::class, 'index']);
Route::get('/customer-source/add', [CustomerSourceController::class, 'add']);
Route::post('/customer-source/add', [CustomerSourceController::class, 'store']);
Route::get('/customer-source/edit/{id}', [CustomerSourceController::class, 'edit']);
Route::post('/customer-source/edit/{id}', [CustomerSourceController::class, 'update']);
Route::post('/customer-source/delete/{id}', [CustomerSourceController::class, 'delete']);

//user
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/add', [UserController::class, 'add']);
Route::post('/user/add', [UserController::class, 'store']);
Route::get('/user/edit/{user}', [UserController::class, 'edit']);
Route::post('/user/edit/{user}', [UserController::class, 'update']);
Route::post('/user/delete/{id}', [UserController::class, 'delete']);
Route::post('/user/toggleStatus/{user}', [UserController::class, 'toggleStatus']);

//role id
Route::get('/role', [RoleController::class, 'index']);
Route::get('/role/add', [RoleController::class, 'add']);
Route::post('/role/add', [RoleController::class, 'store']);
Route::get('/role/edit/{role}', [RoleController::class, 'edit']);
Route::post('/role/edit/{role}', [RoleController::class, 'update']);
Route::post('/role/delete/{id}', [RoleController::class, 'delete']);

//appointment
Route::get('/booking', [BookingController::class, 'index']);
Route::get('/room-availability', [BookingController::class, 'RoomAvailabilityindex']);
Route::post('/booking/create-from-quote', [BookingController::class, 'addFromQuote']);
Route::post('/booking/store', [BookingController::class, 'storeBooking']);

//customer profile
Route::get('/client-profile/{customer}', [CustomersProfileController::class, 'index']);
Route::get('/client-ledger/{id}', [CustomersProfileController::class, 'pdf']);
Route::get('/sec-ledger/{id}', [CustomersProfileController::class, 'secLedgerPdf']);

//message
Route::get('/message', [MessageController::class, 'index']);

//quote
Route::get('/quote', [QuoteController::class, 'index']);
Route::get('/quote/add', [QuoteController::class, 'add']);
Route::post('/quote/add', [QuoteController::class, 'store']);
Route::get('/quote/edit/{id}', [QuoteController::class, 'edit']);
Route::post('/quote/edit/{quote}', [QuoteController::class, 'update']);
Route::get('/quote/preview/{id}', [QuoteController::class, 'preview']);
Route::get('/quote/pdf/{id}', [QuoteController::class, 'quotepdf']);

//Travel Voucher pdf
Route::get('/travel/pdf/{id}', [QuoteController::class, 'travelpdf']);

//invoice
Route::get('/invoice', [InvoiceController::class, 'index']);
Route::get('/invoice/add', [InvoiceController::class, 'add']);
Route::post('/invoice/add', [InvoiceController::class, 'store']);
Route::get('/invoice/edit/{id}', [InvoiceController::class, 'edit']);
Route::post('/invoice/edit/{transaction}', [InvoiceController::class, 'update']);
Route::get('/invoice/preview/{id}', [InvoiceController::class, 'preview']);
Route::get('/invoice/pdf/{id}', [InvoiceController::class, 'invoicepdf']);
Route::get('/invoices/create-from-quote/{id}', [InvoiceController::class, 'addFromQuote']);
Route::post('/invoice/delete/{id}', [InvoiceController::class, 'deleteInvoice']);

//Reciept
// Route::get('/reciept', [RecieptController::class, 'index']);
Route::get('/reciept-payment/add', [ReceiptPayementController::class, 'add']);
Route::post('/reciept-payment/add', [ReceiptPayementController::class, 'store'])->name('receipt.store');
Route::get('/reciept-payment/edit/{receipt_payment}', [ReceiptPayementController::class, 'edit']);
Route::post('/reciept-payment/edit/{receipt_payment}', [ReceiptPayementController::class, 'update'])->name('receipt.update');
// Route::get('/reciept/preview/{id}', [RecieptController::class, 'preview']);
// Route::get('/reciept/pdf/{id}', [RecieptController::class, 'recieptpdf']);
// Route::get('/reciepts/create-from-quote/{id}', [RecieptController::class, 'addFromQuote']);
// Route::post('/reciept/delete/{id}', [RecieptController::class, 'deleteInvoice']);

//Shipper
Route::get('/shipper', [ShipperController::class, 'index'])->name('shipper.index');
Route::get('/shipper/add', [ShipperController::class, 'add'])->name('shipper.add');
Route::post('/shipper/add', [ShipperController::class, 'store'])->name('shipper.store');
Route::get('/shipper/edit/{shipment}', [ShipperController::class, 'edit'])->name('shipper.edit');
Route::post('/shipper/edit/{shipment}', [ShipperController::class, 'update'])->name('shipper.update');
Route::get('/shipper/preview/{id}', [ShipperController::class, 'preview']);
Route::get('/shipper/pdf/{id}', [ShipperController::class, 'shipperpdf']);
Route::get('/shipper/create-from-quote/{id}', [ShipperController::class, 'addFromQuote']);
Route::get('/shipper/delete/{id}', [ShipperController::class, 'delete'])->name('shipper.delete');

//Security Detail
Route::get('/security-detail/add', [SecurityDetailController::class, 'add']);
Route::post('/security-detail/add', [SecurityDetailController::class, 'store'])->name('security.store');
Route::get('/security-detail/edit/{security_detail}', [SecurityDetailController::class, 'edit']);
Route::post('/security-detail/edit/{security_detail}', [SecurityDetailController::class, 'update'])->name('security.update');

//reports
Route::get('/ledger-reports', [ReportsController::class, 'ledgerIndex']);
Route::get('/vendor-ledger-reports', [ReportsController::class, 'vendorLedgerIndex']);
Route::get('/security-detail-reports', [ReportsController::class, 'SecurityIndex']);

//exports
Route::get('/export-booking', [ReportsController::class, 'bookingReportExport']);
Route::get('/export-ledger', [ReportsController::class, 'ledgerReportExport']);
Route::get('/export-security-ledger', [ReportsController::class, 'securityLedgerReportExport']);
Route::get('/export-patient', [ReportsController::class, 'patientReportExport']);
Route::get('/export-procedure', [ReportsController::class, 'procedureReportExport']);
Route::get('/export-finances', [ReportsController::class, 'financesReportExport']);
Route::get('/export-pendingPayments', [ReportsController::class, 'pendingPaymentsReportExport']);
Route::get('/export-expenses', [ReportsController::class, 'expensesReportExport']);
Route::get('/export-doctorShare', [ReportsController::class, 'doctorShareReportExport']);

// Beds24 API
Route::get('/get-beds24-bookings', [Beds24Controller::class, 'getBookings']);
Route::get('/booking-list', [Beds24Controller::class, 'index']);
