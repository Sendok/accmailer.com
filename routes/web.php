<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\SingleController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BulkController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('landing/index');
});
Route::post('/', [GuestController::class, 'validateGuest'])->name('validateGuest.post');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('single', [SingleController::class, 'index'])->name('single');
    Route::post('single', [SingleController::class, 'validateSingle'])->name('validateSingle.post');
    Route::get('single/export/{slug}', [SingleController::class, 'SingleExport'])->name('singleExport.get');
    Route::get('plan', [PlanController::class, 'index'])->name('plan');
    Route::get('checkout/plan/{slug}', [CheckoutController::class, 'checkoutPlan'])->name('checkout.detail');
    Route::get('payment', [PaymentController::class, 'payment'])->name('payment');
    Route::get('payment/cancel', [PaymentController::class, 'paymentPaypalCancel'])->name('payment.cancel');
    Route::get('payment/success', [PaymentController::class, 'paymentPaypalSuccess'])->name('payment.success');
    Route::get('bulk', [BulkController::class, 'index'])->name('bulk');
    Route::post('bulk/check', [BulkController::class, 'validateCountBulk'])->name('bulk.check');
    Route::post('bulk/verification', [BulkController::class, 'validateBulk'])->name('bulk.verification');
    Route::get('bulk/export/{slug}', [BulkController::class, 'BulkExport'])->name('bulkExport.get');
    Route::get('api', [ApiController::class, 'index'])->name('api');
    Route::post('api', [ApiController::class, 'generatApiToken'])->name('api.generate');
    Route::get('report', [ReportController::class, 'index'])->name('report');
    Route::get('report/export/{slug}', [ReportController::class, 'reportExport'])->name('reportExport.get');
    Route::get('logout', [UserController::class, 'Logout'])->name('logout');
});
