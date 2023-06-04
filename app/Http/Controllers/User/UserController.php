<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use File;


class UserController extends Controller
{
    public function index(){
        $userData = User::find(Auth::User()->id);
        return view('index',compact('userData'));
    }

    public function updateUser(Request $request){

        $userData = User::find(Auth::User()->id);

        if($request->image){
            if(File::exists(public_path('uploads/user/').$userData->profile_pic)){
                File::delete(public_path('uploads/user/').$userData->profile_pic);
            }

            $image = $request->file('image');
            $customName = rand().".".$image->getClientOriginalExtension();
            $path = public_path('uploads/user/'.$customName);
            Image::make($image)->resize(200,200)->save($path);
            $userData->profile_pic = $customName;
        }
        $userData->name = $request->name;
        $userData->username = $request->username;
        $userData->email = $request->email;
        $userData->phone = $request->phone;
        $userData->address = $request->address;

        $userData->update();
        return back();

    }

    public function userLogout(Request $request){
        
            Auth::guard('web')->logout();
    
            $request->session()->invalidate();
    
            $request->session()->regenerateToken();
    
            return redirect('/login');
        
    }
}
