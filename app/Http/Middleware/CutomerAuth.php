<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CutomerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is a seller and is logged in
        if (Auth::guard('cutomer')->check()) {
            return $next($request);
        }

        // Redirect to login page if not authenticated
        return redirect('/cutomer/dashboard/login');
    }
}
