<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDivision;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{
    public function allDivision(){
        $division = ShipDivision::latest()->get();
        return view('backend.ship.division.division_all',compact('division'));
    }

    public function addDivision(){
        return view('backend.ship.division.division_add');
    }

    public function storeDivision(Request $request){
        $request->validate([
            'division_name' => 'required',
        ]);

        ShipDivision::insert([
            'division_name' => $request->division_name,
        ]);

        $notification = array(
            'message' => 'Shipping Division Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.division')->with($notification);
    }

    public function editDivision($id){
        $division = ShipDivision::findOrFail($id);
        return view('backend.ship.division.division_edit',compact('division'));
    }

    public function updateDivision(Request $request){
        $id = $request->id;

        ShipDivision::findOrFail($id)->update([
            'division_name' => $request->division_name,
        ]);

        $notification = array(
            'message' => 'Shipping Division Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.division')->with($notification);
    }

    public function deleteDivision($id){
        ShipDivision::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Shipping Division Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.division')->with($notification);
    }
}