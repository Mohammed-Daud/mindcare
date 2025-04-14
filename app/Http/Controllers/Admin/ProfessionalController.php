<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Professional;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $professional->update(['status' => 'approved']);
        
        // Send approval email to the professional
        // This will be implemented later
        
        return redirect()->route('admin.professionals.index')
            ->with('success', 'Professional approved successfully.');
    }

    /**
     * Reject the specified professional.
     */
    public function reject(Professional $professional)
    {
        $professional->update(['status' => 'rejected']);
        
        // Send rejection email to the professional
        // This will be implemented later
        
        return redirect()->route('admin.professionals.index')
            ->with('success', 'Professional rejected successfully.');
    }
}
