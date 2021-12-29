<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        return redirect('/package/create');
    }

    public function login(){
        return view('/login');
    }
}
