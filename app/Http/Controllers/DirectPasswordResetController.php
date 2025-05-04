<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Professional;
use App\Models\Client;
use App\Models\PasswordResetToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class DirectPasswordResetController extends Controller
{
    /**
     * Show the form to request a direct password reset.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('auth.passwords.direct-reset');
    }

    /**
     * Generate a direct password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateLink(Request $request)
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
        } elseif (Client::where('email', $email)->exists()) {
            $userType = 'client';
            $userFound = true;
        }
        
        if (!$userFound) {
            return back()->withErrors(['email' => 'No account found with this email address.']);
        }
        
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
        
        return view('auth.passwords.direct-link', [
            'resetUrl' => $resetUrl,
            'email' => $email,
            'userType' => $userType
        ]);
    }

    /**
     * Reset the password directly.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);
        
        $email = $request->email;
        $passwordUpdated = false;
        
        // Try to update password in each user type table
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            $passwordUpdated = true;
        }
        
        $professional = Professional::where('email', $email)->first();
        if ($professional) {
            $professional->password = Hash::make($request->password);
            $professional->save();
            $passwordUpdated = true;
        }
        
        $client = Client::where('email', $email)->first();
        if ($client) {
            $client->password = Hash::make($request->password);
            $client->save();
            $passwordUpdated = true;
        }
        
        if (!$passwordUpdated) {
            return back()->withErrors(['email' => 'No account found with this email address.']);
        }
        
        return redirect()->route('login')
            ->with('status', 'Your password has been reset successfully!');
    }
}