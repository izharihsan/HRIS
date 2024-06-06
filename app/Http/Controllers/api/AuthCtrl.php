<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthCtrl extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            // $roles = [5, 6, 7, 8, 9];

            // if (!in_array(auth()->user()->role_id, $roles)) {
            //     auth()->logout();
            //     return response()->json([
            //         'message' => 'Access denied.'
            //     ], 401);
            // }

            if (auth()->user()->status == 0) {
                auth()->logout();
                return response()->json([
                    'message' => 'Your account is not active.'
                ], 401);
            }

            // generate sanctum token
            $token = auth()->user()->createToken(auth()->user()->email)->plainTextToken;
            return response()->json([
                'message' => 'Login success.',
                'token' => $token
            ], 200);
        }
        return response()->json([
            'message' => 'Email or password is incorrect.'
        ], 401);
    }

    public function check_is_new_pin_or_not()
    {
        if (auth()->user()->pin_code == null) {
            return response()->json([
                'message' => 'You have not set your pin yet.'
            ], 400);
        } else {
            return response()->json([
                'message' => 'You have set your pin.'
            ], 200);
        }
    }

    public function update_pin(Request $request)
    {
        try {
            $user = auth()->user();
            $user->pin = password_hash($request->pin_code, PASSWORD_DEFAULT);
            User::select('pin_code')->where('id', $user->id)->update(['pin_code' => $user->pin]);
            return response()->json([
                'message' => 'Pin has been updated.'
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Failed to update pin.'
            ], 500);
        }
    }

    public function validate_pin(Request $request)
    {
        try {
            $user = auth()->user();
            if (password_verify($request->pin_code, $user->pin_code)) {
                return response()->json([
                    'message' => 'Pin is correct.'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Pin is incorrect.'
                ], 400);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Failed to validate pin.'
            ], 500);
        }
    }

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

            return response()->json($user, 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Failed to get user.'
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logout success.'
        ], 200);
    }
}
