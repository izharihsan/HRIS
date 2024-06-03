<?php

use App\Http\Controllers\api\AttendanceCtrl;
use App\Http\Controllers\api\AuthCtrl;
use App\Http\Controllers\api\OvertimeCtrl;
use App\Http\Controllers\api\TimeoffCtrl;
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


Route::post('v1/login', [AuthCtrl::class, 'login']);
Route::middleware('auth:sanctum')->post('v1/logout', [AuthCtrl::class, 'logout']);

Route::middleware('auth:sanctum')->get('v1/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::get('attendance', [AttendanceCtrl::class, 'getCurrentAttendance']);
    Route::post('clock-in', [AttendanceCtrl::class, 'clock_in']);
    Route::post('clock-out', [AttendanceCtrl::class, 'clock_out']);

    // overtime
    Route::get('overtime', [OvertimeCtrl::class, 'getUserOvertime']);
    Route::post('overtime/done/{id}', [OvertimeCtrl::class, 'done_overtime']);
    Route::get('overtime/{id}', [OvertimeCtrl::class, 'getUserOvertimeDetail']);
    Route::post('overtime', [OvertimeCtrl::class, 'submit_overtime']);

    // leave
    Route::get('leave', [TimeoffCtrl::class, 'getUserLeaves']);
    Route::post('leave', [TimeoffCtrl::class, 'submit_leave']);

    // sick leave
    Route::post('sick-leave', [TimeoffCtrl::class, 'submit_sick_leave']);
    Route::get('sick-leave', [TimeoffCtrl::class, 'getUserSickLeaves']);

    // permission
    Route::post('permission', [TimeoffCtrl::class, 'submit_permission']);
    Route::get('permission', [TimeoffCtrl::class, 'getUserPermissions']);
});
