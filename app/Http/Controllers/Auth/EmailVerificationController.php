<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    /**
     * Show the email verification notice.
     */
    public function show(Request $request)
    {
        // dd($request->user());
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('client.dashboard'))
                    : view('auth.verify-email');
    }

    /**
     * Mark the authenticated user's email address as verified.
     */
    public function verify(EmailVerificationRequest $request)
    {
        // if ($request->user()->hasVerifiedEmail()) {
        //     return redirect()->intended(route('client.dashboard'));
        // }

        // if ($request->user()->markEmailAsVerified()) {
        //     session()->flash('verified', true);
        // }

        // return redirect()->route('login')->with('success', 'Email verified successfully! You can now log in.');
        $request->fulfill();
        return redirect('/home');
    }

    /**
     * Resend the email verification notification.
     */
    public function resend(Request $request)
    {
        // Check if user's email is already verified
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'success' => true,
                'message' => 'Your email is already verified.',
                'redirect' => route('client.dashboard')
            ]);
        }

        // Send verification email
        $request->user()->sendEmailVerificationNotification();

        // Return JSON response for AJAX requests
        return response()->json([
            'success' => true,
            'message' => 'Verification email sent successfully! Please check your inbox.'
        ]);
    }
}
