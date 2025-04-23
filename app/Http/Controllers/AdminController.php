<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Professional;
use App\Models\User;
use App\Models\Appointment;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Show the admin login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    /**
     * Handle the admin login request.
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

        if (Auth::attempt($credentials)) {
            if (!Auth::user()->is_admin) {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => ['You do not have admin privileges.'],
                ]);
            }

            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    /**
     * Log the admin out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $recentProfessionals = Professional::orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $totalProfessionals = Professional::count();
        $totalUsers = User::count();
        $appointmentsToday = Appointment::whereDate('start_time', Carbon::today())
            ->where('status', '!=', 'cancelled')
            ->count();
        
        return view('admin.dashboard', compact('recentProfessionals', 'totalProfessionals', 'totalUsers', 'appointmentsToday'));
    }

    /**
     * Show the admin profile page.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        return view('admin.profile');
    }

    /**
     * Update the admin's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update($validated);

        return redirect()->route('admin.profile')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Update the admin's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('The current password is incorrect.');
                }
            }],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.profile')
            ->with('success', 'Password updated successfully.');
    }
} 