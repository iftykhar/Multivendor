<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function index(){
        return view('vendor.dashboard');
    }

    public function login(){
        return view("vendor.vendorlogin");
    }
    
    public function profile(){
        $vendorInfo = User::find(Auth::user()->id);
            return view('vendor.profile',compact('vendorInfo'));
        }
    
        public function logout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');
    }

    public function updateProfile(Request $request){

        $vendorData = User::find(Auth::user()->id);
        $vendorData->name = $request->name;
        $vendorData->username = $request->username;
        $vendorData->email  = $request->email ;
        $vendorData->phone = $request->phone;
        $vendorData->address = $request->address;

        if($request->image){
            $image = $request->file('image');
            $customName = rand().'.'.$image->getClientOriginalExtension();
            @unlink(public_path('uploads/vendor/'.$vendorData->profile_pic));
            $image->move(public_path('uploads/vendor/'),$customName);
            $vendorData->profile_pic = $customName;
        }

        $vendorData->update();
        return back();
    }

    public function changePassword(){
        return view('vendor.changepassword');
    }
    
    public function updatePassword(Request $request){
        $request->validate([
            'old_passwrod' => 'required',
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
