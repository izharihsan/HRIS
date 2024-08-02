<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeDocument;
use App\Models\EmployeeEducation;
use App\Models\EmployeeFamily;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $data = auth()->user()->employee;
        $documents = EmployeeDocument::where('employee_id', $data->id)->get();
        $families = EmployeeFamily::where('employee_id', $data->id)->get();
        $educations = EmployeeEducation::where('employee_id', $data->id)->get();
        return view('admin.profile.index', compact('data', 'documents', 'families', 'educations'));
    }
}
