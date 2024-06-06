<?php

use App\Http\Controllers\admin\ScheduleCtrl;
use App\Http\Controllers\admin\ShiftCtrl;
use App\Http\Controllers\admin\TimeoffCtrl;
use App\Http\Controllers\AttendanceController as ControllersAttendanceController;
use App\Http\Controllers\AuthCtrl;
use App\Http\Controllers\DashboardCtrl;
use App\Http\Controllers\OvertimeCtrl;
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

Route::get('/', [DashboardCtrl::class, 'index'])->middleware('auth')->name('dashboard');

Route::post('/login', [AuthCtrl::class, 'login'])->name('login_process');

Route::middleware(['auth'])->group(function () {

    // TIME OFF
    Route::group(['prefix' => 'timeoff'], function () {
        Route::get('/attendance', [ControllersAttendanceController::class, 'index'])->name('attendance');
        // detail attendance
        Route::get('/attendance/{id}', [ControllersAttendanceController::class, 'show'])->name('attendance.detail');

        // SHIFT
        Route::get('/shifts', [ShiftCtrl::class, 'index'])->name('shifts');
        Route::get('/shifts/schedule/{id}', [ShiftCtrl::class, 'schedules'])->name('shifts.schedule');
        Route::post('/shifts', [ShiftCtrl::class, 'store'])->name('shifts.store');
        Route::post('/shifts/schedule', [ShiftCtrl::class, 'schedule_save'])->name('shifts.schedule.save');
        Route::put('/shifts/{id}', [ShiftCtrl::class, 'update'])->name('shifts.update');
        Route::delete('/shifts/{id}/delete', [ShiftCtrl::class, 'destroy'])->name('shifts.delete');

        // OVERTIME
        Route::get('/overtime', [OvertimeCtrl::class, 'overtime'])->name('overtime');
        Route::post('/overtime/approve/{id}', [OvertimeCtrl::class, 'approve'])->name('overtimes.approve');
        Route::post('/overtime/reject/{id}', [OvertimeCtrl::class, 'reject'])->name('overtimes.reject');

        // LEAVES
        Route::get('/leave', [TimeoffCtrl::class, 'indexLeave'])->name('leaves');
        Route::post('/leave/approve/{id}', [TimeoffCtrl::class, 'approveLeave'])->name('leaves.approve');
        Route::post('/leave/reject/{id}', [TimeoffCtrl::class, 'rejectLeave'])->name('leaves.reject');

        // SICK LEAVES
        Route::get('/sick-leave', [TimeoffCtrl::class, 'indexSickLeave'])->name('sick_leaves');
        Route::post('/sick-leave/approve/{id}', [TimeoffCtrl::class, 'approveSickLeave'])->name('sick_leaves.approve');
        Route::post('/sick-leave/reject/{id}', [TimeoffCtrl::class, 'rejectSickLeave'])->name('sick_leaves.reject');

        // PERMISSIONS
        Route::get('/permission', [TimeoffCtrl::class, 'indexPermission'])->name('permissions');
        Route::post('/permission/approve/{id}', [TimeoffCtrl::class, 'approvePermission'])->name('permissions.approve');
        Route::post('/permission/reject/{id}', [TimeoffCtrl::class, 'rejectPermission'])->name('permissions.reject');
    });
});

// Route::get('/test-insert', function () {
//     Schedule::create([
//         'user_id' => 4,
//         'shift_id' => 2,
//         'date' => '2024-05-31'
//     ]);
// });
