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

        // Custom order for days of the week
        $daysOrder = [
            'Senin' => 1,
            'Selasa' => 2,
            'Rabu' => 3,
            'Kamis' => 4,
            'Jumat' => 5,
            'Sabtu' => 6
        ];

        // Normalize day values and sort schedules
        $shifts->schedules = $shifts->schedules->sortBy(function ($schedule) use ($daysOrder) {
            $day = trim($schedule->day);  // Ensure whitespace is trimmed
            return $daysOrder[$day] ?? 999;  // Handle unexpected day values
        });

        foreach ($shifts->schedules as $schedule) {
            $schedule->user_ids = explode(',', $schedule->user_ids);
        }

        return view('admin.timeoff.shift.view_schedule', compact('shifts', 'users'));
    }



    public function schedule_save(Request $request)
    {
        // Extract the form data, excluding '_token' and 'shift_id'
        $formData = $request->except('_token', 'shift_id', 'id');
        $shift_id = $request->shift_id;
        $ids = $request->id;

        foreach ($formData as $day => $userIdsArray) {
            // Get the index from the day string (assuming day has a pattern like 'Senin_1', 'Selasa_2', etc.)
            $index = array_search($day, array_keys($formData));

            // Ensure the index is valid
            if (isset($ids[$index])) {
                $id = $ids[$index];

                // Find the schedule by shift_id and id
                $schedule = Schedule::where('id', $id)->first();

                if ($schedule) {
                    // Update the user_ids column with the new array of user IDs
                    $schedule->user_ids = implode(',', $userIdsArray);
                    $schedule->save();
                }
            }
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
                $schedule->day = trim($day);  // Trim any potential whitespace
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

        Schedule::where('shift_id', $id)->delete();

        return redirect()->back()->with('success', 'Shift deleted successfully.');
    }
}
