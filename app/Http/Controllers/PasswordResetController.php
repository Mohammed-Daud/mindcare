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
        $userType = null;
        $userFound = false;
        
        Log::info("Password reset requested for email: {$email}");
        
        // Check if the email exists in any of our user tables
        if (User::where('email', $email)->exists()) {
            $userType = 'user';
            $userFound = true;
            Log::info("Found user with email: {$email}");
        } elseif (Professional::where('email', $email)->exists()) {
            $userType = 'professional';
            $userFound = true;
            Log::info("Found professional with email: {$email}");
        } elseif (Client::where('email', $email)->exists()) {
            $userType = 'client';
            $userFound = true;
            Log::info("Found client with email: {$email}");
        }
        
        // Only proceed if we found a user
        if ($userFound) {
            try {
                // Generate a token
                $token = Str::random(64);
                Log::info("Generated token for {$email}: {$token}");
                
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
                        Log::warning("user_type column not found, using fallback method");
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
                Log::info("Stored token in database for {$email}");
                
                // Create the reset URL
                $resetUrl = url("/password/reset/{$token}?email={$email}");
                Log::info("Reset URL for {$email}: {$resetUrl}");
                
                // Log mail configuration
                Log::info("Mail configuration: Driver=" . config('mail.default') . 
                          ", Host=" . config('mail.mailers.smtp.host') . 
                          ", Port=" . config('mail.mailers.smtp.port') . 
                          ", From=" . config('mail.from.address'));
                
                // Send the email with error handling
                try {
                    // Create the mailable instance
                    $mailable = new PasswordReset($resetUrl, $userType);
                    Log::info("Created mailable for {$email}");
                    
                    // Send the email
                    Mail::to($email)->send($mailable);
                    Log::info("Password reset email sent to {$email} as {$userType}");
                    
                    // For debugging, let's also log the token to make it easier to test
                    Log::info("For testing purposes, reset token for {$email} is: {$token}");
                    
                } catch (\Exception $e) {
                    Log::error("Failed to send password reset email: " . $e->getMessage());
                    Log::error("Stack trace: " . $e->getTraceAsString());
                    return back()->withErrors(['email' => 'Failed to send password reset email: ' . $e->getMessage()]);
                }
            } catch (\Exception $e) {
                Log::error("Password reset error: " . $e->getMessage());
                Log::error("Stack trace: " . $e->getTraceAsString());
                return back()->withErrors(['email' => 'An error occurred: ' . $e->getMessage()]);
            }
        } else {
            Log::info("No user found with email: {$email}");
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
            if (!$resetToken || !hash_equals($resetToken->token, $token)) {
                Log::warning("Invalid reset token: {$token} for email: {$email}");
                return redirect()->route('password.request')
                    ->withErrors(['email' => 'Invalid password reset token.']);
            }
            
            // Check if the token is expired (60 minutes)
            if ($resetToken->created_at->addMinutes(60)->isPast()) {
                Log::warning("Expired reset token: {$token} for email: {$email}, created at: {$resetToken->created_at}");
                return redirect()->route('password.request')
                    ->withErrors(['email' => 'Password reset token has expired.']);
            }
            
            Log::info("Valid reset token found, showing reset form for email: {$email}");
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
        
        $email = $request->email;
        $token = $request->token;
        
        try {
            // Verify that the token exists for this email
            $resetToken = PasswordResetToken::where('email', $email)->first();
            
            // Compare the token using hash_equals to prevent timing attacks
            if (!$resetToken || !hash_equals($resetToken->token, $token)) {
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
                Log::info("Password reset successful for user: {$email}");
            }
            
            // Then check if it's a professional
            $professional = Professional::where('email', $email)->first();
            if ($professional) {
                $professional->password = Hash::make($request->password);
                $professional->save();
                $passwordUpdated = true;
                Log::info("Password reset successful for professional: {$email}");
            }
            
            // Check if it's a client
            $client = Client::where('email', $email)->first();
            if ($client) {
                $client->password = Hash::make($request->password);
                $client->save();
                $passwordUpdated = true;
                Log::info("Password reset successful for client: {$email}");
            }
            
            // Delete the token
            $resetToken->delete();
            
            if (!$passwordUpdated) {
                Log::warning("Password reset token used but no matching user found for email: {$email}");
            }
            
            return redirect()->route('login')
                ->with('status', 'Your password has been reset successfully!');
                
        } catch (\Exception $e) {
            Log::error("Password reset error: " . $e->getMessage());
            return back()->withErrors(['email' => 'An error occurred while resetting your password. Please try again.']);
        }
    }
}