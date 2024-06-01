<?php

use App\Http\Controllers\api\AttendanceCtrl;
use App\Http\Controllers\api\AuthCtrl;
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

Route::middleware('auth:sanctum')->get('v1/user', function (Request $request) {
    return $request->user();
});

Route::post('v1/login', [AuthCtrl::class, 'login']);
Route::middleware('auth:sanctum')->post('v1/logout', [AuthCtrl::class, 'logout']);

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::get('attendance', [AttendanceCtrl::class, 'getCurrentAttendance']);
    Route::post('clock-in', [AttendanceCtrl::class, 'clock_in']);
    Route::post('clock-out', [AttendanceCtrl::class, 'clock_out']);
});
