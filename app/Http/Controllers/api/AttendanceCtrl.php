<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absence;
use Carbon\Carbon;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Overtime;

class AttendanceCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getCurrentAttendance()
    {
        // get the latest in today absence
        $absence = Absence::where('user_id', auth()->user()->id)
            ->whereDate('timestamp', Carbon::today())
            ->latest()
            ->first();
        return response()->json($absence, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function clock_in(Request $request)
    {
    }

    public function clock_out(Request $request)
    {
    }

    public function forgot_clock_in(Request $request)
    {
    }
    public function forgot_clock_out(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
