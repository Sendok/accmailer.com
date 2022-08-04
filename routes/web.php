<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
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
    Route::get('/single', function () {
        return view('dashboard.pages.single');
    });
    Route::get('/bulk', function () {
        return view('dashboard.pages.bulk');
    });
    Route::get('/api', function () {
        return view('dashboard.pages.api');
    });
    Route::get('/report', function () {
        return view('dashboard.pages.report');
    });
    Route::get('/default', function () {
        return view('dashboard.layouts.default');
    });
    Route::get('/plan', function () {
        return view('dashboard.pages.plan');
    })->name('plan');
    Route::get('/checkout', function () {
        return view('dashboard.pages.checkout');
    });
});
