<?php

namespace App\Http\Controllers\cutomer;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cutomer;



class CutomerController extends Controller
{
    // Display the login form
    public function login()
    {
        return view('cutomer.auth.login'); // Ensure this view exists
    }

    // Handle login logic
    public function checkLogin(Request $request)
    {
        // Your login logic here
    }

    // Display the registration form
    public function register()
    {
        return view('cutomer.auth.register'); // Ensure this view exists
    }

    // Handle registration logic
    public function store(Request $request)
{
    $cutomerKey = "cutomerKey1";

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:cutomers',
        'cutomer_key' => 'required|string',
        'password' => 'required|string|min:2|confirmed',
    ]);

    if ($request->input('cutomer_key') !== $cutomerKey) {
        return redirect()->back()
            ->with('errorResponse', 'Cutomer Key is not correct');
    }

    $data = $request->only(['name', 'email', 'password']);
    $data['password'] = Hash::make($request->input('password'));

    Cutomer::create($data);

    return redirect()->route('cutomer.dashboard.login')
        ->with('successResponse', 'Registration successful. Please log in.');
}

    // Display the dashboard home
    public function home()
    {
        return view('cutomer.home'); // Ensure this view exists
    }

    // Handle logout logic
    public function logout()
    {
        // Your logout logic here
    }
}

