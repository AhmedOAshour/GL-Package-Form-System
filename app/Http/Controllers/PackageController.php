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
        $package = new Package();

        $package->member_name = $request->member_name;
        $package->member_id = $request->member_id;
        $package->tshirt = $request->has('tshirt');
        $package->nametag = $request->has('nametag');
        $package->bracelet = $request->has('bracelet');

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
