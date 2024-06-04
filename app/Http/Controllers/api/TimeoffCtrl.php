<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\SickLeave;
use App\Models\Permission;
use Illuminate\Support\Facades\Log;

class TimeoffCtrl extends Controller
{
    public function submit_leave(Request $request)
    {
        try {
            $validate = $request->validate([
                'start_date' => 'required',
                'end_date' => 'required',
                'message' => 'nullable',
                'attachment' => 'required',
            ]);

            $attachment = $request->file('attachment');
            $attachment_name = time() . '_' . $attachment->getClientOriginalName();
            $attachment->move(public_path('timeoffs'), $attachment_name);

            $leave = new Leave();
            $leave->user_id = auth()->user()->id;
            $leave->start_date = $request->start_date;
            $leave->end_date = $request->end_date;
            $leave->message = $request->message ?? '';
            $leave->attachment = $attachment_name;
            $leave->status = 'pending';
            $leave->save();
            return response()->json(['message' => 'Leave request submitted successfully'], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

    public function getUserLeaves()
    {
        $leaves = Leave::where('user_id', auth()->user()->id)->get();
        return response()->json($leaves, 200);
    }

    public function submit_sick_leave(Request $request)
    {
        try {
            $attachment_name = null;
            $validate = $request->validate([
                'start_date' => 'required',
                'end_date' => 'required',
                'message' => 'nullable',
            ]);

            if ($request->hasFile('attachment')) {
                $attachment = $request->file('attachment');
                $attachment_name = time() . '_' . $attachment->getClientOriginalName();
                $attachment->move(public_path('timeoffs'), $attachment_name);
            }

            $sick_leave = new SickLeave();
            $sick_leave->user_id = auth()->user()->id;
            $sick_leave->start_date = $request->start_date;
            $sick_leave->end_date = $request->end_date;
            $sick_leave->message = $request->message ?? '';
            $sick_leave->attachment = $attachment_name;
            $sick_leave->status = 'pending';
            $sick_leave->save();
            return response()->json(['message' => 'Sick leave request submitted successfully'], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

    public function getUserSickLeaves()
    {
        $sick_leaves = SickLeave::where('user_id', auth()->user()->id)->get();
        return response()->json($sick_leaves, 200);
    }

    public function submit_permission(Request $request)
    {
        try {
            $validate = $request->validate([
                'start_date' => 'required',
                'end_date' => 'required',
                'message' => 'nullable',
                'attachment' => 'required',
            ]);

            $attachment = $request->file('attachment');
            $attachment_name = time() . '_' . $attachment->getClientOriginalName();
            $attachment->move(public_path('timeoffs'), $attachment_name);

            $permission = new Permission();
            $permission->user_id = auth()->user()->id;
            $permission->start_date = $request->start_date;
            $permission->end_date = $request->end_date;
            $permission->message = $request->message ?? '';
            $permission->attachment = $attachment_name;
            $permission->status = 'pending';
            $permission->save();
            return response()->json(['message' => 'Permission request submitted successfully'], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

    public function getUserPermissions()
    {
        $permissions = Permission::where('user_id', auth()->user()->id)->get();
        return response()->json($permissions, 200);
    }
}
