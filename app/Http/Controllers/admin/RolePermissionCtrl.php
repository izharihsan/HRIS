<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class RolePermissionCtrl extends Controller
{
    public function approvalPermission()
    {
        $employees = Employee::all();
        return view('admin.approval.view', compact('employees'));
    }

    public function updateApprovalPermission(Request $request, $id)
    {
        $employee = Employee::find($id);

        // function for update approval permission
        // ...

        return redirect()->back()->with('success', 'Approval Permission Updated Successfully');
    }
}
