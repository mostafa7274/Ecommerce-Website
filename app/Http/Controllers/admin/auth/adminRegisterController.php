<?php

namespace App\Http\Controllers\customer\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;



class customerRegisterController extends Controller
{
    //

    public function register(){
        return view('customer.auth.register');
    }

    public function store(Request $request){
        $customerKey = "customerKey1";
        if($request->customer_key == $customerKey){
            $request->validate([
                'name' => 'required|string|max:255', //'name' lazem ykoon bymatch el name attribute elly fe form
                'email' => 'required|string|max:255',
                'customer_key' => 'required|string',
                'password' => 'required|string|max:255|confirmed',
                'password_confirmation' => 'required|numeric|max:255',
            ] );
            $data = $request->except(['password_confirmation' , '_token' ,'customer_key']);
            $data['password']= Hash::make($request->password);
            // dd($data);

            Admin::create($data);

            return redirect()->route('customer.dashboard.login');
        }
        else{
            return redirect()->back()->with('errorResponse' , 'Admin Key is not correct'); //keda ana 3mlt session esmha errorResponse
        }
    }
}
