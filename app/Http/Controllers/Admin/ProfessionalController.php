<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Professional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Mail\ApprovalEmail;
use App\Mail\ProfessionalRejectionEmail;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of professionals.
     */
    public function index()
    {
        $professionals = Professional::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.professionals.index', compact('professionals'));
    }

    /**
     * Display the specified professional.
     */
    public function show(Professional $professional)
    {
        return view('admin.professionals.show', compact('professional'));
    }

    /**
     * Show the form for editing the specified professional.
     */
    public function edit(Professional $professional)
    {
        return view('admin.professionals.edit', compact('professional'));
    }

    /**
     * Update the specified professional in storage.
     */
    public function update(Request $request, Professional $professional)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:professionals,email,' . $professional->id,
            'phone' => 'nullable|string|max:20',
            'specialization' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'license_number' => 'required|string|max:255',
            'license_expiry_date' => 'required|date',
            'bio' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // Generate base slug from first and last name
        $baseSlug = Str::slug($validated['first_name'] . '-' . $validated['last_name']);
        $slug = $baseSlug;
        $counter = 1;

        // Check if slug exists and append number if needed
        while (Professional::where('slug', $slug)
                          ->where('id', '!=', $professional->id)
                          ->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $validated['slug'] = $slug;

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $validated['profile_photo'] = $path;
        }

        // Handle CV upload
        if ($request->hasFile('cv')) {
            $path = $request->file('cv')->store('cvs', 'public');
            $validated['cv'] = $path;
        }

        $professional->update($validated);

        return redirect()->route('admin.professionals.index')
            ->with('success', 'Professional updated successfully.');
    }

    /**
     * Remove the specified professional from storage.
     */
    public function destroy(Professional $professional)
    {
        $professional->delete();
        return redirect()->route('admin.professionals.index')
            ->with('success', 'Professional deleted successfully.');
    }

    /**
     * Update the professional's status.
     */
    public function updateStatus(Request $request, Professional $professional)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $professional->update($validated);

        return redirect()->route('admin.professionals.index')
            ->with('success', 'Professional status updated successfully.');
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
            $professional->update([
                'status' => 'approved',
                'password' => Hash::make($password)
            ]);

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
            $professional->update(['status' => 'rejected']);
            Log::info('Professional rejected: ' . $professional->email);

            // Send rejection email
            try {
                Mail::to($professional->email)->send(new ProfessionalRejectionEmail($professional));
                Log::info('Rejection email sent successfully to ' . $professional->email);
            } catch (\Exception $e) {
                Log::error('Failed to send rejection email: ' . $e->getMessage());
                // Even if email fails, we don't want to rollback the rejection
                return redirect()->route('admin.professionals.index')
                    ->with('warning', 'Professional rejected but failed to send email. Please check the logs.');
            }

            return redirect()->route('admin.professionals.index')
                ->with('success', 'Professional has been rejected and notification email has been sent.');

        } catch (\Exception $e) {
            Log::error('Failed to reject professional: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while rejecting the professional.');
        }
    }
}
