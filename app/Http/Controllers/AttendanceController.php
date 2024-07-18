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
}
