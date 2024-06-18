<?php

use App\Http\Controllers\admin\EmployeeCtrl;
use App\Http\Controllers\admin\MasterCutiCtrl;
use App\Http\Controllers\admin\PerusahaanCtrl;
use App\Http\Controllers\admin\ScheduleCtrl;
use App\Http\Controllers\admin\ShiftCtrl;
use App\Http\Controllers\admin\TimeoffCtrl;
use App\Http\Controllers\AttendanceController as ControllersAttendanceController;
use App\Http\Controllers\AuthCtrl;
use App\Http\Controllers\DashboardCtrl;
use App\Http\Controllers\OvertimeCtrl;
use Illuminate\Support\Facades\Artisan;
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

    // BRANCH
    Route::get('/branch', [PerusahaanCtrl::class, 'indexBranch'])->name('branch.list');
    Route::post('/branch', [PerusahaanCtrl::class, 'storeBranch'])->name('branch.store');
    Route::put('/branch/{id}', [PerusahaanCtrl::class, 'updateBranch'])->name('branch.update');
    Route::delete('/branch/{id}', [PerusahaanCtrl::class, 'destroyBranch'])->name('branch.delete');

    // JABATAN
    Route::get('/jabatan', [PerusahaanCtrl::class, 'indexJabatan'])->name('jabatan.list');
    Route::post('/jabatan', [PerusahaanCtrl::class, 'storeJabatan'])->name('jabatan.store');
    Route::put('/jabatan/{id}', [PerusahaanCtrl::class, 'updateJabatan'])->name('jabatan.update');
    Route::delete('/jabatan/{id}', [PerusahaanCtrl::class, 'destroyJabatan'])->name('jabatan.delete');

    // EMPLOYEE
    Route::get('/employee', [EmployeeCtrl::class, 'index'])->name('employee.list');
    Route::get('/employee/{id}', [EmployeeCtrl::class, 'show'])->name('employee.detail');
    Route::delete('/employee/{id}', [EmployeeCtrl::class, 'destroy'])->name('employee.delete');
    Route::post('/employee/nonaktifkan/{id}', [EmployeeCtrl::class, 'nonaktifkan'])->name('employee.nonaktifkan');
    Route::post('/employee/aktifkan/{id}', [EmployeeCtrl::class, 'aktifkan'])->name('employee.aktifkan');
    Route::put('/employee/{id}', [EmployeeCtrl::class, 'update'])->name('employee.update');

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

        // all data
        // Route::get('/timeoffs', [TimeoffCtrl::class, 'allDataMerge'])->name('all_data_timeoff');

        // MASTER CUTI
        Route::get('/tipe-cuti', [MasterCutiCtrl::class, 'index'])->name('master.tipe_cuti');
        Route::post('/tipe-cuti', [MasterCutiCtrl::class, 'store'])->name('master.tipe_cuti.store');
        Route::put('/tipe-cuti/{id}', [MasterCutiCtrl::class, 'update'])->name('master.tipe_cuti.update');
        Route::delete('/tipe-cuti/{id}', [MasterCutiCtrl::class, 'destroy'])->name('master.tipe_cuti.delete');

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

Route::get('/config-clear', function () {
    Artisan::call('config:clear');
    return 'config:clear';
});

Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    return 'cache:clear';
});

Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return 'config:cache';
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'storage:link';
});

Route::get('/migrate', function () {
    Artisan::call('migrate');
    return 'migrate';
});

Route::get('/migrate-refresh', function () {
    Artisan::call('migrate:refresh');
    return 'migrate:refresh';
});
