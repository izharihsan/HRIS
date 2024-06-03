<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Absence;
use App\Models\Overtime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OvertimeCtrl extends Controller
{
    public function submit_overtime(Request $request)
    {
        try {
            $validate = $request->validate([
                'start_time' => 'required',
                'end_time' => 'required',
                'message' => 'nullable',
            ]);

            $check_absence = Absence::with('overtime')->where('user_id', auth()->user()->id)
                ->whereDate('timestamp', Carbon::today())
                ->latest()
                ->first();

            if (!$check_absence) {
                return response()->json(['message' => 'You have not clocked in yet'], 400);
            }

            if ($check_absence->overtime) {
                return response()->json(['message' => 'You have already submitted an overtime request'], 400);
            }

            $overtime = new Overtime();
            $overtime->absence_id = $check_absence->id;
            $overtime->start_time = $request->start_time;
            $overtime->end_time = $request->end_time;
            $overtime->message = $request->message ?? '';
            $overtime->status = 'pending';
            $overtime->save();
            return response()->json(['message' => 'Overtime request submitted successfully'], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

    public function getUserOvertime()
    {
        $overtimes = Overtime::with('absence', 'absence.user')->whereHas('absence', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->get();
        return response()->json($overtimes, 200);
    }
}
