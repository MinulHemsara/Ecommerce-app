<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Baner;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class bannerController extends Controller
{
    public function allBaner()
    {
        $banners = Baner::latest('id')->get();
        return view('backend.baner.baner_all', compact('banners'));
    }

    public function addBaner()
    {
        return view('backend.baner.baner_add');
    }

    public function storeBanner(Request $request)
    {
        $image = $request->file('banner_image');
        if ($image) {
            $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        } else {
            $name = null;
        }
        !empty(Image::make($image)->resize(300, 300)->save('upload/banner/' . $name)) ? Image::make($image)->resize(300, 300)->save('upload/banner/' . $name) : null;
        $save_url = 'upload/banner/' . $name;


        Baner::insert([
            'baner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'baner_image' => $save_url,
        ]);

        $notification = ['message' => 'Banner inserted successfully', 'alert-type' => 'success'];

        return redirect()->route('all.baner')->with($notification);
    }

    public function editBanner($id)
    {
        $banner = Baner::findOrFail($id);
        return view('backend.baner.baner_edit', compact('banner'));
    }

    public function updateBanner(Request $request)
    {
        $banner_id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('banner_image')) {
            
            $image = $request->file('banner_image');
            if ($image) {
                $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            } else {
                $name = null;
            }
            !empty(Image::make($image)->resize(300, 300)->save('upload/banner/' . $name)) ? Image::make($image)->resize(300, 300)->save('upload/banner/' . $name) : null;
            $save_url = 'upload/banner/' . $name;

            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Baner::findOrFail($banner_id)->update([
                'baner_title' => $request->baner_title,
                'banner_url' => $request->banner_url,
                'baner_image' => $save_url,
            ]);

            $notification = ['message' => 'Banner updated successfully', 'alert-type' => 'success'];

            return redirect()->route('all.baner')->with($notification);
        } else {

            Baner::findOrFail($banner_id)->update([
                'baner_title' => $request->baner_title,
                'banner_url' => $request->banner_url,
            ]);

            $notification = ['message' => 'Banner updated successfully', 'alert-type' => 'success'];

            return redirect()->route('all.baner')->with($notification);
        }
    }
    
    public function deleteBanner($id)
    {
        Baner::findOrFail($id)->delete();

        $notification = ['message' => 'Banner deleted successfully', 'alert-type' => 'success'];

        return redirect()->route('all.baner')->with($notification);
    }
}
