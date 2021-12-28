<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return redirect('/package/create');
    }

    public function login(){
        return view('login');
    }

    public function doLogin(){
        
        return;
    }
}
