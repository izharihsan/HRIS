<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Jabatan;

class PerusahaanCtrl extends Controller
{
    public function indexBranch()
    {
        $branchs = Branch::all();
        return view('admin.perusahaan.branch.view', compact('branchs'));
    }

    public function storeBranch(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'lokasi' => 'required',
            'alamat' => 'required',
            'telpon' => 'required',
        ]);

        // random number for kolom id
        $request['id'] = rand(1000, 9999);
        $request['created_by'] = auth()->user()->id;
        $request['updated_by'] = auth()->user()->id;

        Branch::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function updateBranch(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'lokasi' => 'required',
            'alamat' => 'required',
            'telpon' => 'required',
        ]);

        Branch::find($id)->update($request->all());
        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    public function destroyBranch($id)
    {
        Branch::find($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    // JABATAN
    public function indexJabatan()
    {
        $jabatans = Jabatan::all();
        return view('admin.perusahaan.jabatan.view', compact('jabatans'));
    }

    public function storeJabatan(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        // random number for kolom id
        $request['id'] = rand(1000, 9999);
        $request['created_by'] = auth()->user()->id;
        $request['updated_by'] = auth()->user()->id;
        $request['description'] = $request->description ?? '-';

        Jabatan::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function updateJabatan(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $request['description'] = $request->description ?? '-';

        Jabatan::find($id)->update($request->all());
        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    public function destroyJabatan($id)
    {
        Jabatan::find($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
