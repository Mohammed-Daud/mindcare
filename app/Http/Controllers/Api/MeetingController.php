<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Professional;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MeetingController extends Controller
{
    /**
     * Validate if the authenticated user has access to the meeting
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateMeetingAccess(Request $request)
    {
        // Check if this is a JSON request or a form submission
        $isJson = $request->expectsJson() || $request->ajax();
        
        // Validate request
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'room_name' => 'required|string'
        ]);

        // Get the appointment
        $appointment = Appointment::find($request->appointment_id);
        
        // Check if the appointment exists
        if (!$appointment) {
            if ($isJson) {
                return response()->json([
                    'success' => false,
                    'message' => 'Appointment not found.'
                ]);
            } else {
                return back()->with('error', 'Appointment not found.');
            }
        }
        
        // Check if the room name matches
        if ($appointment->meeting_room !== $request->room_name) {
            if ($isJson) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid meeting room.'
                ]);
            } else {
                return back()->with('error', 'Invalid meeting room.');
            }
        }

        // Get session ID for debugging
        $sessionId = Session::getId();
        
        // Check authentication status
        $clientAuth = Auth::guard('client')->check();
        $professionalAuth = Auth::guard('professional')->check();
        
        // Debug information
        $debugInfo = [
            'session_id' => $sessionId,
            'client_auth' => $clientAuth,
            'professional_auth' => $professionalAuth,
            'cookies' => $request->cookies->all(),
            'session_data' => Session::all()
        ];
        
        // If not authenticated with either guard
        if (!$clientAuth && !$professionalAuth) {
            if ($isJson) {
                return response()->json([
                    'success' => false,
                    'message' => 'You must be logged in to access this meeting.',
                    'debug' => $debugInfo
                ]);
            } else {
                return back()->with('error', 'You must be logged in to access this meeting.');
            }
        }
        
        // Get the authenticated user
        $user = null;
        $isClient = false;
        $isProfessional = false;
        
        if ($clientAuth) {
            $user = Auth::guard('client')->user();
            $isClient = true;
        } else {
            $user = Auth::guard('professional')->user();
            $isProfessional = true;
        }
        
        // Check if user is associated with the appointment
        if ($isClient && $appointment->client_id != $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to access this meeting.',
                'debug' => [
                    'user_id' => $user->id,
                    'appointment_client_id' => $appointment->client_id
                ]
            ]);
        }

        if ($isProfessional && $appointment->professional_id != $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to access this meeting.',
                'debug' => [
                    'user_id' => $user->id,
                    'appointment_professional_id' => $appointment->professional_id
                ]
            ]);
        }

        // User is authenticated and associated with the meeting
        if ($isJson) {
            return response()->json([
                'success' => true,
                'message' => 'You have access to this meeting.'
            ]);
        } else {
            // For form submissions, return a redirect with success message
            return back()->with('success', 'Meeting link copied to clipboard.');
        }
    }
}