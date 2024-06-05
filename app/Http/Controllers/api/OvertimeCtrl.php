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
                'overtime_date' => 'required',
            ]);
            $before_image_name = null;

            $overtime = new Overtime();
            $overtime->absence_id = null;
            $overtime->user_id = auth()->user()->id;
            $overtime->start_time = $request->start_time;
            $overtime->end_time = $request->end_time;
            $overtime->message = $request->message ?? '';
            $overtime->overtime_date = $request->overtime_date;
            $overtime->before_image = $before_image_name;
            $overtime->status = 'pending';
            $overtime->save();
            return response()->json(['message' => 'Overtime request submitted successfully'], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

    public function done_overtime(Request $request, $id)
    {
        try {
            $overtime = Overtime::find($id);

            if (!$overtime) {
                return response()->json(['message' => 'Overtime request not found'], 404);
            }

            $after_image = $request->file('after_image');
            $after_image_name = time() . '.' . $after_image->getClientOriginalExtension();
            $after_image->move(public_path('timeoffs'), $after_image_name);
            $overtime->after_image = $after_image_name;

            $overtime->save();
            return response()->json(['message' => 'Overtime done'], 200);
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

    public function getUserOvertimeDetail($id)
    {
        $overtimes = Overtime::with('absence', 'absence.user')->whereHas('absence', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })
            ->where('id', $id)
            ->first();
        return response()->json($overtimes, 200);
    }
}
