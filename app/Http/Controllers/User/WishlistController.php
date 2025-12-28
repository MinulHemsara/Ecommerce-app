<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

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
}