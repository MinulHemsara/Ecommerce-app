<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $price = $product->discount_price ?? $product->selling_price;

        Cart::add([
            'id' => $product->id,
            'name' => $product->product_name,
            'qty' => $request->qty,
            'weight' => 1,
            'price' => $price,
            'options' => [
                'image' => $product->product_thambnail,
                'color' => $request->color,
                'size' => $request->size,
            ],
        ]);

        return response()->json(['success' =>'Product added to cart successfully.']);
    }

    public function productMiniCart()
    {
        $cartItems = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
            'cartItems' => $cartItems,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,
        ]);
    }

    public function removeMiniCartProduct($rowId)
    {
        Cart::remove($rowId);

        return response()->json(['success' => 'Product removed from cart successfully.']);
    }

    public function addToCartDetails(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $price = $product->discount_price ?? $product->selling_price;

        Cart::add([
            'id' => $product->id,
            'name' => $product->product_name,
            'qty' => $request->qty,
            'weight' => 1,
            'price' => $price,
            'options' => [
                'image' => $product->product_thambnail,
                'color' => $request->color,
                'size' => $request->size,
            ],
        ]);

        return response()->json(['success' =>'Product added to cart successfully.']);
    }

    public function myCart(){

        return view('frontend.mycart.view_mycart');
    }

    public function getCartProducts(){

        $cartItems = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
            'cartItems' => $cartItems,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,
        ]);

    }
}