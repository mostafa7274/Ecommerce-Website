<?php

namespace App\Http\Controllers\cutomer\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class cutomerLoginController extends Controller
{
    //

    public function login(){
        return view('cutomer.auth.login');
    }

    public function checkLogin(Request $request){
        $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        if(Auth::guard('cutomer')->attempt((['email' => $request->email , 'password' => $request->password]))){
            return redirect()->route('cutomer.dashboard');
        }
        else{
            return redirect()->back()
            ->withInput(['email'=>$request->email])
            ->with('errorResponse' , 'these credentials dont match');

        }
    }

    public function logout(){
        Auth::guard('cutomer')->logout();

        return redirect()->route('cutomer.dashboard.login');
    }



}
