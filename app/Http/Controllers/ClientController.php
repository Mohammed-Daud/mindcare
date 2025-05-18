<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ClientVerificationEmail;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client')->except(['showRegistrationForm', 'register', 'verify', 'showLoginForm', 'login']);
    }

    public function showRegistrationForm()
    {
        return view('client.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (\App\Models\User::where('email', $value)->exists() ||
                        \App\Models\Client::where('email', $value)->exists() ||
                        \App\Models\Professional::where('email', $value)->exists()) {
                        $fail('This email address is already registered.');
                    }
                },
            ],
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $client = new Client();
        $client->first_name = $validated['first_name'];
        $client->last_name = $validated['last_name'];
        $client->email = $validated['email'];
        $client->password = Hash::make($validated['password']);
        $client->phone = $validated['phone'];
        $client->address = $validated['address'];
        $client->email_verification_token = Str::random(64);
        $client->save();

        // Send verification email
        Mail::to($client->email)->send(new ClientVerificationEmail($client));

        return redirect()->route('client.login')
            ->with('success', 'Registration successful! Please check your email to verify your account.');
    }

    public function verify($token)
    {
        $client = Client::where('email_verification_token', $token)->firstOrFail();
        
        $client->email_verified_at = now();
        $client->email_verification_token = null;
        $client->save();

        return redirect()->route('client.login')
            ->with('success', 'Email verified successfully! You can now log in.');
    }

    public function showLoginForm()
    {
        if (auth()->guard('client')->check()) {
            return redirect()->route('client.dashboard');
        }
        return view('client.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->guard('client')->attempt($credentials)) {
            $request->session()->regenerate();
            
            // Check if there's a redirect URL in the session
            if ($request->session()->has('redirect_url')) {
                $redirectUrl = $request->session()->get('redirect_url');
                $request->session()->forget('redirect_url');
                return redirect($redirectUrl);
            }
            
            return redirect()->intended(route('client.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        auth()->guard('client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function dashboard()
    {
        $client = auth()->guard('client')->user();
        return view('client.dashboard', compact('client'));
    }

    public function profile()
    {
        $client = auth()->user();
        return view('client.profile', compact('client'));
    }

    public function editProfile()
    {
        $client = auth()->user();
        return view('client.edit-profile', compact('client'));
    }

    public function updateProfile(Request $request)
    {
        $client = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20|unique:clients,mobile,' . $client->id,
            'whatsapp' => 'required|string|max:20|unique:clients,whatsapp,' . $client->id,
            'age' => 'required|integer|min:18',
            'gender' => 'required|in:male,female,other',
            'address' => 'required|string',
        ]);

        $client->update($validated);

        return redirect()->route('client.profile')
            ->with('success', 'Profile updated successfully.');
    }
}
