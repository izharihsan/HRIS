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
        $request['gaji_pokok'] = str_replace('.', '', $request['gaji_pokok']);
        $request['gaji_pokok'] = str_replace('Rp', '', $request['gaji_pokok']);
        $request['gaji_pokok'] = str_replace(' ', '', $request['gaji_pokok']);

        $employee->update($request->except('image'));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/user'), $filename);
            User::where('karyawan_id', $employee->id)->update(['image' => '/image/user/' . $filename]);
        }

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function create()
    {
        $branches = Branch::all();
        return view('admin.employee.create', compact('branches'));
    }

    public function storeEmployee(Request $request)
    {
        $request['gaji_pokok'] = str_replace('.', '', $request['gaji_pokok']);
        $request['gaji_pokok'] = str_replace('Rp', '', $request['gaji_pokok']);
        $request['gaji_pokok'] = str_replace(' ', '', $request['gaji_pokok']);
        // dd($request->all());
        $employee = Employee::create($request->except('image', 'password', '_token'));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/user'), $filename);
            $userCreate = User::create([
                'karyawan_id' => $employee->id,
                'role_id' => 5,
                'username' => $employee->email,
                'email' => $employee->email,
                'password' => bcrypt($request->password),
                'image' => '/image/user/' . $filename,
                'branch_id' => $request->branch_id,
                'status' => $request->status,
                'password_masked' => $request->password,
                'nama_panggilan' => $employee->name,
                'name' => $employee->name,
            ]);

            if (!$userCreate) {
                $employee->delete();
                return redirect()->back()->with('error', 'Gagal membuat user');
            }
        }

        return redirect()->route('employee.list')->with('success', 'Data berhasil ditambahkan');
    }
}
