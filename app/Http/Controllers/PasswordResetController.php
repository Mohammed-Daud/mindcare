<?php

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use App\Models\User;
use App\Models\Professional;
use App\Models\Client;
use App\Models\PasswordResetToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    /**
     * Show the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
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
        $user = User::where('email', $email)->first();

        Log::info("Password reset requested for email: {$email}");

        // Only proceed if we found a user
        if ($user) {
            try {
                // Generate a token
                $token = Str::random(64);
                PasswordResetToken::updateOrCreate(
                    ['email' => $email],
                    [
                        'token' => $token,
                        'created_at' => now()
                    ]
                );

                // Create the reset URL with properly encoded email
                $resetUrl = url("/password/reset/{$token}?email=" . urlencode($email));

                // Send the email with error handling
                try {
                    // Create the mailable instance
                    $mailable = new PasswordReset($resetUrl, $user);

                    // Send the email
                    Mail::to($email)->send($mailable);

                    // For debugging, let's also log the token to make it easier to test
                    Log::info("For testing purposes, reset token for {$email} is: {$token}");

                    // Return JSON response for AJAX requests
                    if ($request->expectsJson()) {
                        return response()->json([
                            'success' => true,
                            'message' => 'We have emailed your password reset link!'
                        ]);
                    }

                    return back()->with('status', 'We have emailed your password reset link!');

                } catch (\Exception $e) {
                    Log::error("Failed to send password reset email: " . $e->getMessage());

                    if ($request->expectsJson()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Failed to send password reset email. Please try again.'
                        ], 500);
                    }

                    return back()->withErrors(['email' => 'Failed to send password reset email: ' . $e->getMessage()]);
                }
            } catch (\Exception $e) {
                Log::error("Password reset error: " . $e->getMessage());

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'An error occurred while processing your request.'
                    ], 500);
                }

                return back()->withErrors(['email' => 'An error occurred: ' . $e->getMessage()]);
            }
        } else {
            Log::info("No user found with email: {$email}");

            // For security reasons, we always show success message even if email doesn't exist
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'If an account with that email exists, we have sent a password reset link!'
                ]);
            }

            return back()->with('status', 'If an account with that email exists, we have sent a password reset link!');
        }
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return \Illuminate\View\View
     */
    public function showResetForm(Request $request, $token)
    {
        // dd($request->all());
        // Get and decode the email parameter
        $email = $request->query('email');

        Log::info("Password reset form accessed with token: {$token} and email: {$email}");

        // Check if email is missing
        if (!$email) {
            Log::warning("Email parameter missing in password reset URL");
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Email parameter is missing from the reset link.']);
        }

        // Verify that the token exists for this email
        try {
            $resetToken = PasswordResetToken::where('email', $email)->first();

            Log::info("Reset token query result: " . ($resetToken ? "Token found for email" : "No token found for email"));

            // For debugging, let's check all tokens for this email
            $allTokens = PasswordResetToken::where('email', $email)->get();
            Log::info("All tokens for email {$email}: " . $allTokens->count());
            foreach ($allTokens as $t) {
                Log::info("Token in DB: " . substr($t->token, 0, 10) . "... created at " . $t->created_at);
            }

            // Compare the token using hash_equals to prevent timing attacks
            if (!$resetToken) {
                Log::warning("No token found in database for email: {$email}");
                return redirect()->route('password.request')
                    ->withErrors(['email' => 'Invalid password reset token.']);
            }

            // Log the token comparison for debugging
            Log::info("Token comparison - URL token: " . substr($token, 0, 10) . "... DB token: " . substr($resetToken->token, 0, 10) . "...");

            if (!hash_equals($resetToken->token, $token)) {
                Log::warning("Token mismatch for email: {$email}");
                return redirect()->route('password.request')
                    ->withErrors(['email' => 'Invalid password reset token.']);
            }

            // dd();

            // Check if the token is expired (60 minutes)
            if (Carbon::parse($resetToken->created_at)->addMinutes(config('auth.passwords.users.expire'))->isPast()) {
                Log::warning("Expired reset token: {$token} for email: {$email}, created at: {$resetToken->created_at}");
                return redirect()->route('password.request')
                    ->withErrors(['email' => 'Password reset token has expired.']);
            }

            Log::info("Valid reset token found, showing reset form for email: {$email}");
            // Pass the raw email to the view (it will be encoded in the hidden field)
            return view('auth.passwords.reset', ['token' => $token, 'email' => $email]);

        } catch (\Exception $e) {
            Log::error("Error validating reset token: " . $e->getMessage());
            return redirect()->route('password.request')
                ->withErrors(['email' => 'An error occurred while validating your reset token.']);
        }
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|max:128|regex:/^(?=.*\d)(?=.*[^a-zA-Z0-9]).{8,}$/|confirmed',
        ], [
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.regex' => 'Password must include at least one number and one special character.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        // Make sure to use the decoded email
        $email = $request->email;
        $token = $request->token;

        try {
            // Verify that the token exists for this email
            $resetToken = PasswordResetToken::where('email', $email)->first();

            // Compare the token using hash_equals to prevent timing attacks
            if (!$resetToken) {
                Log::warning("No token found in database for email: {$email} during reset");

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid password reset token.',
                        'errors' => ['email' => ['Invalid password reset token.']]
                    ], 422);
                }

                return back()->withErrors(['email' => 'Invalid password reset token.']);
            }

            // Log the token comparison for debugging
            Log::info("Reset method - Token comparison - Form token: " . substr($token, 0, 10) . "... DB token: " . substr($resetToken->token, 0, 10) . "...");

            if (!hash_equals($resetToken->token, $token)) {
                Log::warning("Token mismatch for email: {$email} during reset");

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid password reset token.',
                        'errors' => ['email' => ['Invalid password reset token.']]
                    ], 422);
                }

                return back()->withErrors(['email' => 'Invalid password reset token.']);
            }

            // Check if the token is expired
            if (Carbon::parse($resetToken->created_at)->addMinutes(config('auth.passwords.users.expire'))->isPast()) {
                Log::warning("Expired reset token: {$token} for email: {$email}, created at: {$resetToken->created_at}");

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Password reset token has expired.',
                        'errors' => ['email' => ['Password reset token has expired.']]
                    ], 422);
                }

                return back()->withErrors(['email' => 'Password reset token has expired.']);
            }

            // Find the user and update password
            $user = User::where('email', $email)->first();

            if ($user) {
                $user->password = Hash::make($request->password);
                $user->save();
                Log::info("Password reset successful for user: {$email}");

                // Delete the token
                $resetToken->delete();

                // Return JSON response for AJAX requests
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Your password has been reset successfully!',
                        'redirect' => route('login')
                    ]);
                }

                return redirect()->route('login')->with('message', 'Your password has been reset successfully!');
            } else {
                Log::warning("Password reset token used but no matching user found for email: {$email}");

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'User not found.',
                        'errors' => ['email' => ['User not found.']]
                    ], 422);
                }

                return back()->withErrors(['email' => 'User not found.']);
            }

        } catch (\Exception $e) {
            Log::error("Error resetting password: " . $e->getMessage());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while resetting your password.',
                    'errors' => ['email' => ['An error occurred while resetting your password.']]
                ], 500);
            }

            return back()->withErrors(['email' => 'An error occurred while resetting your password.']);
        }
    }
}
