<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');
    }

    public function AdminDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminLogin(){
        return view('admin.admin_login');
    }

    public function AdminProfile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);

        return view('admin.admin_profile_view',compact('adminData'));
    }

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data= User::find($id);

        $data->name= $request->name;
        $data->email= $request->email;
        $data->phone= $request->phone;
        $data->address= $request->address;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_image'.$data->photo));
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_image'), $filename);
            $data['photo'] = $filename;
        }
        
        $data->save();

        $notification = ['message'=>'Admin profile updated successfully','alert-type'=>'success'];
        
        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword(){
        return view ('admin.admin_change_password');
    }
    
    public function AdminUpdatepassword(Request $request){
        $request->validate([
            'old_password'=>'required',
            'new_password' =>'required|confirmed',
        ]);

        if(!Hash::check($request->old_password, auth::user()->password)){
            return back()->with('error', 'Old Password Does not Match!!');
        }

        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->with('status', "Password Change Successfully");
    }
}