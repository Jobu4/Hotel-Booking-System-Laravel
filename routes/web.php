<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//hotels
Route::get('hotels/rooms/{id}', [App\Http\Controllers\Hotels\HotelsController::class, 'rooms'])->name('hotel.rooms');
//hotels room details
Route::get('hotels/rooms-details/{id}', [App\Http\Controllers\Hotels\HotelsController::class, 'roomDetails'])->name('hotel.rooms.details');
//hotels room booking
Route::post('hotels/rooms-booking/{id}', [App\Http\Controllers\Hotels\HotelsController::class, 'roomBooking'])->name('hotel.rooms.booking');
//pay
Route::get('hotels/pay', [App\Http\Controllers\Hotels\HotelsController::class, 'payWithPaypal'])->name('hotel.pay');
//pay
Route::get('hotels/success', [App\Http\Controllers\Hotels\HotelsController::class, 'success'])->name('hotel.success');