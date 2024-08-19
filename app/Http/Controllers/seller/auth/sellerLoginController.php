<?php

namespace App\Http\Controllers\seller\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class sellerLoginController extends Controller
{
    //

    public function login(){
        return view('seller.auth.login');
    }

    public function checkLogin(Request $request){
        $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        if(Auth::guard('seller')->attempt((['email' => $request->email , 'password' => $request->password]))){
            return redirect()->route('seller.dashboard.home');
        }
        else{
            return redirect()->back()
            ->withInput(['email'=>$request->email])
            ->with('errorResponse' , 'these credentials dont match');

        }
    }

    public function logout(){
        Auth::guard('seller')->logout();

        return redirect()->route('seller.dashboard.login');
    }
}
