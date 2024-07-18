<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reimbursement;
use Illuminate\Support\Facades\Log;

class FinanceCtrl extends Controller
{
    public function getUserReimbursements()
    {
        $reimbursements = Reimbursement::where('user_id', auth()->user()->employee->id)->get();
        return response()->json($reimbursements, 200);
    }

    public function getDetailReimbursement($id)
    {
        $reimbursement = Reimbursement::find($id);
        return response()->json($reimbursement, 200);
    }

    public function submitReimbursement(Request $request)
    {
        try {
            $filename = null;

            if ($request->hasFile('lampiran')) {
                $attachment = $request->file('lampiran');
                $filename = time() . '.' . $attachment->getClientOriginalExtension();
                $attachment->move(public_path('image/reimbursement'), $filename);
            }

            $reimbursement = new Reimbursement();
            $reimbursement->user_id = auth()->user()->employee->id;
            $reimbursement->amount = $request->amount;
            $reimbursement->title = $request->title;
            $reimbursement->description = $request->description;
            $reimbursement->attachment = $filename;
            $reimbursement->status = 'pending';
            $reimbursement->save();
            return response()->json(['message' => 'Reimbursement request submitted successfully'], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Server error'], 500);
        }
    }
}
