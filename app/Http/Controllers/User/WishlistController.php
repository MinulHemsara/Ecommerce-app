<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{
    public function addToWishList(Request $request, $product_id)
    {
        if (auth()->check()) {
            $exists = Wishlist::where('user_id', auth()->id())
                ->where('product_id', $product_id)
                ->first();

            if ($exists) {
                return response()->json(['error' => 'Product Already in Your Wishlist']);
            }

            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $product_id,
            ]);
        } else {
            return response()->json(['error' => 'You Need to Login First']);
        }

        return response()->json(['success' => 'Successfully Added on Your Wishlist']);
    }

    public function allWishList()
    {
        // $wishlists = Wishlist::with('product')->where('user_id', auth()->id())->latest()->get();
        return view('frontend.wishlist.view_wishlist');
    }

    public function getWishListProduct()
    {
        $wishlists = Wishlist::with('product')->where('user_id', auth()->id())->latest()->get();
        $count = $wishlists->count();

        Log::info('Wishlist count for user ' . auth()->id() . ': ' . $count);

        return response()->json(['wishlists' => $wishlists, 'count' => $count]);
    }

    public function wishListRemove($id){

        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success'=>'Successfully Removed From Your Wishlist']);

    }
}