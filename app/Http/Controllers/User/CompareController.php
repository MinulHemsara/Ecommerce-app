<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    public function addToCompare(Request $request, $product_id)
    {
        if (auth()->check()) {
            $exists = Compare::where('user_id', auth()->id())
                ->where('product_id', $product_id)
                ->first();

            if ($exists) {
                return response()->json(['error' => 'Product Already in Your Compare List']);
            }

            Compare::create([
                'user_id' => auth()->id(),
                'product_id' => $product_id,
                'created_at' => now(),
            ]);
        } else {
            return response()->json(['error' => 'You Need to Login First']);
        }

        return response()->json(['success' => 'Successfully Added on Your Compare List']);
    }

    public function allCompare(){
        return view('frontend.compare.view_compare');
    }

    public function getCompareProduct(){
        $compare = Compare::with('product')->where('user_id', auth()->id())->latest()->get();
        
        return response()->json($compare);
    }

    public function compareRemove($id){
        Compare::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success' => 'Successfully Product Remove']);
    }
}
