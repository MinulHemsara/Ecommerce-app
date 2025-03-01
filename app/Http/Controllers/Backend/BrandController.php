<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class BrandController extends Controller
{
    public function allBrand()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_all', compact('brands'));
    }

    public function addBrand()
    {
        return view('backend.brand.brand_add');
    }

    public function StoreBrand(Request $request)
    {
        $image = $request->file('brand_image');
        if ($image) {
            $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        } else {
            $name = null;
        }
        !empty(Image::make($image)->resize(300, 300)->save('upload/brand/' . $name)) ? Image::make($image)->resize(300, 300)->save('upload/brand/' . $name) : null;
        $save_url = 'upload/brand/' . $name;


        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            'brand_image' => $save_url,
        ]);

        $notification = ['message' => 'Brand inserted successfully', 'alert-type' => 'success'];

        return redirect()->route('all.brand')->with($notification);
    }

    public function editBrand($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    public function updateBrand(Request $request)
    {
        $brand_id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('brand_image')) {
            
            $image = $request->file('brand_image');
            
            if ($image) {
                $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            } else {
                $name = null;
            }
            
            !empty(Image::make($image)->resize(300, 300)->save('upload/brand/' . $name)) ? Image::make($image)->resize(300, 300)->save('upload/brand/' . $name) : null;
            $save_url = 'upload/brand/' . $name;

            if(file_exists($old_image)){
                unlink($old_image);
            }

            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'brand_image' => $save_url,
            ]);

            $notification = ['message' => 'Brand updated successfully', 'alert-type' => 'success'];

            return redirect()->route('all.brand')->with($notification);
            
        }else{
            
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            ]);

            $notification = ['message' => 'Brand updated successfully', 'alert-type' => 'success'];

            return redirect()->route('all.brand')->with($notification);
        }
    }

    public function deleteBrand($id){
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        if (file_exists($img)) {
            unlink($img);
        } else {
            $brand->delete();
        }
        $brand->delete();

        $notification = ['message' => 'Brand deleted successfully', 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }
}