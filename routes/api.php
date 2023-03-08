<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('hotel')->group(function () {
    Route::post('/getHotel', [HotelController::class, 'getHotel']);
    Route::post('/saveHotel', [HotelController::class, 'saveHotel']);
    Route::get('/getComplements', [HotelController::class, 'getComplements']);
    Route::post('/acomodingBedroom', [HotelController::class, 'acomodingBedroom']);
    Route::post('/deleteHotel', [HotelController::class, 'deleteHotel']);
});