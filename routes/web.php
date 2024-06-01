<?php

use App\Http\Controllers\admin\ScheduleCtrl;
use App\Http\Controllers\admin\ShiftCtrl;
use App\Http\Controllers\AttendanceController as ControllersAttendanceController;
use App\Http\Controllers\AuthCtrl;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/logout', [AuthCtrl::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::post('/login', [AuthCtrl::class, 'login'])->name('login_process');

Route::middleware(['auth'])->group(function () {

    // TIME OFF
    Route::group(['prefix' => 'timeoff'], function () {
        Route::get('/attendance', [ControllersAttendanceController::class, 'index'])->name('attendance');
        // detail attendance
        Route::get('/attendance/{id}', [ControllersAttendanceController::class, 'show'])->name('attendance.detail');

        // SHIFT
        Route::get('/shifts', [ShiftCtrl::class, 'index'])->name('shifts');
        Route::post('/shifts', [ShiftCtrl::class, 'store'])->name('shifts.store');
        Route::put('/shifts/{id}', [ShiftCtrl::class, 'update'])->name('shifts.update');
        Route::delete('/shifts/{id}/delete', [ShiftCtrl::class, 'destroy'])->name('shifts.delete');

        // SCHEDULE
        Route::get('/schedules', [ScheduleCtrl::class, 'index'])->name('schedules');
        Route::post('/schedules', [ScheduleCtrl::class, 'store'])->name('schedules.store');
        Route::put('/schedules/{id}', [ScheduleCtrl::class, 'update'])->name('schedules.update');
        Route::delete('/schedules/{id}/delete', [ScheduleCtrl::class, 'destroy'])->name('schedules.delete');

        // OVERTIME
        Route::get('/overtime', [ControllersAttendanceController::class, 'overtime'])->name('overtime');
        Route::post('/overtime/approve/{id}', [ControllersAttendanceController::class, 'approve'])->name('overtimes.approve');
        Route::post('/overtime/reject/{id}', [ControllersAttendanceController::class, 'reject'])->name('overtimes.reject');
    });
});

// Route::get('/test-insert', function () {
//     Schedule::create([
//         'user_id' => 4,
//         'shift_id' => 2,
//         'date' => '2024-05-31'
//     ]);
// });
