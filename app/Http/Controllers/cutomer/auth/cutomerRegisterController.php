<?php

namespace App\Http\Controllers\cutomer\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Cutomer;



class cutomerRegisterController extends Controller
{
    //

    public function register(){
        return view('cutomer.auth.register');
    }

    public function store(Request $request){
        $cutomerKey = "cutomerKey1";
        if($request->cutomer_key == $cutomerKey){
            $request->validate([
                'name' => 'required|string|max:255', //'name' lazem ykoon bymatch el name attribute elly fe form
                'email' => 'required|string|max:255',
                'cutomer_key' => 'required|string',
                'password' => 'required|string|max:255|confirmed',
                'password_confirmation' => 'required|numeric|max:255',
            ] );
            $data = $request->except(['password_confirmation' , '_token' ,'cutomer_key']);
            $data['password']= Hash::make($request->password);
            // dd($data);

            Cutomer::create($data);

            return redirect()->route('cutomer.dashboard.login');
        }
        else{
            return redirect()->back()->with('errorResponse' , 'Cutomer Key is not correct'); //keda ana 3mlt session esmha errorResponse
        }
    }
}
