<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->id;
        $professional = Professional::where('id', $id)->first();
        
        if (!$professional) {
            return redirect()->route('professionals')->with('error', 'Professional not found.');
        }
        
        return view('profile', compact('professional'));
    }

    public function professionals(Request $request)
    {
        $query = Professional::where('status', 'approved');

        // Handle search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('specialization', 'like', "%{$search}%");
            });
        }

        // Handle specialization filter
        if ($request->has('specialization') && $request->specialization !== 'all') {
            $query->where('specialization', $request->specialization);
        }

        // Get unique specializations for the filter dropdown
        $specializations = Professional::where('status', 'approved')
            ->distinct()
            ->pluck('specialization')
            ->filter()
            ->values();

        $professionals = $query->orderBy('created_at', 'desc')->get();
            
        return view('professionals', compact('professionals', 'specializations'));
    }
    
    /**
     * Display the specified professional's public profile.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $professional = Professional::where('slug', $slug)
            ->where('status', 'approved')
            ->firstOrFail();
            
        return view('professional.public-profile', compact('professional'));
    }
}
