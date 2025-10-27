<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Enforce approval before allowing login
        $user = Auth::user();
        if ($user && $user->usertype === 'user' && $user->status !== 'approved') {
            Auth::logout();
            
            $errorMessage = $user->status === 'rejected'
                ? 'Your account has been rejected. Please contact support.'
                : 'Your account is pending approval. Please wait for admin approval.';
            
            // Handle AJAX requests
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'errors' => [
                        'email' => [$errorMessage]
                    ]
                ], 422);
            }
            
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => $errorMessage,
                ]);
        }

        $redirectRoute = Auth::user()->usertype == 'admin' 
            ? route('admin.dashboard') 
            : route('dashboard', absolute: false);

        // Handle AJAX requests
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Login successful!',
                'redirect' => $redirectRoute
            ]);
        }

        if (Auth::user()->usertype == 'admin')   {
            return redirect(route('admin.dashboard'));
        }

        return redirect()->intended(route('dashboard', absolute: false));
        
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
