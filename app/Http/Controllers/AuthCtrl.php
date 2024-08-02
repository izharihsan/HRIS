<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthCtrl extends Controller
{
    // login web process with auth attempt method
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            $roles = [1, 2, 3, 4, 7, 8, 9];

            if (!in_array(auth()->user()->role_id, $roles)) {
                auth()->logout();
                return back()->withErrors([
                    'email' => 'Access denied.',
                ]);
            }

            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return back()->withErrors([
            'email' => 'Email or password is incorrect.',
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
