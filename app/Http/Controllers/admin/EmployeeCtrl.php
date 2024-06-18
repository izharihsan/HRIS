<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;

class EmployeeCtrl extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('admin.employee.view', compact('employees'));
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        $branches = Branch::all();
        return view('admin.employee.detail', compact('employee', 'branches'));
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->route('employee.list')->with('success', 'Data berhasil dihapus');
    }

    public function nonaktifkan($id)
    {
        $employee = Employee::find($id);
        $employee->status = false;
        $employee->save();

        if ($employee->user != null) {
            $employee->user->status = false;
            $employee->user->save();
        }

        return redirect()->back()->with('success', 'Karyawan berhasil dinonaktifkan');
    }
    public function aktifkan($id)
    {
        $employee = Employee::find($id);
        $employee->status = true;
        $employee->save();

        if ($employee->user != null) {
            $employee->user->status = true;
            $employee->user->save();
        }

        return redirect()->back()->with('success', 'Karyawan berhasil diaktifkan');
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->update($request->except('image'));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/user'), $filename);
            User::where('karyawan_id', $employee->id)->update(['image' => '/image/user/' . $filename]);
        }

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }
}
