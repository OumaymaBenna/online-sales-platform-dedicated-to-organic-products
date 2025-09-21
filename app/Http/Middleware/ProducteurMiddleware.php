<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProducteurMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->user_type === 'producteur') {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'Accès refusé.');
    }
}
