<?php

namespace App\Http\Controllers\seller\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Seller;



class sellerRegisterController extends Controller
{
    //

    public function register(){
        return view('seller.auth.register');
    }

    public function store(Request $request){
        $sellerKey = "sellerKey1";
        if($request->seller_key == $sellerKey){
            $request->validate([
                'name' => 'required|string|max:255', //'name' lazem ykoon bymatch el name attribute elly fe form
                'email' => 'required|string|max:255',
                'seller_key' => 'required|string',
                'password' => 'required|string|max:255|confirmed',
                'password_confirmation' => 'required|numeric|max:255',
            ] );
            $data = $request->except(['password_confirmation' , '_token' ,'seller_key']);
            $data['password']= Hash::make($request->password);
            // dd($data);

            Seller::create($data);

            return redirect()->route('seller.dashboard.login');
        }
        else{
            return redirect()->back()->with('errorResponse' , 'Seller Key is not correct'); //keda ana 3mlt session esmha errorResponse
        }
    }
}
