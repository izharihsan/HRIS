<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reimbursement;

class FinanceCtrl extends Controller
{
    public function reimbursements()
    {
        $reimbursements = Reimbursement::all();
        return view('admin.finance.reimbursements', compact('reimbursements'));
    }

    public function approveReimbursement(Request $request)
    {
        $reimbursement = Reimbursement::find($request->id);
        $reimbursement->status = 'approved';
        $reimbursement->approved_by = auth()->user()->id;
        $reimbursement->status_message = $request->status_message;
        $reimbursement->save();

        return redirect()->back()->with('success', 'Reimbursement approved successfully');
    }

    public function rejectReimbursement(Request $request)
    {
        $reimbursement = Reimbursement::find($request->id);
        $reimbursement->status = 'rejected';
        $reimbursement->approved_by = auth()->user()->id;
        $reimbursement->status_message = $request->status_message;
        $reimbursement->save();

        return redirect()->back()->with('success', 'Reimbursement rejected successfully');
    }
}
