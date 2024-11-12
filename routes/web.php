<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    /**
     * Admin routes
     */
    Route::middleware('isAdmin')->group(function () {
        Route::resource('rooms', RoomController::class);
        Route::post('reservations/{reservation}/update-status', [ReservationController::class, 'updateStatus'])->name('reservations.updateStatus');
    });

    /**
     * Client routes
     */
    Route::middleware('isClient')->group(function () {
        Route::get('reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
        Route::post('reservations', [ReservationController::class, 'store'])->name('reservations.store');
    });

    /**
     * All users routes
     */
    Route::get('reservations', [ReservationController::class, 'index'])->name('reservations.index');
});
