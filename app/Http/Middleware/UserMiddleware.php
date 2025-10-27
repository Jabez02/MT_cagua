<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Please log in to access this area.');
        }

        if (Auth::user()->usertype !== 'user') {
            return redirect()->route('home')
                ->with('error', 'Access denied. Regular user privileges required.');
        }
    
        if (Auth::user()->status !== 'approved') {
            return redirect()->route('home')
                ->with('error', 'Your account is pending approval. Please wait for administrator verification.');
        }
    
        return $next($request);
    }
}
