<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shift;

class ShiftCtrl extends Controller
{
    public function index()
    {
        $shifts = Shift::all();
        return view('admin.timeoff.shift.view', compact('shifts'));
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

        Shift::create($request->all());

        return redirect()->route('shift.index')->with('success', 'Shift created successfully.');
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

        return redirect()->route('shift.index')->with('success', 'Shift updated successfully.');
    }

    public function destroy($id)
    {
        Shift::find($id)->delete();

        return redirect()->route('shift.index')->with('success', 'Shift deleted successfully.');
    }
}
