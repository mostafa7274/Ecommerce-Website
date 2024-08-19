<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SellerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is a seller and is logged in
        if (Auth::guard('seller')->check()) {
            return $next($request);
        }

        // Redirect to login page if not authenticated
        return redirect('/seller/dashboard/login');
    }
}
