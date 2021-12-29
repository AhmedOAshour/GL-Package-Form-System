<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // ->where('email', $email)
        $username = $request->username;
        $password = $request->password;
        $user = User::where('username', $username)->where('password', $password)->first();
        if($user){
            session([
                'id'=>$user->id,
                'username'=>$user->username
            ]);
            return redirect('/package/view');
            
        }
        else{
            return view('login', ['error'=>'Incorrect login credentails.']);
        }
    }

    public function logout(Request $request){

        session()->invalidate();
    
        session()->regenerateToken();
    
        return redirect('/');
    }
}
