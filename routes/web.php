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

        // SHIFT
        Route::get('/shifts', [ShiftCtrl::class, 'index'])->name('shifts');

        // SCHEDULE
        Route::get('/schedules', [ScheduleCtrl::class, 'index'])->name('schedules');
    });
});

// Route::get('/test-insert', function () {
//     Schedule::create([
//         'user_id' => 4,
//         'shift_id' => 2,
//         'date' => '2024-05-31'
//     ]);
// });
