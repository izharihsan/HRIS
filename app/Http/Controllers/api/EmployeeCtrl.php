<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeCtrl extends Controller
{

    public function getProfile()
    {
        try {
            $user = User::with([
                'employee' => function ($query) {
                    $query->select('id', 'name', 'email', 'telpon', 'status_pernikahan', 'province_id', 'city_id', 'district_id', 'village_id', 'jenis_kelamin', 'rt', 'rw', 'kode_pos', 'alamat', 'tanggal_join', 'tempat_lahir', 'tanggal_lahir');
                },
                'employee.province' => function ($query) {
                    $query->select('id', 'name');
                },
                'employee.city' => function ($query) {
                    $query->select('id', 'name');
                },
                'employee.district' => function ($query) {
                    $query->select('id', 'name');
                },
                'employee.village' => function ($query) {
                    $query->select('id', 'name');
                },
            ])->find(auth()->user()->id);

            // yg bisa mengajukancuti hanya karyawan yg sudah 1 tahun dan ditampilkan di profile sisa cuti yg belum diambil
            $tahun_masuk = date('Y', strtotime($user->employee->tanggal_join));
            $tahun_sekarang = date('Y');

            if ($tahun_sekarang - $tahun_masuk >= 1) {
                $user->employee->sisa_cuti = 12;
            } else {
                $user->employee->sisa_cuti = 0;
            }

            return response()->json($user, 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Failed to get user.'
            ], 500);
        }
    }

    public function updateProfilePersonal(Request $request)
    {
        try {
            $user = User::find(auth()->user()->id);
            $user->name = $request->name;
            $user->save();

            $employee = $user->employee;
            $employee->name = $request->employee['name'];
            $employee->status_pernikahan = $request->employee['status_pernikahan'];
            $employee->jenis_kelamin = $request->employee['jenis_kelamin'];
            $employee->save();

            return response()->json([
                'message' => 'Profile has been updated.'
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Failed to update profile.'
            ], 500);
        }
    }

    public function updateProfileContact(Request $request)
    {
        try {
            $user = User::find(auth()->user()->id);

            $employee = $user->employee;
            $employee->province_id = $request->employee['province_id'];
            $employee->city_id = $request->employee['city_id'];
            $employee->district_id = $request->employee['district_id'];
            $employee->village_id = $request->employee['village_id'];
            $employee->rt = $request->employee['rt'];
            $employee->rw = $request->employee['rw'];
            $employee->kode_pos = $request->employee['kode_pos'];
            $employee->alamat = $request->employee['alamat'];
            $employee->telpon = $request->employee['telpon'];

            $employee->save();

            return response()->json([
                'message' => 'Profile has been updated.'
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Failed to update profile.'
            ], 500);
        }
    }
}
