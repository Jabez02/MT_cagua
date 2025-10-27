<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Please log in to access this area.');
        }

        if (Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action. Admin privileges required.');
        }

        return $next($request);
    }
}
