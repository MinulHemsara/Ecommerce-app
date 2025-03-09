<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;


class CategoryController extends Controller
{
    public function allCategory()
    {
        $category = Category::latest()->get();
        return view('backend.category.category_all', compact('category'));
    }

    public function addCategory()
    {
        return view('backend.category.category_add');
    }

    public function storeCategory(Request $request)
    {
        $image = $request->file('category_image');
        if ($image) {
            $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        } else {
            $name = null;
        }
        !empty(Image::make($image)->resize(300, 300)->save('upload/category/' . $name)) ? Image::make($image)->resize(300, 300)->save('upload/category/' . $name) : null;
        $save_url = 'upload/category/' . $name;


        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_namecategory_name)),
            'category_image' => $save_url,
        ]);

        $notification = ['message' => 'Category inserted successfully', 'alert-type' => 'success'];

        return redirect()->route('all.category')->with($notification);
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    public function updateCategory(Request $request)
    {
        $brand_id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('category_image')) {

            $image = $request->file('category_image');

            if ($image) {
                $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            } else {
                $name = null;
            }

            !empty(Image::make($image)->resize(300, 300)->save('upload/category/' . $name)) ? Image::make($image)->resize(300, 300)->save('upload/category/' . $name) : null;
            $save_url = 'upload/category/' . $name;

            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Category::findOrFail($brand_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'category_image' => $save_url,
            ]);

            $notification = ['message' => 'Brand updated successfully', 'alert-type' => 'success'];

            return redirect()->route('all.category')->with($notification);
        } else {

            Category::findOrFail($brand_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            ]);

            $notification = ['message' => 'Category updated successfully', 'alert-type' => 'success'];

            return redirect()->route('all.category')->with($notification);
        }
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $img = $category->category_image;
        if (file_exists($img)) {
            unlink($img);
        } else {
            $category->delete();
        }
        $category->delete();

        $notification = ['message' => 'Category deleted successfully', 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }
}