<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\SickLeave;
use App\Models\Permission;

class TimeoffCtrl extends Controller
{
    public function allDataMerge()
    {
        $leaves = Leave::all();
        $sick_leaves = SickLeave::all();
        $permissions = Permission::all();

        // define type for each data
        $leaves->map(function ($leave) {
            $leave->type = 'Cuti';
            return $leave;
        });

        $sick_leaves->map(function ($sick_leave) {
            $sick_leave->type = 'Sakit';
            return $sick_leave;
        });

        $permissions->map(function ($permission) {
            $permission->type = 'Izin';
            return $permission;
        });
        // add all data to one collection
        $allDataTimeoff = [...$leaves, ...$sick_leaves, ...$permissions];
        // dd($allDataTimeoff);
        return view('admin.timeoff.all_data.view', compact('allDataTimeoff'));
    }

    public function indexLeave()
    {
        $leaves = Leave::all();
        return view('admin.timeoff.leave.view', compact('leaves'));
    }

    public function approveLeave(Request $request, $id)
    {
        $leave = Leave::find($id);
        $leave->status = 'approved';
        $leave->status_message = $request->message ?? '';
        $leave->approved_at = now()->format('Y-m-d');
        $leave->save();
        return redirect()->back()->with('success', 'Leave request has been approved');
    }

    public function rejectLeave(Request $request, $id)
    {
        $leave = Leave::find($id);
        $leave->status = 'rejected';
        $leave->status_message = $request->message ?? '';
        $leave->save();
        return redirect()->back()->with('success', 'Leave request has been rejected');
    }

    public function indexSickLeave()
    {
        $sick_leaves = SickLeave::all();
        return view('admin.timeoff.sick_leave.view', compact('sick_leaves'));
    }

    public function approveSickLeave(Request $request, $id)
    {
        $sick_leave = SickLeave::find($id);
        $sick_leave->status = 'approved';
        $sick_leave->approved_at = now()->format('Y-m-d');
        $sick_leave->status_message = $request->message ?? '';
        $sick_leave->save();
        return redirect()->back()->with('success', 'Sick leave request has been approved');
    }

    public function rejectSickLeave(Request $request, $id)
    {
        $sick_leave = SickLeave::find($id);
        $sick_leave->status = 'rejected';
        $sick_leave->status_message = $request->message ?? '';
        $sick_leave->save();
        return redirect()->back()->with('success', 'Sick leave request has been rejected');
    }

    public function indexPermission()
    {
        $permissions = Permission::all();
        return view('admin.timeoff.permission.view', compact('permissions'));
    }

    public function approvePermission(Request $request, $id)
    {
        $permission = Permission::find($id);
        $permission->status = 'approved';
        $permission->approved_at = now()->format('Y-m-d');
        $permission->status_message = $request->message ?? '';
        $permission->save();
        return redirect()->back()->with('success', 'Permission request has been approved');
    }

    public function rejectPermission(Request $request, $id)
    {
        $permission = Permission::find($id);
        $permission->status = 'rejected';
        $permission->status_message = $request->message ?? '';
        $permission->save();
        return redirect()->back()->with('success', 'Permission request has been rejected');
    }
}
