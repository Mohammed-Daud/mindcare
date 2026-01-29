<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PasswordValidationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client')->except(['showRegistrationForm', 'register', 'showLoginForm', 'login']);
    }

    public function showRegistrationForm()
    {
        return view('client.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (User::where('email', $value)->exists()) {
                        $fail('This email address is already registered.');
                    }
                },
            ],
            'pronouns' => 'nullable|string|max:50',
            'password' => PasswordValidationService::getRule(),
            'terms' => 'accepted'
        ], array_merge(PasswordValidationService::getMessages(), [
            'fullname.required' => 'Full name is required.',
            'fullname.regex' => 'Full name should only contain letters and spaces.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'terms.accepted' => 'You must agree to the Terms of Service and Privacy Policy.'
        ]));

        // log validation result
        // Log::info('Client registration validation result:', $validated);

        // Create new user with client type
        $user = new User();
        $user->name = $validated['fullname'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->user_type = User::TYPE_CLIENT;
        $user->status = User::STATUS_ACTIVE;
        $user->save();

        // Send verification email using Laravel's built-in verification
        $user->sendEmailVerificationNotification();

        // Log in the user automatically
        Auth::login($user);

        return response()->json([
            'success' => true,
            'message' => 'Registration successful! Please check your email to verify your account.',
            'redirect' => route('verification.notice'),
            'data' => [
                'user_id' => $user->id,
                'email' => $user->email,
                'user_type' => $user->user_type
            ]
        ]);
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
