<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\City;
use App\Models\Districts;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Province;
use App\Models\User;
use App\Models\Village;
use App\Models\EmployeeDocument;
use App\Models\EmployeeFamily;
use App\Models\EmployeeEducation;
use App\Models\PerjalananDinas;
use App\Models\EmployeeWarning;
use App\Models\EmployeeRewards;
use App\Models\EmployeePromotion;
use App\Models\EmployeeResign;

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
        $documents = EmployeeDocument::where('employee_id', $id)->get();
        $families = EmployeeFamily::where('employee_id', $id)->get();
        $educations = EmployeeEducation::where('employee_id', $id)->get();
        return view('admin.employee.detail', compact('employee', 'branches', 'documents', 'families', 'educations'));
    }

    // NOT USED
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
        $provinces = Province::all();
        $cities = City::all();
        $districts = Districts::all();
        $villages = Village::all();

        return view('admin.employee.create', compact('branches', 'provinces', 'cities', 'districts', 'villages'));
    }

    public function storeEmployee(Request $request)
    {
        $request['gaji_pokok'] = str_replace('.', '', $request['gaji_pokok']);
        $request['gaji_pokok'] = str_replace('Rp', '', $request['gaji_pokok']);
        $request['gaji_pokok'] = str_replace(' ', '', $request['gaji_pokok']);

        $employee = Employee::create($request->except('image', 'password', '_token'));

        $filename = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/user'), $filename);
        }

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

        return redirect()->route('employee.list')->with('success', 'Data berhasil ditambahkan');
    }

    // store, update, destory employee documents
    public function storeDocument(Request $request)
    {

        $filename = null;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/employee_document'), $filename);
        }

        $request['attachment'] = $filename;
        $request['employee_id'] = $request->employee_id;
        $request['type'] = 'Document';

        EmployeeDocument::create([
            'employee_id' => $request->employee_id,
            'type' => 'Document',
            'attachment' => $filename,
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Dokumen berhasil ditambahkan')->with('pageIsActive', 'document');
    }

    public function updateDocument(Request $request, $id)
    {
        $employeeDocument = EmployeeDocument::find($id);

        $filename = null;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/employee_document'), $filename);
        }

        $request['attachment'] = $filename;

        $employeeDocument->update($request->all());

        return redirect()->back()->with('success', 'Dokumen berhasil diupdate')->with('pageIsActive', 'document');
    }

    public function destroyDocument($id)
    {
        $employeeDocument = EmployeeDocument::find($id);
        unlink(public_path('image/employee_document/' . $employeeDocument->attachment));
        $employeeDocument->delete();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus')->with('pageIsActive', 'document');
    }

    // store, update, destory employee education
    public function storeEducation(Request $request)
    {

        $filename = null;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/employee_education'), $filename);
        }

        $request['attachment'] = $filename;

        EmployeeEducation::create([
            'employee_id' => $request->employee_id,
            'institute' => $request->institute,
            'major' => $request->major,
            'degree' => $request->degree,
            'year' => $request->year,
            'attachment' => $filename,
        ]);

        return redirect()->back()->with('success', 'Pendidikan berhasil ditambahkan')->with('pageIsActive', 'education');
    }

    public function updateEducation(Request $request, $id)
    {
        $employeeEducation = EmployeeEducation::find($id);
        $employeeEducation->update($request->all());

        return redirect()->back()->with('success', 'Pendidikan berhasil diupdate')->with('pageIsActive', 'education');
    }

    public function destroyEducation($id)
    {
        $employeeEducation = EmployeeEducation::find($id);
        unlink(public_path('image/employee_education/' . $employeeEducation->attachment));
        $employeeEducation->delete();

        return redirect()->back()->with('success', 'Pendidikan berhasil dihapus')->with('pageIsActive', 'education');
    }

    // store, update, destory employee family

    public function storeFamily(Request $request)
    {
        EmployeeFamily::create($request->except('_token'));

        return redirect()->back()->with('success', 'Keluarga berhasil ditambahkan')->with('pageIsActive', 'family');
    }

    public function updateFamily(Request $request, $id)
    {
        $employeeFamily = EmployeeFamily::find($id);
        $employeeFamily->update($request->all());

        return redirect()->back()->with('success', 'Keluarga berhasil diupdate')->with('pageIsActive', 'family');
    }

    public function destroyFamily($id)
    {
        $employeeFamily = EmployeeFamily::find($id);
        $employeeFamily->delete();

        return redirect()->back()->with('success', 'Keluarga berhasil dihapus')->with('pageIsActive', 'family');
    }

    public function indexPerjalananDinas()
    {
        $trips = PerjalananDinas::all();
        $employees = Employee::all();
        return view('admin.perjalanan_dinas.view', compact('trips', 'employees'));
    }

    public function storePerjalananDinas(Request $request)
    {
        if ($request->start_date > $request->end_date) {
            return redirect()->back()->with('error', 'Tanggal mulai tidak boleh lebih besar dari tanggal selesai');
        }

        $filename = null;

        if ($request->hasFile('lampiran_dinas')) {
            $file = $request->file('lampiran_dinas');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/employee_trips'), $filename);
        }

        $request->merge(['attachment' => $filename]);

        PerjalananDinas::create([
            'employee_id' => $request->employee_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'title' => $request->title,
            'attachment' => $filename,
        ]);
        return redirect()->back()->with('success', 'Perjalanan dinas berhasil ditambahkan');
    }

    public function updatePerjalananDinas(Request $request, $id)
    {
        $trip = PerjalananDinas::find($id);

        if ($request->start_date > $request->end_date) {
            return redirect()->back()->with('error', 'Tanggal mulai tidak boleh lebih besar dari tanggal selesai');
        }

        $filename = null;

        if ($request->hasFile('lampiran_dinas')) {
            $file = $request->file('lampiran_dinas');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/employee_trips'), $filename);
            $request->merge(['attachment' => $filename]);
        }


        $trip->update([
            'employee_id' => $request->employee_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'title' => $request->title,
            'attachment' => $request->hasFile('lampiran_dinas') ? $filename : $trip->attachment,
        ]);

        return redirect()->back()->with('success', 'Perjalanan dinas berhasil diupdate');
    }

    public function destroyPerjalananDinas($id)
    {
        $trip = PerjalananDinas::find($id);
        unlink(public_path('image/employee_trips/' . $trip->attachment));
        $trip->delete();

        return redirect()->back()->with('success', 'Perjalanan dinas berhasil dihapus');
    }

    public function indexWarning()
    {
        $warnings = EmployeeWarning::all();
        $employees = Employee::all();
        return view('admin.peringatan.view', compact('warnings', 'employees'));
    }

    public function storeWarning(Request $request)
    {
        $filename = null;

        if ($request->hasFile('lampiran_warning')) {
            $file = $request->file('lampiran_warning');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/employee_warning'), $filename);
        }

        $request->merge(['attachment' => $filename]);

        EmployeeWarning::create([
            'employee_id' => $request->employee_id,
            'title' => $request->title,
            'description' => $request->description,
            'attachment' => $filename,
        ]);

        return redirect()->back()->with('success', 'Peringatan berhasil ditambahkan');
    }

    public function updateWarning(Request $request, $id)
    {
        $warning = EmployeeWarning::find($id);

        $filename = null;

        if ($request->hasFile('lampiran_warning')) {
            $file = $request->file('lampiran_warning');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/employee_warning'), $filename);
            $request->merge(['attachment' => $filename]);
        }

        $warning->update([
            'employee_id' => $request->employee_id,
            'title' => $request->title,
            'description' => $request->description,
            'attachment' => $request->hasFile('lampiran_warning') ? $filename : $warning->attachment,
        ]);

        return redirect()->back()->with('success', 'Peringatan berhasil diupdate');
    }

    public function destroyWarning($id)
    {
        $warning = EmployeeWarning::find($id);
        unlink(public_path('image/employee_warning/' . $warning->attachment));
        $warning->delete();

        return redirect()->back()->with('success', 'Peringatan berhasil dihapus');
    }

    public function indexRewards()
    {
        $rewards = EmployeeRewards::all();
        $employees = Employee::all();
        return view('admin.rewards.view', compact('rewards', 'employees'));
    }

    public function storeRewards(Request $request)
    {
        EmployeeRewards::create($request->all());
        return redirect()->back()->with('success', 'Penghargaan berhasil ditambahkan');
    }

    public function updateRewards(Request $request, $id)
    {
        $reward = EmployeeRewards::find($id);
        $reward->update($request->all());
        return redirect()->back()->with('success', 'Penghargaan berhasil diupdate');
    }

    public function destroyRewards($id)
    {
        $reward = EmployeeRewards::find($id);
        $reward->delete();
        return redirect()->back()->with('success', 'Penghargaan berhasil dihapus');
    }

    public function indexPromotion()
    {
        $promotions = EmployeePromotion::all();
        $employees = Employee::all();
        return view('admin.promotion.view', compact('promotions', 'employees'));
    }

    public function storePromotion(Request $request)
    {
        $filename = null;

        if ($request->hasFile('lampiran_promosi')) {
            $file = $request->file('lampiran_promosi');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/employee_promotion'), $filename);
        }

        $request->merge(['attachment' => $filename]);

        EmployeePromotion::create([
            'employee_id' => $request->employee_id,
            'title' => $request->title,
            'description' => $request->description,
            'promotion_date' => $request->promotion_date,
            'attachment' => $filename,
        ]);

        return redirect()->back()->with('success', 'Promosi berhasil ditambahkan');
    }

    public function updatePromotion(Request $request, $id)
    {
        $promotion = EmployeePromotion::find($id);

        $filename = null;

        if ($request->hasFile('lampiran_promosi')) {
            $file = $request->file('lampiran_promosi');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/employee_promotion'), $filename);
            $request->merge(['attachment' => $filename]);
        }

        $promotion->update([
            'employee_id' => $request->employee_id,
            'title' => $request->title,
            'description' => $request->description,
            'promotion_date' => $request->promotion_date,
            'attachment' => $request->hasFile('lampiran_promosi') ? $filename : $promotion->attachment,
        ]);

        return redirect()->back()->with('success', 'Promosi berhasil diupdate');
    }

    public function destroyPromotion($id)
    {
        $promotion = EmployeePromotion::find($id);
        unlink(public_path('image/employee_promotion/' . $promotion->attachment));
        $promotion->delete();

        return redirect()->back()->with('success', 'Promosi berhasil dihapus');
    }

    public function indexResign()
    {
        $resigns = EmployeeResign::all();
        return view('admin.resign.view', compact('resigns'));
    }

    // approve resign request from employee
    public function approveResign(Request $request, $id)
    {
        $resign = EmployeeResign::find($id);
        $resign->status = 'approved';
        $resign->approved_by = auth()->user()->id;
        $resign->approved_resign_date = now();
        $resign->status_message = $request->message;
        $resign->save();

        return redirect()->back()->with('success', 'Resign berhasil disetujui');
    }

    // reject resign request from employee
    public function rejectResign(Request $request, $id)
    {
        $resign = EmployeeResign::find($id);
        $resign->status = 'rejected';
        $resign->approved_by = auth()->user()->id;
        $resign->status_message = $request->message;
        $resign->save();

        return redirect()->back()->with('success', 'Resign berhasil ditolak');
    }
}
