<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\MultiImg;
use Carbon\Carbon;

class VendorProductController extends Controller
{
    public function vendorAllProduct(){

        $id = Auth::user()->id;
        $products = Product::where('vendor_id',$id)->latest()->get();
        return view('vendor.backend.product.vendor_product_all', compact('products'));
    }

    
    public function vendorAddProduct(){

        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('vendor.backend.product.vendor_product_add',compact('brands','categories'));
    }

    public function vendorGetSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
        return json_encode($subcat);
    }

    public function vendorStoreProduct(Request $request)
    {
        $image = $request->file('product_thambnail');
        $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $path = 'upload/products/thambnail/';
        
        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), 0777, true);
        }

        Image::make($image)
            ->resize(800, 800)
            ->save(public_path($path . $name));

        $save_url = $path . $name;

        $product_id = Product::insertGetId([
            'brand_id'         => $request->brand_id,
            'category_id'      => $request->category_id,
            'subcategory_id'   => $request->subcategory_id,
            'product_name'     => $request->product_name,
            'product_slug'     => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_code'     => $request->product_code,
            'product_qty'      => $request->product_qty,
            'product_tags'     => $request->product_tags,
            'product_size'     => $request->product_size,
            'product_color'    => $request->product_color,
            'selling_price'    => $request->selling_price,
            'discount_price'   => $request->discount_price,
            'short_descp'      => $request->short_descp,
            'hot_deals'        => $request->hot_deals ?? 0,
            'featured'         => $request->featured ?? 0,
            'special_offer'    => $request->special_offer ?? 0,
            'special_deals'    => $request->special_deals ?? 0,
            'long_descp'       => $request->long_descp ?? '',
            'status'           => 1,
            'product_thambnail'=> $save_url,
            'vendor_id'        => Auth::user()->id,
            'created_at'       => Carbon::now(),
        ]);

        $images = $request->file('multi_img');
        if ($images) {
            foreach ($images as $img) {
                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)
                    ->resize(800, 800)
                    ->save(public_path('upload/products/multi-image/' . $make_name));
                $uploadPath = 'upload/products/multi-image/' . $make_name;

                MultiImg::insert([
                    'product_id' => $product_id,
                    'photo_name' => $uploadPath,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        $notification = ['message' => 'Product Insert Success', 'alert_type' => 'Success'];
        return redirect()->route('vendor.all.product')->with($notification);
    }


    public function vendorEditProduct($id){
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $multiImgs = MultiImg::where('product_id',$id)->get();
        $products = Product::findOrFail($id);
        return view('vendor.backend.product.vendor_product_edit',compact('brands','categories','subcategory','products','multiImgs'));
    }

    public function vendorUpdateProduct(Request $request, $id)
    {
         Product::findOrFail($id)->update([
            'brand_id'         => $request->brand_id,
            'category_id'      => $request->category_id,
            'subcategory_id'   => $request->subcategory_id,
            'product_name'     => $request->product_name,
            'product_slug'     => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_code'     => $request->product_code,
            'product_qty'      => $request->product_qty,
            'product_tags'     => $request->product_tags ?? null,
            'product_size'     => $request->product_size ?? null,
            'product_color'    => $request->product_color ?? null,
            'selling_price'    => $request->selling_price,
            'discount_price'   => $request->discount_price ?? null,
            'short_descp'      => $request->short_descp ?? null,
            // 'long_descp'       => $request->long_descp ?? '',
            'hot_deals'        => $request->has('hot_deals') ? 1 : 0,
            'featured'         => $request->has('featured') ? 1 : 0,
            'special_offer'    => $request->has('special_offer') ? 1 : 0,
            'special_deals'    => $request->has('special_deals') ? 1 : 0,
            'vendor_id'        => $request->vendor_id ?? null,
            'status'           => 1,
            'created_at'       => Carbon::now(),
        ]);

        $notification = ['message' => 'Product Updated Successfully','alert_type' => 'Success'];
        return redirect()->route('vendor.all.product')->with($notification);
    }

     public function updateProductMultiimage(Request $request){

        $imgs = $request->multi_img;

        foreach($imgs as $id => $img){

            $imgDel = MultiImg::findOrFail($id);
            if (file_exists(public_path($imgDel->photo_name))) {
                unlink(public_path($imgDel->photo_name));
            }    

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)
                ->resize(800, 800)
                ->save(public_path('upload/products/multi-image/' . $make_name));
            $uploadPath = 'upload/products/multi-image/' . $make_name;

            MultiImg::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),
            ]);

        }

        $notification = [
            'message' => 'Product Multi Image Updated Successfully',
            'alert_type' => 'Success'
        ];

        return redirect()->route('vendor.all.product')->with($notification);
    }

    public function vendorUpdateProductThambnail(Request $request)
    {
        $pro_id = $request->id;
        $old_img = $request->old_img;

        if ($request->file('product_thambnail')) {

            $image = $request->file('product_thambnail');
            $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $path = 'upload/products/thambnail/';

            if (!file_exists(public_path($path))) {
                mkdir(public_path($path), 0777, true);
            }

            Image::make($image)
                ->resize(800, 800)
                ->save(public_path($path . $name));

            $save_url = $path . $name;

            if (file_exists(public_path($old_img))) {
                unlink(public_path($old_img));
            }


            Product::findOrFail($pro_id)->update([
                'product_thambnail' => $save_url,
                'updated_at'        => Carbon::now(),
            ]);

            $notification = [
                'message' => 'Product Thambnail Image Updated Successfully',
                'alert_type' => 'Success'
            ];

            return redirect()->route('vendor.all.product')->with($notification);
        }
    }

    public function vendorProductInactive($id){

        Product::findOrFail($id)->update(['status' => 0]);
        $notification = [
                'message' => 'Product Thambnail Image Updated Successfully',
                'alert_type' => 'Success'
            ];

        return redirect()->back()->with($notification);
    }

    public function vendorProductActive($id){
        Product::findOrFail($id)->update(['status' => 1]);
        $notification = [
                'message' => 'Product Thambnail Image Updated Successfully',
                'alert_type' => 'Success'
            ];

        return redirect()->back()->with($notification);
    }

    public function vendorProductDelete($id){

        Product::find($id)->delete();

         $notification = [
            'message' => 'Product Deleted Successfully',
            'alert_type' => 'Success'
        ];

        return redirect()->back()->with($notification);

    }


}
