<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function subCategory()
    {
        $subcategory = SubCategory::latest()->get();
        return view('backend.subcategory.subcategory_all', compact('subcategory'));
    }

    public function addsubCategory()
    {
        $category = Category::orderBy('category_name', 'ASC')->get();
        return view('backend.subcategory.subcategory_add', compact('category'));
    }

    public function storeSubCategory(Request $request)
    {

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),

        ]);

        $notification = ['message' => 'SubCategory inserted successfully', 'alert-type' => 'success'];

        return redirect()->route('all.subcategory')->with($notification);
    }


    public function editSubCategory($id)
    {

        $category = Category::orderBy('category_name', 'ASC')->get();
        $subCategory = SubCategory::findOrFail($id);
        return view('backend.subcategory.subcategory_edit', compact('category', 'subCategory'));
    }

    public function updateSubCategory(Request $request) {
        $sub_id = $request->id;
        SubCategory::findOrFail($sub_id )->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),

        ]);

        $notification = ['message' => 'SubCategory updated successfully', 'alert-type' => 'success'];

        return redirect()->route('all.subcategory')->with($notification);
    }

    public function deleteSubCategory($id){
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();

        $notification = ['message' => 'SubCategory deleted successfully', 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }
}