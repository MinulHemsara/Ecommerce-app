<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function productDetails($id, $slug)
    {
        $product = Product::findOrFail($id);

        $product_color = explode(',', (string) $product->product_color);
        $product_size  = explode(',', (string) $product->product_size);

        $multiImg = MultiImg::where('product_id', $id)->get();

        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id', $cat_id)
            ->where('id', '!=', $id)
            ->orderBy('id', 'DESC')
            ->limit(4)
            ->get();


        return view('frontend.product.product_details', compact('product', 'product_color', 'product_size', 'multiImg', 'relatedProduct'));
    }

    public function Index()
    {
        $skip_category_0 = Category::skip(0)->first();

        $skip_product_0 = Product::where('status', 1)->where('category_id', $skip_category_0->id)
            ->orderBy('id', 'DESC')->limit(5)->get();

        $skip_category_2 = Category::skip(2)->first();

        $skip_product_2 = Product::where('status', 1)->where('category_id', $skip_category_2->id)
            ->orderBy('id', 'DESC')->limit(5)->get();

        $skip_category_3 = Category::skip(7)->first();

        if ($skip_category_3) {
            $skip_product_3 = Product::where('status', 1)->where('category_id', optional($skip_category_3)->id)
                ->orderBy('id', 'DESC')->limit(5)->get();
        } else {
            $skip_product_3 = collect();
        }

        $hot_deals = Product::where('hot_deals', 1)->where('discount_price', '!=', NULL)
            ->orderBy('id', 'DESC')->limit(3)->get();

        $special_offer = Product::where('special_offer', 1)->orderBy('id', 'DESC')->limit(3)->get();

        $new = Product::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();

        $special_deals = Product::where('special_deals', 1)->orderBy('id', 'DESC');

        return view('frontend.index', compact('skip_category_0', 'skip_product_0', 'skip_category_2', 'skip_product_2', 'skip_category_3', 'skip_product_3', 'hot_deals', 'special_offer', 'new', 'special_deals'));
    }

    public function vendorDetails($id)
    {
        $vendor = User::findOrFail($id);
        $vendorProducts = Product::where('vendor_id', $id)->get();
        return view('frontend.vendor.vendor_details', compact('vendor', 'vendorProducts'));
    }

    public function vendorAll(Request $request)
    {
        $search  = $request->input('search');
        $perPage = (int) $request->input('per_page', 12);

        $allowed = [12, 24, 50, 100, 150, 200];
        if (!in_array($perPage, $allowed)) {
            $perPage = 12;
        }

        $vendors = User::query()
            ->where('status', 'active')
            ->where('role', 'vendor')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('id', $search);
                });
            })
            ->withCount('products')
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();

        return view('frontend.vendor.vendor_all', compact('vendors', 'search', 'perPage'));
    }

    public function catWiseProduct($id, $slug)
    {
        $products = Product::where('status', 1)->where('category_id', $id)->orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $braedcat = Category::where('id', $id)->first();
        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.product.category_view', compact('products', 'categories', 'braedcat', 'newProduct'));
    }

    public function catWiseSubProduct($id, $slug)
    {
        $products = Product::where('status', 1)->where('subcategory_id', $id)->orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $braedsubcat = SubCategory::where('id', $id)->first();
        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.product.subcategory_view', compact('products', 'categories', 'braedsubcat', 'newProduct'));
    }

    public function productView($id)
    {
        $product = Product::with('category', 'brand')->findOrFail($id);

        $product_color = explode(',', (string) $product->product_color);
        $product_size  = explode(',', (string) $product->product_size);

        return response()->json(array(
            'product' => $product,
            'color'   => $product_color,
            'size'    => $product_size,
        ));
    }
}