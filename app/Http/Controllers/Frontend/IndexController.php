<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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

}
