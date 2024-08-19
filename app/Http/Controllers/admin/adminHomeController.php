<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Support\Facades\Cache;

class AdminHomeController extends Controller
{

    public function home()
    {

        $users = User::all();
        $sellers = Seller::all();


        $totalUsers = $users->count();
        $totalSellers = $sellers->count();


        return view('admin.home', compact('users', 'sellers', 'totalUsers', 'totalSellers'));
    }


    public function index()
    {

        $products = Product::where('status', 'pending')->get();
        return view('admin.products.index', compact('products'));
    }


    public function approve($id)
    {

        $product = Product::findOrFail($id);
        $product->status = 'approved';
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product approved successfully!');
    }


    public function reject($id)
    {

        $product = Product::findOrFail($id);
        $product->status = 'rejected';
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product rejected successfully!');
    }


    public function showUsers()
    {
        $users = User::all();
        $sellers = Seller::all();
        return view('admin.users.index', compact('users', 'sellers'));
    }


    // public function editUser($id)
    // {
    //     $user = User::findOrFail($id);
    //     return view('admin.users.edit', compact('user'));
    // }


    // public function updateUser(Request $request, $id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->name = $request->input('name');
    //     $user->email = $request->input('email');
    //     $user->save();

    //     return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    // }


    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }


    public function showSellers()
    {
        $sellers = Seller::all();
        return view('admin.sellers.index', compact('sellers'));
    }


    // public function editSeller($id)
    // {
    //     $seller = Seller::findOrFail($id);
    //     return view('admin.sellers.edit', compact('seller'));
    // }


    // public function updateSeller(Request $request, $id)
    // {
    //     $seller = Seller::findOrFail($id);
    //     $seller->name = $request->input('name');
    //     $seller->email = $request->input('email');
    //     $seller->save();

    //     return redirect()->route('admin.sellers.index')->with('success', 'Seller updated successfully!');
    // }


    public function destroySeller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->delete();

        return redirect()->route('admin.sellers.index')->with('success', 'Seller deleted successfully!');
    }


    public function blockSeller($id)
    {
        $seller = Seller::findOrFail($id);


        $blockedSellers = Cache::get('blocked_sellers', []);


        $blockedSellers[] = $seller->id;


        Cache::put('blocked_sellers', $blockedSellers, now()->addDays(7));

        return redirect()->route('admin.sellers.index')->with('success', 'Seller has been blocked.');
    }


    public function unblockSeller($id)
    {
        $blockedSellers = Cache::get('blocked_sellers', []);
        if (($key = array_search($id, $blockedSellers)) !== false) {
            unset($blockedSellers[$key]);
            Cache::put('blocked_sellers', array_values($blockedSellers));
        }

        return redirect()->back()->with('success', 'Seller has been unblocked.');
    }
}
