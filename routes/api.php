<?php

use App\Http\Controllers\api\AddressCtrl;
use App\Http\Controllers\api\AttendanceCtrl;
use App\Http\Controllers\api\AuthCtrl;
use App\Http\Controllers\api\EmployeeCtrl;
use App\Http\Controllers\api\OvertimeCtrl;
use App\Http\Controllers\api\TimeoffCtrl;
use App\Http\Controllers\api\UserCtrl;
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

// GENERAL APIs
Route::post('v1/login', [AuthCtrl::class, 'login']);
Route::middleware('auth:sanctum')->post('v1/logout', [AuthCtrl::class, 'logout']);

Route::middleware('auth:sanctum')->get('v1/user', function (Request $request) {
    return $request->user();
});

Route::get('provinces', [AddressCtrl::class, 'getProvinces']);
Route::get('cities/{province_id}', [AddressCtrl::class, 'getCities']);
Route::get('districts/{city_id}', [AddressCtrl::class, 'getDistricts']);
Route::get('villages/{district_id}', [AddressCtrl::class, 'getVillages']);

// MOBILE APIs
Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    // AUTH
    Route::put('user/update', [UserCtrl::class, 'update_user']);
    Route::get('pin/check', [AuthCtrl::class, 'check_is_new_pin_or_not']);
    Route::post('pin/update', [AuthCtrl::class, 'update_pin']);
    Route::post('pin/validate', [AuthCtrl::class, 'validate_pin']);
    Route::get('profile', [EmployeeCtrl::class, 'getProfile']);
    Route::post('profile/update-personal', [EmployeeCtrl::class, 'updateProfilePersonal']);
    Route::post('profile/update-contact', [EmployeeCtrl::class, 'updateProfileContact']);

    Route::get('attendance', [AttendanceCtrl::class, 'getCurrentAttendance']);
    Route::get('attendance/history', [AttendanceCtrl::class, 'getAttendanceHistory']);
    Route::post('clock-in', [AttendanceCtrl::class, 'clock_in']);
    Route::post('clock-out', [AttendanceCtrl::class, 'clock_out']);
    Route::post('forgot-clock-in', [AttendanceCtrl::class, 'forgot_clock_in']);
    Route::post('forgot-clock-out', [AttendanceCtrl::class, 'forgot_clock_out']);

    // overtime
    Route::get('overtime', [OvertimeCtrl::class, 'getUserOvertime']);
    Route::post('overtime/done/{id}', [OvertimeCtrl::class, 'done_overtime']);
    Route::get('overtime/{id}', [OvertimeCtrl::class, 'getUserOvertimeDetail']);
    Route::post('overtime', [OvertimeCtrl::class, 'submit_overtime']);

    // leave
    Route::get('leave/type', [TimeoffCtrl::class, 'tipe_cuti']);
    Route::get('leave', [TimeoffCtrl::class, 'getUserLeaves']);
    Route::post('leave', [TimeoffCtrl::class, 'submit_leave']);

    // GK DIPAKE
    // sick leave
    Route::post('sick-leave', [TimeoffCtrl::class, 'submit_sick_leave']);
    Route::get('sick-leave', [TimeoffCtrl::class, 'getUserSickLeaves']);

    // permission
    Route::post('permission', [TimeoffCtrl::class, 'submit_permission']);
    Route::get('permission', [TimeoffCtrl::class, 'getUserPermissions']);
    // GK DIPAKE

    // ADDRESS API
    Route::get('provinces', [AddressCtrl::class, 'getProvinces']);
    Route::get('cities/{province_id}', [AddressCtrl::class, 'getCities']);
    Route::get('districts/{city_id}', [AddressCtrl::class, 'getDistricts']);
    Route::get('villages/{district_id}', [AddressCtrl::class, 'getVillages']);
});
