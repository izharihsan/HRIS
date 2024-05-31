<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthCtrl extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            // // $roles = [1, 2, 3, 4, 7, 8, 9];

            // if (!in_array(auth()->user()->role_id, $roles)) {
            //     auth()->logout();
            //     return response()->json([
            //         'message' => 'Access denied.'
            //     ], 401);
            // }

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

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logout success.'
        ], 200);
    }
}
