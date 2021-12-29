<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function view($id){
        $package = Package::findOrFail($id);

        return view('view', ['package'=> $package]);
    }

    public function showCreate(Request $request){

        return view('/package/create');
    }

    public function doCreate(Request $request){
        $validated = $request->validate([
            'member_name' => 'required|alpha',
            'member_id' => ['required','regex:/^20[0-9]{2}\/[0-9]{5}$/', 'unique:App\Models\Package,member_id'],
            'package_items' => 'required',
        ]);

        $package = new Package();

        $package->member_name = $request->member_name;
        $package->member_id = $request->member_id;
        $package->tshirt = in_array('tshirt', $request->package_items);
        $package->nametag = in_array('nametag', $request->package_items);
        $package->bracelet = in_array('bracelet', $request->package_items);

        $amount = 0.0;

        if($package->tshirt)
            $amount += 200;
        if($package->nametag)
            $amount += 50;
        if($package->bracelet)
            $amount += 100;

        $package->amount = $amount;
        $package->save();

        

        return view('/package/create',['submit'=>true]);
    }
}
