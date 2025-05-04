<?php

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use App\Models\User;
use App\Models\Professional;
use App\Models\PasswordResetToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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
            
            // Check if there's a redirect URL in the session
            if ($request->session()->has('redirect_url')) {
                $redirectUrl = $request->session()->get('redirect_url');
                $request->session()->forget('redirect_url');
                return redirect($redirectUrl);
            }
            
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
    
    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $email = $request->email;
        $userType = null;
        $userFound = false;
        
        // Check if the email exists in any of our user tables
        if (User::where('email', $email)->exists()) {
            $userType = 'user';
            $userFound = true;
        } elseif (Professional::where('email', $email)->exists()) {
            $userType = 'professional';
            $userFound = true;
        } elseif (\App\Models\Client::where('email', $email)->exists()) {
            $userType = 'client';
            $userFound = true;
        }
        
        // Only proceed if we found a user
        if ($userFound) {
            try {
                // Generate a token
                $token = Str::random(64);
                
                // Store the token in the database
                try {
                    PasswordResetToken::updateOrCreate(
                        ['email' => $email],
                        [
                            'token' => $token,
                            'user_type' => $userType,
                            'created_at' => now()
                        ]
                    );
                } catch (\Exception $e) {
                    // If user_type column doesn't exist, try without it
                    if (strpos($e->getMessage(), 'user_type') !== false) {
                        \Log::warning("user_type column not found, using fallback method");
                        PasswordResetToken::updateOrCreate(
                            ['email' => $email],
                            [
                                'token' => $token,
                                'created_at' => now()
                            ]
                        );
                    } else {
                        throw $e;
                    }
                }
                
                // Create the reset URL
                $resetUrl = url("/password/reset/{$token}?email={$email}");
                
                // Send the email with error handling
                try {
                    Mail::to($email)->send(new PasswordReset($resetUrl, $userType));
                    \Log::info("Password reset email sent to {$email}");
                } catch (\Exception $e) {
                    \Log::error("Failed to send password reset email: " . $e->getMessage());
                    return back()->withErrors(['email' => 'Failed to send password reset email. Please try again later.']);
                }
            } catch (\Exception $e) {
                \Log::error("Password reset error: " . $e->getMessage());
                return back()->withErrors(['email' => 'An error occurred. Please try again later.']);
            }
        } else {
            \Log::info("Password reset requested for non-existent email: {$email}");
        }
        
        // For security reasons, we always show success message even if email doesn't exist
        $status = "We have emailed your password reset link!";
        
        return back()->with('status', $status);
    }
    
    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return \Illuminate\View\View
     */
    public function showResetForm(Request $request, $token)
    {
        $email = $request->query('email');
        
        // Verify that the token exists for this email
        $resetToken = PasswordResetToken::where('email', $email)
                                        ->where('token', $token)
                                        ->first();
        
        if (!$resetToken) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Invalid password reset token.']);
        }
        
        // Check if the token is expired (60 minutes)
        if ($resetToken->created_at->addMinutes(60)->isPast()) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Password reset token has expired.']);
        }
        
        return view('auth.passwords.reset', ['token' => $token, 'email' => $email]);
    }
    
    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);
        
        $email = $request->email;
        $token = $request->token;
        
        try {
            // Verify that the token exists for this email
            $resetToken = PasswordResetToken::where('email', $email)
                                            ->where('token', $token)
                                            ->first();
            
            if (!$resetToken) {
                return back()->withErrors(['email' => 'Invalid password reset token.']);
            }
            
            // Check if the token is expired (60 minutes)
            if ($resetToken->created_at->addMinutes(60)->isPast()) {
                return back()->withErrors(['email' => 'Password reset token has expired.']);
            }
            
            $passwordUpdated = false;
            
            // Try to update password in each user type table
            // First check if it's a regular user
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->password = Hash::make($request->password);
                $user->save();
                $passwordUpdated = true;
                \Log::info("Password reset successful for user: {$email}");
            }
            
            // Then check if it's a professional
            $professional = Professional::where('email', $email)->first();
            if ($professional) {
                $professional->password = Hash::make($request->password);
                $professional->save();
                $passwordUpdated = true;
                \Log::info("Password reset successful for professional: {$email}");
            }
            
            // Check if it's a client
            $client = \App\Models\Client::where('email', $email)->first();
            if ($client) {
                $client->password = Hash::make($request->password);
                $client->save();
                $passwordUpdated = true;
                \Log::info("Password reset successful for client: {$email}");
            }
            
            // Delete the token
            $resetToken->delete();
            
            if (!$passwordUpdated) {
                \Log::warning("Password reset token used but no matching user found for email: {$email}");
            }
            
            return redirect()->route('login')
                ->with('status', 'Your password has been reset successfully!');
                
        } catch (\Exception $e) {
            \Log::error("Password reset error: " . $e->getMessage());
            return back()->withErrors(['email' => 'An error occurred while resetting your password. Please try again.']);
        }
    }
} 