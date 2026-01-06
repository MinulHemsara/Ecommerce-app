<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function addToCompare(Request $request, $id)
    {
        if (auth()->check()) {
            $exists = Compare::where('user_id', auth()->id())
                ->where('product_id', $id)
                ->first();

            if ($exists) {
                return response()->json(['error' => 'Product Already in Your Compare List']);
            }

            Compare::create([
                'user_id' => auth()->id(),
                'product_id' => $id,
            ]);
        } else {
            return response()->json(['error' => 'You Need to Login First']);
        }

        return response()->json(['success' => 'Successfully Added on Your Compare List']);
    }
}
