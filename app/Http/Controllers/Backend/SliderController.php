<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;


class SliderController extends Controller
{
    public function allSlider()
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_all', compact('sliders'));
    }

    public function addSlider()
    {

        return view('backend.slider.slider_add');
    }

    public function storeSlider(Request $request)
    {
        $image = $request->file('slider_image');
        if ($image) {
            $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        } else {
            $name = null;
        }
        !empty(Image::make($image)->resize(300, 300)->save('upload/slider/' . $name)) ? Image::make($image)->resize(300, 300)->save('upload/slider/' . $name) : null;
        $save_url = 'upload/slider/' . $name;


        Slider::insert([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
            'slider_image' => $save_url,
        ]);

        $notification = ['message' => 'Category inserted successfully', 'alert-type' => 'success'];

        return redirect()->route('all.slider')->with($notification);
    }

    public function editSlider($id)
    {
        $slider = Slider::findOrFail($id);
        return view('backend.slider.slider_edit', compact('slider'));
    }

    public function updateSlider(Request $request)
    {
        $slider_id = $request->id;
        $old_image = $request->old_image;

        
        if ($request->file('slider_image')) {
            
            $image = $request->file('slider_image');

            $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/slider/' . $name);
            $save_url = 'upload/slider/' . $name;

            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
                'slider_image' => $save_url,
            ]);
        } else {
            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
            ]);
        }

        $notification = ['message' => 'Slider updated successfully', 'alert-type' => 'success'];

        return redirect()->route('all.slider')->with($notification);
    }

    public function deleteSlider($id)
    {
        $slider = Slider::findOrFail($id);
        $img = $slider->category_image;
        if (file_exists($img)) {
            unlink($img);
        } else {
            $slider->delete();
        }
        $slider->delete();

        $notification = ['message' => 'Slider deleted successfully', 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }
}
