<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleCtrl extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return view('admin.timeoff.schedule.view', compact('schedules'));
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

        return redirect()->route('schedule.index')->with('success', 'Schedule created successfully.');
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

        return redirect()->route('schedule.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy($id)
    {
        Schedule::find($id)->delete();

        return redirect()->route('schedule.index')->with('success', 'Schedule deleted successfully.');
    }
}
