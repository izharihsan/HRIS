<?php

namespace App\Http\Controllers;

use App\Models\Overtime;
use Illuminate\Http\Request;

class OvertimeCtrl extends Controller
{
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
