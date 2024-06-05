<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\User;

class ShiftCtrl extends Controller
{
    public function index()
    {
        $shifts = Shift::all();
        return view('admin.timeoff.shift.view', compact('shifts'));
    }

    public function schedules($id)
    {
        $shifts = Shift::with('schedules')->find($id);
        $users = User::all();
        foreach ($shifts->schedules as $schedule) {
            $schedule->user_ids = explode(',', $schedule->user_ids);
        }
        return view('admin.timeoff.shift.view_schedule', compact('shifts', 'users'));
    }

    public function schedule_save(Request $request)
    {
        // Extract the relevant form data, excluding the '_token'
        $formData = $request->except('_token');
        $shift_id = $request->shift_id;

        foreach ($request->except('_token', 'shift_id') as $day => $userIdsArray) {
            // check if the user is one or more
            if (is_array($userIdsArray)) {
                $userIds = implode(',', $userIdsArray);
            } else {
                $userIds = $userIdsArray;
            }

            $schedule = Schedule::where('shift_id', $shift_id)->first();
            // remove _______ from the day
            $schedule->day = str_replace('_', '', $day);
            $schedule->user_ids = $userIds;
            $schedule->save();
        }

        return redirect()->back()->with('success', 'Schedule updated successfully.');
    }


    public function create()
    {
        return view('admin.timeoff.shift.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        if ($shift = Shift::create($request->all())) {
            $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            foreach ($days as $day) {
                $schedule = new Schedule();
                $schedule->shift_id = $shift->id;
                $schedule->day = $day;
                $schedule->save();
            }
            return redirect()->back()->with('success', 'Shift created successfully.');
        }

        return redirect()->back()->with('error', 'Failed to create shift.');
    }

    public function edit($id)
    {
        $shift = Shift::find($id);
        return view('admin.timeoff.shift.edit', compact('shift'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        Shift::find($id)->update($request->all());

        return redirect()->back()->with('success', 'Shift updated successfully.');
    }

    public function destroy($id)
    {
        Shift::find($id)->delete();

        return redirect()->back()->with('success', 'Shift deleted successfully.');
    }
}
