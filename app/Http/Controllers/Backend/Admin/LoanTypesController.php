<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanTypes;
use Illuminate\Http\Response;

class LoanTypesController extends Controller
{
   public function allLoanTypes()
   {

    $loan_type = LoanTypes::latest()->get();
    return view('admin.loan_type.all_loan_type' , compact('loan_type'));
   }

   public function addLoanTypes(Request $request)
   {
     $validateData = $request->validate([
        'loanType' =>'required',
     ]);


     $loan_type = new LoanTypes();
     $loan_type-> name=$validateData['loanType'];

     $loan_type->save();

     toastr()->success('The Loan Type has been added successfully!', 'Done!');
     return redirect()->back();
   }

   public function deleteLoanType($id){
       $loan_tye = LoanTypes::findOrFail($id);
        $loan_tye->delete();


        toastr()->success('loan type has been deleted successfully!', 'Done!');
        // return redirect()->back();
        return response()->json(['message' => 'loan type has been deleted successfully!.'], Response::HTTP_OK);

}

    public function editLoanTypes($id){
        $loanType =LoanTypes::findOrFail($id);
        return view('admin.loan_type.edit',compact('loanType'));

    }

    public function updateLoanTypes(Request $request, $id){

        $loanType=LoanTypes::findOrFail($id);

        $validateData = $request->validate([
            'loanType' =>'required',
         ]);

         $loanType->update([

            'name'=> $validateData['loanType'],

         ]);

         toastr()->success('loan type has been Updated successfully!', 'Done!');
           return redirect()->route('admin.all.loan.types');
    }

}
