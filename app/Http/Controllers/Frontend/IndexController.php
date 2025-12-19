<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
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


        return view('frontend.product.product_details', compact('product', 'product_color', 'product_size','multiImg','relatedProduct'));
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

        if($skip_category_3){
            $skip_product_3 = Product::where('status', 1)->where('category_id', optional($skip_category_3)->id)
                ->orderBy('id', 'DESC')->limit(5)->get();
        }else{
            $skip_product_3 = collect();
        }

        $hot_deals = Product::where('hot_deals', 1)->where('discount_price', '!=', NULL)
            ->orderBy('id', 'DESC')->limit(3)->get();  

        $special_offer = Product::where('special_offer', 1)->orderBy('id','DESC')->limit(3)->get();

        $new = Product::where('status',1)->orderBy('id','DESC')->limit(3)->get();

        $special_deals = Product::where('special_deals',1)->orderBy('id','DESC');

        return view('frontend.index', compact('skip_category_0', 'skip_product_0', 'skip_category_2', 'skip_product_2', 'skip_category_3', 'skip_product_3', 'hot_deals', 'special_offer','new','special_deals'));
    }
 
}
