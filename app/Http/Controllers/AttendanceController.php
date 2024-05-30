<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $absences = Absence::all();
        return view('admin.timeoff.attendance.view', compact('absences'));
    }
}
