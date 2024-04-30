<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserControllers extends Controller
{
    public function allUsers(){
        $users = User::latest()->get();
        return view('admin.users.all_users', compact('users'));
    }


    public function deleteUser(User $user){

        $user->delete();

        toastr()->success('User has been deleted successfully!', 'Done!');
        return redirect()->back();

    }

    public function userDetails($id){
        $user = user::findOrFail($id);
        return view('admin.users.detail', compact('user'));

    }



    public function toggleRole(Request $request,$id){

        $user=user::findOrFail($id);
        $user->role=($request->has('role')) ? 'admin' : 'user';
        $user->save();



        toastr()->success('role has been updated successfully!', 'Done!');
        return redirect()->back();
    }

    public function toggleStatus(Request $request,$id){

        $user=user::findOrFail($id);
        $user->status=($request->has('status')) ? 'active' : 'inactive';
        $user->save();



        toastr()->success('status has been updated successfully!', 'Done!');
        return redirect()->back();
    }

}
