<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Shift;
use App\Models\User;

class ScheduleCtrl extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        $shifts = Shift::all();
        $users = User::all();
        return view('admin.timeoff.schedule.view', compact('schedules', 'shifts', 'users'));
    }

    public function create()
    {
        return view('admin.timeoff.schedule.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'shift_id' => 'required',
            'date' => 'required',
        ]);

        Schedule::create($request->all());

        return redirect()->back()->with('success', 'Schedule created successfully.');
    }

    public function edit($id)
    {
        $schedule = Schedule::find($id);
        return view('admin.timeoff.schedule.edit', compact('schedule'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'shift_id' => 'required',
            'date' => 'required',
        ]);

        Schedule::find($id)->update($request->all());

        return redirect()->back()->with('success', 'Schedule updated successfully.');
    }

    public function destroy($id)
    {
        Schedule::find($id)->delete();

        return redirect()->back()->with('success', 'Schedule deleted successfully.');
    }
}
