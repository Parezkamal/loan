<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\Admin\UserControllers;
use App\Http\Controllers\Backend\Admin\LoanTypesController;
use App\Http\Controllers\Backend\Admin\LoanController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashbord', [AdminController::class,'index'])->name('admin.dashboard');

    Route::get('/admin/profile', [AdminController::class,'profile'])->name('admin.profile');
    Route::post('/admin/update/profile', [AdminController::class,'updateProfile'])->name('admin.profile.update');
    Route::get('/admin/update/password', [AdminController::class,'updatePassword'])->name('admin.password.update');
    Route::post('/admin/store/password', [AdminController::class,'storePassword'])->name('admin.password.store');

    Route::get('/admin/all/users', [UserControllers::class,'allusers'])->name('admin.all.users');
    Route::delete('admin/delete/{user}',[UserControllers::class,'deleteUser'])->name('delete.user');
    Route::get('admin/user/detail/{id}',[UserControllers::class, 'userDetails'])->name('user.detail');
    Route::post('admin/user/{id}/toggle-role',[UserControllers::class, 'toggleRole'])->name('user.toggle.role');
    Route::post('admin/user/{id}/toggle-status',[UserControllers::class, 'toggleStatus'])->name('user.toggle.status');

    Route::get('/admin/all/loan/types', [LoanTypesController::class,'allLoanTypes'])->name('admin.all.loan.types');
    Route::post('/admin/add/loan_type', [LoanTypesController::class,'addLoanTypes'])->name('admin.add.loan.type');
    Route::delete('admin/delete/loan_type/{id}',[LoanTypesController::class,'deleteLoanType'])->name('delete.loan_type');
    Route::get('/admin/loan-types/{id}/edit', [LoanTypesController::class,'editLoanTypes'])->name('admin.edit.loan.type');
    Route::put('/admin/loan-types/{id}', [LoanTypesController::class,'updateLoanTypes'])->name('admin.update.loan.type');

    Route::get('/admin/all/loan/applications', [LoanController::class,'allLoanApplications'])->name('admin.all.loan.applications');
    Route::get('/admin/all/approved/loans', [LoanController::class,'allApprovedLoan'])->name('admin.all.approved.loans');
    Route::get('admin/loan/detail/{id}',[LoanController::class, 'loanDetails'])->name('loan.detail');
    Route::post('admin/loan/{id}/toggle-status',[LoanController::class, 'toggleStatus'])->name('loan.toggle.status');


});

Route::middleware(['auth','role:user'])->group(function(){
    Route::get('/user/dashbord', [UserController::class,'index'])->name('user.dashboard');

    Route::get('/user/profile', [UserController::class,'profile'])->name('user.profile');
    Route::post('/user/update/profile', [UserController::class,'updateProfile'])->name('user.profile.update');
    Route::get('/user/update/password', [UserController::class,'updatePassword'])->name('user.password.update');
    Route::post('/user/store/password', [UserController::class,'storePassword'])->name('user.password.store');

    Route::get('/user/loan/application', [LoanController::class,'loanApplication'])->name('user.loan.application');
    Route::post('/user/loan/store', [LoanController::class,'loanStore'])->name('user.loan.store');
    Route::get('/user/approved/loan', [LoanController::class,'approvedLoan'])->name('user.approved.loan');
});

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store'])
                ->name('register.store');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login.create');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])
            ->name('login.store');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

require __DIR__.'/auth.php';
