<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/rooms/create', 'App\Http\Controllers\RoomController@create')->name('rooms.create');
Route::post('/rooms', 'App\Http\Controllers\RoomController@store')->name('rooms.store');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'showReservationForm'])->name('home');
Route::post('/rooms/reserve', [App\Http\Controllers\HomeController::class, 'reserveRoom'])->name('rooms.reserve');
Route::get('/admindashboard', [App\Http\Controllers\AdminDashboardController::class, 'index'])->name('admindashboard');
Route::get('/rooms', [App\Http\Controllers\RoomViewController::class, 'index'])->name('rooms');
Route::delete('/rooms/{room}', [App\Http\Controllers\RoomViewController::class, 'destroy'])->name('rooms.destroy');
Route::get('/bookings', [App\Http\Controllers\BookingsController::class, 'index'])->name('bookings.index');
Route::get('/bookings/delete/{id}', [App\Http\Controllers\BookingsController::class, 'delete'])->name('bookings.delete');
Route::get('/payments', [App\Http\Controllers\RoomController::class, 'index'])->name('payments.index');
Route::post('/booking/pay/{id}', [App\Http\Controllers\HomeController::class, 'payBooking'])->name('booking.pay');
Route::get('/payments', [App\Http\Controllers\PaymentsController::class, 'index'])->name('payments.index');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('login');
})->name('logout');