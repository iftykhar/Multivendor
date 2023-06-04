<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;
use Illuminate\Support\Str;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index(){
        return view('admin.brand.add');
    }

    public function store(Request $request){
        $request->validate([
            'brand_name' => 'required',
            'brand_image' => 'required'
        ]);

        $brand = new Brand;
        $brand->brand_name  = $request->brand_name;
        $brand->brand_slug = Str::slug($request->brand_name);
        if($request->brand_image){
            $image = $request->file('brand_image');
            $customName = rand().".".$image->getClientOriginalExtension();
            $path = public_path('uploads/brand/'.$customName);
            Image::make($image)->resize('100','100')->save($path);
            $brand->brand_image = $customName;
        }
        $brand->save();

        $notice = [
            'type' => 'success',
            'message' => 'Brand sucessfully added'
        ];
        return back()->with('success','Brand sucessfully added');
    }

    public function manage(){
        $brands = Brand::all();
        return view('admin.brand.manage',compact('brands'));
    }
}
