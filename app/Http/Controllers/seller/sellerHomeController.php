<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class sellerHomeController extends Controller
{
    public function index(){
        return view('seller.home'); //el path to file home.blade.php elly gowa el admin gowa el views
    }

    public function block($id)
{
    // Retrieve the current list of blocked sellers from the cache
    $blockedSellers = Cache::get('blocked_sellers', []);

    // Add the new seller ID to the list
    $blockedSellers[] = $id;

    // Remove duplicates and store the updated list in the cache
    Cache::put('blocked_sellers', array_unique($blockedSellers), now()->addDays(7)); // Cache for 7 days or as needed

    return redirect()->route('admin.sellers.index')->with('success', 'Seller has been blocked.');
}
}
