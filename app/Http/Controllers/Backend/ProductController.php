<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    public function allProduct()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_all', compact('products'));
    }

    public function addProduct()
    {
        $activeVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('backend.product.product_add', compact('brands', 'categories', 'activeVendor'));
    }

    public function storeProduct(Request $request){

        $validatedData = $request->validate([
            'brand_id'         => 'required|integer|exists:brands,id',
            'category_id'      => 'required|integer|exists:categories,id',
            'subcategory_id'   => 'required|integer|exists:sub_categories,id',
            'product_name'     => 'required|string|max:255',
            'product_code'     => 'required|string|max:100|unique:products,product_code',
            'product_qty'      => 'required|integer|min:1',
            'product_tags'     => 'nullable|string',
            'product_size'     => 'nullable|string',
            'product_color'    => 'nullable|string',
            'selling_price'    => 'required|numeric|min:0',
            'discount_price'   => 'nullable|numeric|min:0|lt:selling_price',
            'short_descp'      => 'nullable|string',
            'long_descp'       => 'nullable|string',
            'hot_deals'        => 'nullable|boolean',
            'featured'         => 'nullable|boolean',
            'special_offer'    => 'nullable|boolean',
            'special_deals'    => 'nullable|boolean',
            'product_thambnail'=> 'required|image|mimes:jpg,jpeg,png,webp|max:2048', 
        ]);

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
            'brand_id'         => $validatedData['brand_id'],
            'category_id'      => $validatedData['category_id'],
            'subcategory_id'   => $validatedData['subcategory_id'],
            'product_name'     => $validatedData['product_name'],
            'product_slug'     => strtolower(str_replace(' ', '-', $validatedData['product_name'])),
            'product_code'     => $validatedData['product_code'],
            'product_qty'      => $validatedData['product_qty'],
            'product_tags'     => $validatedData['product_tags'] ?? null,
            'product_size'     => $validatedData['product_size'] ?? null,
            'product_color'    => $validatedData['product_color'] ?? null,
            'selling_price'    => $validatedData['selling_price'],
            'discount_price'   => $validatedData['discount_price'] ?? null,
            'short_descp'      => $validatedData['short_descp'] ?? null,
            'long_descp'       => $validatedData['long_descp'] ?? '',
            'hot_deals'        => $validatedData['hot_deals'] ?? 0,
            'featured'         => $validatedData['featured'] ?? 0,
            'special_offer'    => $validatedData['special_offer'] ?? 0,
            'special_deals'    => $validatedData['special_deals'] ?? 0,
            'vendor_id'        => $request->vendor_id ?? null,
            'status'           => 1,
            'product_thambnail'=> $save_url,
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
        
        $notification = ['message' => 'Product Insert Success','alert_type' => 'Success'];
        return redirect()->route('all.product')->with($notification);
    }

    public function editProduct($id){

        $activeVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('backend.product.product_edit', compact('brands', 'categories', 'activeVendor', 'products', 'subcategory'));
    }
}