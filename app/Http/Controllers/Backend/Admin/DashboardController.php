<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanApplication;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $totalUsers = User::where('role', 'user')->count();
        $loanApplications = LoanApplication::count();
        $approvedLoans = LoanApplication::where('status', 'approved')->count();
        $pendingLoans = LoanApplication::where('status', 'not_approved')->count();

        return view('admin.dashboard.index', compact('totalUsers', 'loanApplications', 'approvedLoans', 'pendingLoans'));
    }

    public function chartData()
    {
        $totalUsers = User::where('role', 'user')->count();
        $loanApplications = LoanApplication::count();
        $approvedLoans = LoanApplication::where('status', 'approved')->count();
        $pendingLoans = LoanApplication::where('status', 'not_approved')->count();

        return response()->json([
            'totalUsers' => $totalUsers,
            'loanApplications' => $loanApplications,
            'approvedLoans' => $approvedLoans,
            'pendingLoans' => $pendingLoans,
        ]);
    }
}
