<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


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
    
}
