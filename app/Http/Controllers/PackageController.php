<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    public function view(Request $request){
        $validated = $request->validate(['serial_number' => ['required','exists:packages']]);
        
        if($request->has('verify'))
            $this->verify($request);
        elseif($request->has('unverify'))
            $this->unverify($request);
        
        $package = Package::where('serial_number',$request->serial_number)->firstOrFail();
        
        $user = DB::table('users')->select('username')->where('id',$package->user_id)->first();
        if($user)
            $package->username = $user->username;
        if($package)
            return view('/package/view', ['package'=> $package]);
        else
            $this->find();
    }

    public function find(){
        return view('/package/view');
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
        
        $valid_chars = range(0,9);
        $rand_serial = implode('', array_rand($valid_chars, 6));

        $package->serial_number = $rand_serial;

        $package->save();

        return view('/package/create',[
            'submit'=>true,
            'serial_number'=>$rand_serial]);
    }

    public function verify(Request $request){
        $affected = DB::update(
            'update packages set verified_at = NOW(), user_id = ? where serial_number = ?',
            [session()->get('id'),$request->serial_number]
        );
    }

    public function unverify(Request $request){
        $affected = DB::update(
            'update packages set verified_at = NULL, user_id = NULL where serial_number = ?',
            [$request->serial_number]
        );
    }
}
