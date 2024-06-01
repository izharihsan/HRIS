<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Overtime;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $absences = Absence::all();
        return view('admin.timeoff.attendance.view', compact('absences'));
    }

    public function show($id)
    {
        $absence = Absence::find($id);
        return view('admin.timeoff.attendance.detail', compact('absence'));
    }

    // OVERTIME CTRL
    public function overtime()
    {
        $overtimes = Overtime::with('absence', 'absence.user')->get();
        return view('admin.timeoff.overtime.view', compact('overtimes'));
    }

    public function approve(Request $request, $id)
    {
        $absence = Overtime::find($id);
        $absence->status = 'approved';
        $absence->status_message = $request->message ?? '';
        $absence->save();

        return redirect()->back()->with('success', 'Overtime request has been approved');
    }

    public function reject(Request $request, $id)
    {
        $absence = Overtime::find($id);
        $absence->status = 'rejected';
        $absence->status_message = $request->message ?? '';
        $absence->save();

        return redirect()->back()->with('success', 'Overtime request has been rejected');
    }
}
