<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Mail\ProfessionalWelcomeEmail;
use App\Mail\AdminNotificationEmail;
use App\Mail\ApprovalEmail;
use Illuminate\Support\Facades\Auth;

class ProfessionalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:professional')->only([
            'dashboard',
            'profile',
            'editProfile',
            'updateProfile'
        ]);
    }

    /**
     * Display the professional onboarding form.
     */
    public function create()
    {
        return view('professionals.onboarding');
    }

    /**
     * Store a newly created professional in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:professionals',
            'country_code' => 'required|string|max:5',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'specialization' => 'nullable|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:255|unique:professionals',
            'license_expiry_date' => 'nullable|date',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);
        
        // Check if the combination of country_code and phone already exists
        if ($request->phone) {
            $existingProfessional = Professional::where('country_code', $request->country_code)
                ->where('phone', $request->phone)
                ->first();
                
            if ($existingProfessional) {
                return back()->withErrors(['phone' => 'The phone number with this country code already exists.'])
                    ->withInput();
            }
        }

        try {
            $professional = new Professional();
            $professional->first_name = $request->first_name;
            $professional->last_name = $request->last_name;
            $professional->email = $request->email;
            $professional->country_code = $request->country_code;
            $professional->phone = $request->phone;
            $professional->is_phone_verified = false; // Default to not verified
            $professional->bio = $request->bio;
            $professional->specialization = $request->specialization;
            $professional->qualification = $request->qualification;
            $professional->license_number = $request->license_number;
            $professional->license_expiry_date = $request->license_expiry_date;
            $professional->status = 'pending';

            // Handle profile photo upload
            if ($request->hasFile('profile_photo')) {
                $profilePhoto = $request->file('profile_photo');
                $profilePhotoName = time() . '_' . $profilePhoto->getClientOriginalName();
                $profilePhoto->storeAs('public/professionals/photos', $profilePhotoName);
                $professional->profile_photo = 'professionals/photos/' . $profilePhotoName;
            }

            // Handle CV upload
            if ($request->hasFile('cv')) {
                $cv = $request->file('cv');
                $cvName = time() . '_' . $cv->getClientOriginalName();
                $cv->storeAs('public/professionals/cvs', $cvName);
                $professional->cv = 'professionals/cvs/' . $cvName;
            }

            $professional->save();

            // Send welcome email to professional
            try {
                Mail::to($professional->email)->send(new ProfessionalWelcomeEmail($professional));
                Log::info('Welcome email sent successfully to ' . $professional->email);
            } catch (\Exception $e) {
                Log::error('Failed to send welcome email: ' . $e->getMessage());
            }

            // Send notification email to admin
            try {
                Mail::to(config('mail.from.address'))->send(new AdminNotificationEmail($professional));
                Log::info('Admin notification email sent successfully');
            } catch (\Exception $e) {
                Log::error('Failed to send admin notification email: ' . $e->getMessage());
            }

            return redirect()->route('professionals.onboarding.success')
                ->with('success', 'Your application has been submitted successfully. We will review it and get back to you soon.');

        } catch (\Exception $e) {
            Log::error('Failed to create professional: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while submitting your application. Please try again.');
        }
    }

    /**
     * Display the success page after onboarding.
     */
    public function onboardingSuccess()
    {
        return view('professionals.onboarding-success');
    }

    /**
     * Display a listing of professionals for admin.
     */
    public function index()
    {
        try {
            $professionals = Professional::orderBy('created_at', 'desc')->get();
            Log::info('Retrieved ' . $professionals->count() . ' professionals for admin panel');
            return view('admin.professionals.index', compact('professionals'));
        } catch (\Exception $e) {
            Log::error('Failed to retrieve professionals: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading professionals.');
        }
    }

    /**
     * Display the specified professional for admin.
     */
    public function show($slug)
    {
        $professional = Professional::where('slug', $slug)->firstOrFail();
        return view('professionals.show', compact('professional'));
    }

    /**
     * Approve the specified professional.
     */
    public function approve(Professional $professional)
    {
        try {
            // Generate a random password
            $password = Str::random(10);
            
            // Update professional status and set password
            $professional->status = 'approved';
            $professional->password = Hash::make($password);
            $professional->save();

            Log::info('Professional approved: ' . $professional->email);

            // Send approval email with login credentials
            try {
                Mail::to($professional->email)->send(new ApprovalEmail($professional, $password));
                Log::info('Approval email sent successfully to ' . $professional->email);
            } catch (\Exception $e) {
                Log::error('Failed to send approval email: ' . $e->getMessage());
                // Even if email fails, we don't want to rollback the approval
                return redirect()->route('admin.professionals.index')
                    ->with('warning', 'Professional approved but failed to send email. Please check the logs.');
            }

            return redirect()->route('admin.professionals.index')
                ->with('success', 'Professional has been approved and login credentials have been sent.');

        } catch (\Exception $e) {
            Log::error('Failed to approve professional: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while approving the professional.');
        }
    }

    /**
     * Reject the specified professional.
     */
    public function reject(Professional $professional)
    {
        try {
            $professional->status = 'rejected';
            $professional->save();
            Log::info('Professional rejected: ' . $professional->email);

            return redirect()->route('admin.professionals.index')
                ->with('success', 'Professional has been rejected.');
        } catch (\Exception $e) {
            Log::error('Failed to reject professional: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while rejecting the professional.');
        }
    }

    public function dashboard()
    {
        $professional = auth()->guard('professional')->user();
        return view('professional.dashboard', compact('professional'));
    }

    /**
     * Display the professional's profile.
     */
    public function profile()
    {
        $professional = auth()->guard('professional')->user();
        return view('professional.profile', compact('professional'));
    }

    /**
     * Show the form for editing the professional's profile.
     */
    public function editProfile()
    {
        $professional = auth()->guard('professional')->user();
        return view('professional.profile-edit', compact('professional'));
    }

    /**
     * Update the professional's profile.
     */
    public function updateProfile(Request $request)
    {
        $professional = auth()->guard('professional')->user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'country_code' => 'required|string|max:5',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'specialization' => 'nullable|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:255',
            'license_expiry_date' => 'nullable|date',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);
        
        // Check if the combination of country_code and phone already exists for other professionals
        if ($request->phone) {
            $existingProfessional = Professional::where('country_code', $request->country_code)
                ->where('phone', $request->phone)
                ->where('id', '!=', $professional->id)
                ->first();
                
            if ($existingProfessional) {
                return back()->withErrors(['phone' => 'The phone number with this country code already exists.'])
                    ->withInput();
            }
        }

        try {
            $professional->first_name = $request->first_name;
            $professional->last_name = $request->last_name;
            $professional->country_code = $request->country_code;
            
            // If phone number changed, set is_phone_verified to false
            if ($professional->phone != $request->phone) {
                $professional->is_phone_verified = false;
            }
            
            $professional->phone = $request->phone;
            $professional->bio = $request->bio;
            $professional->specialization = $request->specialization;
            $professional->qualification = $request->qualification;
            $professional->license_number = $request->license_number;
            $professional->license_expiry_date = $request->license_expiry_date;

            // Handle profile photo upload
            if ($request->hasFile('profile_photo')) {
                // Delete old photo if exists
                if ($professional->profile_photo) {
                    Storage::delete('public/' . $professional->profile_photo);
                }
                
                $profilePhoto = $request->file('profile_photo');
                $profilePhotoName = time() . '_' . $profilePhoto->getClientOriginalName();
                $profilePhoto->storeAs('public/professionals/photos', $profilePhotoName);
                $professional->profile_photo = 'professionals/photos/' . $profilePhotoName;
            }

            // Handle CV upload
            if ($request->hasFile('cv')) {
                // Delete old CV if exists
                if ($professional->cv) {
                    Storage::delete('public/' . $professional->cv);
                }
                
                $cv = $request->file('cv');
                $cvName = time() . '_' . $cv->getClientOriginalName();
                $cv->storeAs('public/professionals/cvs', $cvName);
                $professional->cv = 'professionals/cvs/' . $cvName;
            }

            $professional->save();

            return redirect()->route('professional.profile')
                ->with('success', 'Profile updated successfully.');

        } catch (\Exception $e) {
            Log::error('Failed to update professional profile: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while updating your profile. Please try again.');
        }
    }

    /**
     * Update the professional's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $professional = auth()->guard('professional')->user();

        if (!Hash::check($request->current_password, $professional->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }

        $professional->password = Hash::make($request->password);
        $professional->save();

        return back()->with('success', 'Password updated successfully.');
    }

    /**
     * Log the professional out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('professional')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
} 