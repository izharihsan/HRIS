<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserCtrl extends Controller
{
    public function update_user(Request $request)
    {
        try {
            $user = User::find(auth()->user()->id);
            $user_id = auth()->user()->id;

            $user->update($request->all());

            return response()->json([
                'message' => 'User updated successfully',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'User update failed',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
