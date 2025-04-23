<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Professional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        if (Auth::guard('client')->check()) {
            return redirect()->route('client.dashboard');
        }
        if (Auth::guard('professional')->check()) {
            return redirect()->route('professional.dashboard');
        }
        if (Auth::guard('web')->check()) {
            return redirect('/admin/dashboard');
        }
        return view('auth.login');
    }

    /**
     * Handle the login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // First try to authenticate as a professional
        if (Auth::guard('professional')->attempt($credentials)) {
            $professional = Auth::guard('professional')->user();
            
            // Check if professional is approved
            if ($professional->status !== 'approved') {
                Auth::guard('professional')->logout();
                throw ValidationException::withMessages([
                    'email' => ['Your account is not yet approved. Please wait for admin approval.'],
                ]);
            }

            $request->session()->regenerate();
            return redirect()->route('professional.dashboard');
        }

        // If not a professional, try to authenticate as a user
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::guard('web')->user()->is_admin) {
                return redirect()->intended(route('admin.dashboard'));
            }
            
            return redirect()->intended('/profile');
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('professional')->logout();
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showProfessionalLoginForm()
    {
        if (auth()->guard('client')->check()) {
            return redirect()->route('client.dashboard');
        }
        if (auth()->guard('professional')->check()) {
            return redirect()->route('professional.dashboard');
        }
        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.professional.login');
    }

    public function professionalLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->guard('professional')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('professional.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
} 