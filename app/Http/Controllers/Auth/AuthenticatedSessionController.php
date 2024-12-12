<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Carbon\Carbon;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // $request->authenticate();
        // $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);

        try {
            $request->authenticate();
            $request->session()->regenerate();

            LoginLog::create([
                'user_id' => Auth::id(),
                'logname' => 'login',
                'user_ip' => $request->ip(),
                'user_pc' => $request->userAgent(),
                'login_date' => now(),
                'login_time' => now(),
                'session_id' => session()->getId(), 
                'status' => true, // Login success
            ]);

            return redirect()->intended(RouteServiceProvider::HOME);
        } catch (\Exception $e) {

            LoginLog::create([
                'user_id' => null, // No user authenticated for failed login
                'user_ip' => $request->ip(),
                'logname' => 'login',
                'user_pc' => $request->userAgent(),
                'login_date' => now(),
                'login_time' => now(),
                'session_id' => session()->getId(), 
                'status' => false, // Login failed
            ]);

            // Catch session expiry or other issues and provide a custom message
            return redirect()->route('login')->with('message', 'Your session has expired. Please log in again.');
        }
    }

   

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (Auth::check()) {
            LoginLog::create([
                'user_id' => Auth::id(), 
                'user_ip' => $request->ip(),
                'logname' => 'logout',
                'user_pc' => $request->userAgent(),
                'login_date' => now(),
                'login_time' => now(),
                'session_id' => session()->getId(), 
                'status' => false, // Login failed
            ]);
        }

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
