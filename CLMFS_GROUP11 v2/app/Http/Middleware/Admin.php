<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (!Auth::user()->isAdmin()) {
            return redirect('/dashboard')->with('error', 'Access denied. Admin privileges required.');
        }

        return $next($request);
    }
}
