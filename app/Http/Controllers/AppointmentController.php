<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Professional;
use App\Models\CouponCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmation;
use App\Mail\AppointmentReminder;
use App\Mail\ProfessionalAppointmentNotification;
use App\Notifications\AppointmentStartingSoon;
use Carbon\Carbon;
use PDF;
use App\Mail\AppointmentRescheduled;
use App\Mail\ProfessionalAppointmentRescheduled;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client')->except(['checkAvailability']);
    }

    public function index()
    {
        $appointments = Appointment::where('client_id', auth()->id())
            ->with('professional')
            ->orderBy('start_time', 'desc')
            ->paginate(10);
            
        return view('client.appointments.index', compact('appointments'));
    }

    public function create(Professional $professional)
    {
        $settings = $professional->settings;
        
        // Check if settings exist, if not redirect with error
        if (!$settings) {
            return redirect()->route('professionals')
                ->with('error', 'This professional has not set up their availability yet. Please try another professional.');
        }
        
        return view('appointments.create', compact('professional', 'settings'));
    }

    public function checkAvailability(Request $request, Professional $professional)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'duration' => 'required|integer|min:30',
        ]);

        $date = Carbon::parse($request->date);
        $settings = $professional->settings;

        if (!$settings) {
            return response()->json([
                'available' => false, 
                'message' => 'This professional has not set up their availability yet.'
            ]);
        }

        if (!$settings->isWorkingDay($date->format('l'))) {
            return response()->json(['available' => false, 'message' => 'Professional is not available on this day']);
        }

        $workingHours = $settings->getWorkingHours($date->format('l'));
        $availableSlots = [];

        $startTime = Carbon::parse($date->format('Y-m-d') . ' ' . $workingHours['start']);
        $endTime = Carbon::parse($date->format('Y-m-d') . ' ' . $workingHours['end']);

        while ($startTime->copy()->addMinutes($request->duration)->lte($endTime)) {
            $slotEnd = $startTime->copy()->addMinutes($request->duration);
            
            if ($settings->isTimeSlotAvailable($startTime, $slotEnd)) {
                $availableSlots[] = [
                    'start' => $startTime->format('H:i'),
                    'end' => $slotEnd->format('H:i'),
                ];
            }

            $startTime->addMinutes($settings->buffer_time + $request->duration);
        }

        // If this is an AJAX request from the reschedule form
        if ($request->ajax()) {
            // Check if the requested time is within working hours
            $requestedTime = $request->input('time');
            if ($requestedTime) {
                $requestedDateTime = Carbon::parse($date->format('Y-m-d') . ' ' . $requestedTime);
                $requestedEndTime = $requestedDateTime->copy()->addMinutes($request->duration);
                
                $dayStart = Carbon::parse($date->format('Y-m-d') . ' ' . $workingHours['start']);
                $dayEnd = Carbon::parse($date->format('Y-m-d') . ' ' . $workingHours['end']);
                
                if ($requestedDateTime->lt($dayStart) || $requestedEndTime->gt($dayEnd)) {
                    return response()->json([
                        'available' => false,
                        'message' => 'Selected time is outside working hours.'
                    ]);
                }
                
                // Check if the specific time slot is available
                if ($settings->isTimeSlotAvailable($requestedDateTime, $requestedEndTime)) {
                    return response()->json([
                        'available' => true,
                        'message' => 'Time slot is available!'
                    ]);
                } else {
                    return response()->json([
                        'available' => false,
                        'message' => 'Selected time slot is not available.'
                    ]);
                }
            }
        }

        return response()->json([
            'available' => count($availableSlots) > 0,
            'slots' => $availableSlots,
        ]);
    }

    public function store(Request $request, Professional $professional)
    {
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:30',
            'coupon_code' => 'nullable|string|exists:coupon_codes,code',
        ]);

        $settings = $professional->settings;
        
        if (!$settings) {
            return back()->with('error', 'This professional has not set up their availability yet. Please try another professional.');
        }
        
        $startTime = Carbon::parse($validated['date'] . ' ' . $validated['time']);
        $endTime = $startTime->copy()->addMinutes($validated['duration']);

        if (!$settings->isTimeSlotAvailable($startTime, $endTime)) {
            return back()->with('error', 'Selected time slot is not available.');
        }

        $fee = $settings->getSessionFee($validated['duration']);
        if (!$fee) {
            return back()->with('error', 'Invalid session duration selected.');
        }

        $discountAmount = 0;
        $couponCode = null;

        // Check for WELCOME100 coupon
        if ($validated['coupon_code'] === 'WELCOME100') {
            $discountAmount = $fee; // 100% discount
            $couponCode = 'WELCOME100';
        } else {
            // Check other coupon codes
            $coupon = CouponCode::where('code', $validated['coupon_code'])->first();
            if ($coupon && $coupon->isValid()) {
                $discountAmount = $coupon->calculateDiscount($fee);
                $coupon->incrementUsage();
                $couponCode = $coupon->code;
            }
        }

        $appointment = new Appointment();
        $appointment->client_id = auth()->id();
        $appointment->professional_id = $professional->id;
        $appointment->start_time = $startTime;
        $appointment->end_time = $endTime;
        $appointment->fee = $fee;
        $appointment->discount_amount = $discountAmount;
        $appointment->coupon_code = $couponCode;
        $appointment->status = 'confirmed';
        $appointment->save();

        // Generate PDF receipt
        $pdf = PDF::loadView('appointments.receipt', compact('appointment', 'professional'));
        $pdfPath = storage_path('app/receipts/' . $appointment->id . '.pdf');
        
        // Ensure the receipts directory exists
        $receiptsDir = storage_path('app/receipts');
        if (!file_exists($receiptsDir)) {
            mkdir($receiptsDir, 0755, true);
        }
        
        $pdf->save($pdfPath);

        // Send confirmation emails with receipt
        Mail::to(auth()->user()->email)->send(new AppointmentConfirmation($appointment, $pdfPath));
        Mail::to($professional->email)->send(new ProfessionalAppointmentNotification($appointment));

        // If no coupon applied, show payment instructions
        if (!$couponCode) {
            return redirect()->route('client.appointments')
                ->with('success', 'Appointment booked successfully. Please pay ₹' . ($fee - $discountAmount) . ' to UP 7210000000 and attach the screenshot.')
                ->with('payment_instructions', true);
        }

        return redirect()->route('client.appointments')
            ->with('success', 'Appointment booked successfully with ' . ($discountAmount == $fee ? '100% discount' : 'discount applied') . '.');
    }

    public function cancel(Appointment $appointment)
    {
        if ($appointment->client_id !== auth()->id()) {
            abort(403);
        }

        if ($appointment->start_time->isPast()) {
            return back()->with('error', 'Cannot cancel past appointments.');
        }

        if ($appointment->start_time->diffInHours(now()) < 24) {
            return back()->with('error', 'Appointments must be cancelled at least 24 hours in advance.');
        }

        $appointment->status = 'cancelled';
        $appointment->save();

        return back()->with('success', 'Appointment cancelled successfully.');
    }

    public function sendReminders()
    {
        // Send reminders for tomorrow's appointments
        $tomorrow = Carbon::tomorrow();
        $appointments = Appointment::where('status', 'confirmed')
            ->whereDate('start_time', $tomorrow)
            ->with(['client', 'professional'])
            ->get();

        foreach ($appointments as $appointment) {
            Mail::to($appointment->client->email)
                ->send(new AppointmentReminder($appointment));
            
            Mail::to($appointment->professional->email)
                ->send(new AppointmentReminder($appointment));
        }

        // Send 10-minute reminders
        $tenMinutesFromNow = Carbon::now()->addMinutes(10);
        $upcomingAppointments = Appointment::where('status', 'confirmed')
            ->whereBetween('start_time', [
                $tenMinutesFromNow->copy()->subMinute(),
                $tenMinutesFromNow->copy()->addMinute()
            ])
            ->with(['client', 'professional'])
            ->get();

        foreach ($upcomingAppointments as $appointment) {
            $appointment->client->notify(new AppointmentStartingSoon($appointment));
            $appointment->professional->notify(new AppointmentStartingSoon($appointment));
        }
    }

    public function reschedule(Request $request, Appointment $appointment)
    {
        // Check if client is authorized
        if ($appointment->client_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        // Get professional settings
        $settings = $appointment->professional->settings;
        
        // Check if rescheduling is allowed
        if (!$settings || !$settings->allow_client_reschedule) {
            return response()->json([
                'success' => false,
                'message' => 'Rescheduling is not allowed for this professional.'
            ], 400);
        }

        // Check if max reschedule count is reached
        if ($appointment->reschedule_count >= $settings->max_reschedule_count) {
            return response()->json([
                'success' => false,
                'message' => 'Maximum number of reschedules reached.'
            ], 400);
        }

        // Validate new appointment time
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
        ]);

        $newStartTime = Carbon::parse($validated['date'] . ' ' . $validated['time']);
        $newEndTime = $newStartTime->copy()->addMinutes($appointment->duration);

        // Check if new time slot is available
        if (!$settings->isTimeSlotAvailable($newStartTime, $newEndTime)) {
            return response()->json([
                'success' => false,
                'message' => 'Selected time slot is not available.'
            ], 400);
        }

        // Check if the new time is within working hours
        if (!$settings->isWorkingDay($newStartTime->format('l'))) {
            return response()->json([
                'success' => false,
                'message' => 'Professional is not available on this day.'
            ], 400);
        }

        $workingHours = $settings->getWorkingHours($newStartTime->format('l'));
        $dayStart = Carbon::parse($newStartTime->format('Y-m-d') . ' ' . $workingHours['start']);
        $dayEnd = Carbon::parse($newStartTime->format('Y-m-d') . ' ' . $workingHours['end']);

        if ($newStartTime->lt($dayStart) || $newEndTime->gt($dayEnd)) {
            return response()->json([
                'success' => false,
                'message' => 'Selected time is outside working hours.'
            ], 400);
        }

        // Update appointment
        $oldStartTime = $appointment->start_time;
        $appointment->start_time = $newStartTime;
        $appointment->end_time = $newEndTime;
        $appointment->reschedule_count += 1;
        $appointment->last_rescheduled_at = now();
        $appointment->save();

        // Send notifications
        $this->sendRescheduleNotifications($appointment, $oldStartTime);

        return response()->json([
            'success' => true,
            'message' => 'Appointment rescheduled successfully.'
        ]);
    }

    private function sendRescheduleNotifications($appointment, $oldStartTime)
    {
        // Notify client
        Mail::to($appointment->client->email)->send(new AppointmentRescheduled(
            $appointment,
            $oldStartTime
        ));

        // Notify professional
        Mail::to($appointment->professional->email)->send(new ProfessionalAppointmentRescheduled(
            $appointment,
            $oldStartTime
        ));
    }
}
