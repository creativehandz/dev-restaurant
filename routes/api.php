<?php

use App\Http\Controllers\API\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/book-table', [BookingController::class,'createBooking']);
Route::get('/booking/{id}', [BookingController::class, 'getBookings']);
Route::patch('/booking/{id}', [BookingController::class, 'updateBooking']);
Route::post('/create-event', [BookingController::class,'createEvent']);
Route::get('/settings/{key?}', [BookingController::class,'getSettings']);
Route::post('/send-email', [BookingController::class,'sendEmail']);