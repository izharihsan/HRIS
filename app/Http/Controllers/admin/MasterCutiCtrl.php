<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterTimeoff;

class MasterCutiCtrl extends Controller
{
    public function index()
    {
        $masterTimeoffs = MasterTimeoff::latest()->get();
        return view('admin.master.tipe_cuti', compact('masterTimeoffs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'kuota' => 'required',
            'periode' => 'required',
            'is_attachment_required' => 'required',
        ]);
        MasterTimeoff::create($request->all());
        return redirect()->back()->with('success', 'Master Timeoff created successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'kuota' => 'required',
            'periode' => 'required',
            'is_attachment_required' => 'required',
        ]);
        MasterTimeoff::find($id)->update($request->all());
        return redirect()->back()->with('success', 'Master Timeoff updated successfully');
    }

    public function destroy($id)
    {
        MasterTimeoff::find($id)->delete();
        return redirect()->back()->with('success', 'Master Timeoff deleted successfully');
    }
}
