<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        return view("admin.dashboard");
    }

    public function login(){
        return view("admin.adminlogin");
    }
    
    public function profile(){
        $adminInfo = User::find(Auth::user()->id);
            return view('admin.profile',compact('adminInfo'));
        }
    
        public function logout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function updateProfile(Request $request){

        $adminData = User::find(Auth::user()->id);
        $adminData->name = $request->name;
        $adminData->username = $request->username;
        $adminData->email  = $request->email ;
        $adminData->phone = $request->phone;
        $adminData->address = $request->address;

        if($request->image){
            $image = $request->file('image');
            $customName = rand().'.'.$image->getClientOriginalExtension();
            @unlink(public_path('uploads/admin/'.$adminData->profile_pic));
            $image->move(public_path('uploads/admin/'),$customName);
            $adminData->profile_pic = $customName;
        }

        $adminData->update();
        return back();
    }

    public function changePassword(){
        return view('admin.changepassword');
    }
    
    public function updatePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);


        // find user 
        $find = User::find(Auth::user()->id);

        // password match 
        if(!Hash::check($request->old_password, $find->password)){
            // $msg = array(
            //     'message' => 'old password do not match',
            //     'type' => 'warning'
            // ); 
            return back()->with('error',"old password do not match");
        }

        // update password 
        $find->password = Hash::make($request->new_password);
        $find->update();
        // $msg = array(
        //     'message' => 'password changed',
        //     'type' => 'info'
        // );
        return back()->with('sucess',"password changed successfully");
    }
}


// <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
// <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

// @if(Session::has('success'))
//     <script>
//         toastr.options = {
//             "closeButton": true,
//             "progressBar": true
//         }
//         toastr.success("{{ session('success') }}");
//     </script>
//     @endif

//     @if(Session::has('error'))
//     <script>
//         toastr.options = {
//             "closeButton": true,
//             "progressBar": true
//         }
//         toastr.error("{{ session('error') }}");
//     </script>
//     @endif

//     @if(Session::has('warning'))
//     <script>
//         toa