<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::check()) {

            // Jika ADMIN
            if (Auth::user()->role_id == 1) {
                return redirect('/dashboard');
            }

            // Jika SELLER
            if (Auth::user()->role_id == 2) {
                return redirect('/seller');
            }

            // Jika USER biasa
            if (Auth::user()->role_id == 3) {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
