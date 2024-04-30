<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanApplication;
class LoanController extends Controller
{

    public function allLoanApplications(){

        $loan = LoanApplication::latest()->get();
        return view('admin.loan_application.all', compact('loan'));
    }


    public function loanApplication(){

        return view('user.loan_application.application');
    }

}
