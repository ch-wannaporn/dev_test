<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

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

Route::get('/bookings/thisweek', [BookingController::class, 'getThisWeekBookings'])->name('thisweek');
Route::get('/bookings/nextweek', [BookingController::class, 'getNextWeekBookings'])->name('nextweek');
Route::get('/bookings/wholemonth', [BookingController::class, 'getWholeMonthBookings'])->name('wholemonth');