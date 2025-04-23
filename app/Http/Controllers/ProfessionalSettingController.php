<?php

namespace App\Http\Controllers;

use App\Models\ProfessionalSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfessionalSettingController extends Controller
{
    public function edit()
    {
        $professional = auth()->user();
        $settings = $professional->settings ?? new ProfessionalSetting();
        
        return view('professional.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $professional = auth()->user();
        
        // Debug: Log the request data
        Log::info('Professional Settings Update Request:', [
            'all' => $request->all(),
            'allow_client_reschedule' => $request->input('allow_client_reschedule'),
            'max_reschedule_count' => $request->input('max_reschedule_count'),
            'has_allow_client_reschedule' => $request->has('allow_client_reschedule'),
            'has_max_reschedule_count' => $request->has('max_reschedule_count'),
        ]);
        
        $validated = $request->validate([
            'session_durations' => 'required|array',
            'session_durations.*' => 'required|integer|min:30',
            'session_fees' => 'required|array',
            'session_fees.*' => 'required|numeric|min:0',
            'working_hours' => 'required|array',
            'working_hours.*' => 'required|array',
            'working_hours.*.start' => 'required|date_format:H:i',
            'working_hours.*.end' => 'required|date_format:H:i|after:working_hours.*.start',
            'working_days' => 'required|array',
            'working_days.*' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'buffer_time' => 'required|integer|min:0|max:60',
            'is_available' => 'boolean',
            'allow_client_reschedule' => 'boolean',
            'max_reschedule_count' => 'integer|min:0',
        ]);

        $settings = $professional->settings ?? new ProfessionalSetting();
        $settings->professional_id = $professional->id;
        $settings->session_durations = $validated['session_durations'];
        $settings->session_fees = $validated['session_fees'];
        $settings->working_hours = $validated['working_hours'];
        $settings->working_days = $validated['working_days'];
        $settings->buffer_time = $validated['buffer_time'];
        $settings->is_available = $request->boolean('is_available', true);
        $settings->allow_client_reschedule = $request->boolean('allow_client_reschedule', false);
        $settings->max_reschedule_count = $request->input('max_reschedule_count', 0);
        
        // Debug: Log the settings before saving
        Log::info('Professional Settings Before Save:', [
            'allow_client_reschedule' => $settings->allow_client_reschedule,
            'max_reschedule_count' => $settings->max_reschedule_count,
        ]);
        
        $settings->save();
        
        // Debug: Log the settings after saving
        Log::info('Professional Settings After Save:', [
            'allow_client_reschedule' => $settings->allow_client_reschedule,
            'max_reschedule_count' => $settings->max_reschedule_count,
        ]);

        return redirect()->route('professional.settings.edit')
            ->with('success', 'Settings updated successfully.');
    }
}
