<?php

use App\Http\Controllers\api\AttendanceCtrl;
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

Route::middleware('auth:sanctum')->group(['prefix' => 'v1'], function () {
    Route::post('clock-in', [AttendanceCtrl::class, 'clock_in']);
    Route::post('clock-out', [AttendanceCtrl::class, 'clock_out']);
});
