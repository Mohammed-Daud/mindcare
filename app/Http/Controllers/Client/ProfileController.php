<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        $client = auth()->guard('client')->user();
        return view('client.profile.edit', compact('client'));
    }

    public function update(Request $request)
    {
        $client = auth()->guard('client')->user();

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('clients')->ignore($client->id)],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'profile_photo' => ['nullable', 'image', 'max:2048'], // max 2MB
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // Update basic information
        $client->first_name = $validated['first_name'];
        $client->last_name = $validated['last_name'];
        $client->email = $validated['email'];
        $client->phone = $validated['phone'];
        $client->address = $validated['address'];

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old profile photo if exists
            if ($client->profile_photo) {
                Storage::disk('public')->delete($client->profile_photo);
            }

            // Store new profile photo
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $client->profile_photo = $path;
        }

        // Update password if provided
        if (!empty($validated['password'])) {
            $client->password = Hash::make($validated['password']);
        }

        $client->save();

        return redirect()->route('client.dashboard')
            ->with('success', 'Profile updated successfully.');
    }
} 