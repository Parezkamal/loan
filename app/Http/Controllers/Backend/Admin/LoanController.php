<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanApplication;
use App\Models\LoanTypes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class LoanController extends Controller
{

    public function allLoanApplications(){

        $loan = DB::table('loan_applications')->where('status','not_approved')->get();
        return view('admin.loan_application.all', compact('loan'));
    }


    public function allApprovedLoan(){

        $loan = DB::table('loan_applications')->where('status','approved')->get();
        return view('admin.loan_application.approved', compact('loan'));

    }

    public function loanApplication(){

        $loan_types = LoanTypes::all();

        return view('user.loan_application.application', compact('loan_types'));
    }


    public function loanStore(Request $request)
    {
        $id=Auth::user()->id;

        $data = User::find($id);

        $today =Carbon::now();

        $formattedDate = $today->format('Y-m-d');


        LoanApplication::insert([
            'name'=> $data->name,
            'email'=> $data->email,
            'amount'=>$request->amount,
            'bank'=> $request->bank,
            'account'=> $request->account_no,
            'loan_type'=> $request->loan_type,
            'installment_count'=>$request->installment_counts,
            'installment_amount'=>$request->installment_amount,
            'amount_payable'=>$request->amount_payable,
            'date_applied'=>$formattedDate,
            'status'=> 'not_approved',
        ]);

        toastr()->success('Loan Applied successfully!', 'Done!');
        return redirect()->back();
    }

    public function loanDetails($id){
        $loan = LoanApplication::findOrFail($id);
        return view('admin.loan_application.detail', compact('loan'));


    }


    public function toggleStatus(Request $request,$id){

        $loan=LoanApplication::findOrFail($id);
        $loan->status=($request->has('status')) ? 'approved' : 'not_approved';
        $loan->save();



        toastr()->success('status has been updated successfully!', 'Done!');
        return redirect()->back();
    }


    public function approvedLoan(){

        $email= auth()->user()->email;

        $loan = DB::table('loan_applications')->where('email',$email)->where('status','approved')->get();
        return view('user.loan_application.approved', compact('loan'));

    }


}
