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
            'password' => 'required|confirmed|min:8',
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
                return back()->withErrors(['email' => 'Invalid password reset token.']);
            }

            // Log the token comparison for debugging
            Log::info("Reset method - Token comparison - Form token: " . substr($token, 0, 10) . "... DB token: " . substr($resetToken->token, 0, 10) . "...");

            if (!hash_equals($resetToken->token, $token)) {
                Log::warning("Token mismatch for email: {$email} during reset");
                return back()->withErrors(['email' => 'Invalid password reset token.']);
            }

            // Check if the token is expired (60 minutes)
            if (Carbon::parse($resetToken->created_at)->addMinutes(60)->isPast()) {
                return back()->withErrors(['email' => 'Password reset token has expired.']);
            }

            $passwordUpdated = false;

            // Try to update password in each user type table
            // First check if it's a regular user

            switch ($resetToken->user_type) {
                case 'client':
                    $user = Client::where('email', $email)->first();
                    break;
                case 'professional':
                    $user = Professional::where('email', $email)->first();
                    break;
                default:
                    $user = User::where('email', $email)->first();
                    break;
            }

            if ($user) {
                $user->password = Hash::make($request->password);
                $user->save();
                $passwordUpdated = true;
                Log::info("Password reset successful for {$resetToken->user_type}: {$email}");
            }


            // Delete the token
            $resetToken->delete();

            if (!$passwordUpdated) {
                Log::warning("Password reset token used but no matching user found for email: {$email}");
            }
            if ($resetToken->user_type == 'client') {
                return redirect()->route('login')->with('message', 'Your password has been reset successfully!');
            } elseif ($resetToken->user_type == 'professional') {
                return redirect()->route('professional.login')->with('message', 'Your password has been reset successfully!');
            } else {
                return redirect()->route('admin.login')->with('message', 'Your password has been reset successfully!');
            }

        } catch (\Exception $e) {
            Log::error("Password reset error: " . $e->getMessage());
            return back()->withErrors(['email' => 'An error occurred while resetting your password. Please try again.']);
        }
    }
}
