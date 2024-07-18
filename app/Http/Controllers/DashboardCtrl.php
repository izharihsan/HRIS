<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Employee;
use Illuminate\Http\Request;

class DashboardCtrl extends Controller
{
    public function index()
    {
        $absencesHistoryWithLimit = Absence::with('employee')->orderBy('created_at', 'desc')->limit(10)->get();
        $totalKaryawan = Employee::count(['id']);
        $totalKaryawanLakilaki = Employee::where('jenis_kelamin', 'LAKI')->count(['id']);
        $totalKaryawanPerempuan = Employee::where('jenis_kelamin', 'PEREMPUAN')->count(['id']);

        return view('dashboard', compact('absencesHistoryWithLimit', 'totalKaryawan', 'totalKaryawanLakilaki', 'totalKaryawanPerempuan'));
    }
}
