<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\SickLeave;
use App\Models\Permission;

class TimeoffCtrl extends Controller
{
    public function indexLeave()
    {
        $leaves = Leave::all();
        return view('admin.timeoff.leave.view', compact('leaves'));
    }

    public function approveLeave($id)
    {
        $leave = Leave::find($id);
        $leave->status = 'approved';
        $leave->save();
        return redirect()->back()->with('success', 'Leave request has been approved');
    }

    public function rejectLeave($id)
    {
        $leave = Leave::find($id);
        $leave->status = 'rejected';
        $leave->save();
        return redirect()->back()->with('success', 'Leave request has been rejected');
    }

    public function indexSickLeave()
    {
        $sick_leaves = SickLeave::all();
        return view('admin.timeoff.sick_leave.view', compact('sick_leaves'));
    }

    public function approveSickLeave($id)
    {
        $sick_leave = SickLeave::find($id);
        $sick_leave->status = 'approved';
        $sick_leave->save();
        return redirect()->back()->with('success', 'Sick leave request has been approved');
    }

    public function rejectSickLeave($id)
    {
        $sick_leave = SickLeave::find($id);
        $sick_leave->status = 'rejected';
        $sick_leave->save();
        return redirect()->back()->with('success', 'Sick leave request has been rejected');
    }

    public function indexPermission()
    {
        $permissions = Permission::all();
        return view('admin.timeoff.permission.view', compact('permissions'));
    }

    public function approvePermission($id)
    {
        $permission = Permission::find($id);
        $permission->status = 'approved';
        $permission->save();
        return redirect()->back()->with('success', 'Permission request has been approved');
    }

    public function rejectPermission($id)
    {
        $permission = Permission::find($id);
        $permission->status = 'rejected';
        $permission->save();
        return redirect()->back()->with('success', 'Permission request has been rejected');
    }
}
