@component('mail::message')
# Appointment Rescheduled

Dear {{ $clientName }},

Your appointment with Dr. {{ $professionalName }} has been rescheduled.

**Previous Appointment:**
- Date: {{ $oldDate }}
- Time: {{ $oldTime }}

**New Appointment:**
- Date: {{ $newDate }}
- Time: {{ $newTime }}
- Duration: {{ $appointment->duration }} minutes

@if($appointment->notes)
**Additional Notes:**
{{ $appointment->notes }}
@endif

You can view your appointment details by clicking the button below:

@component('mail::button', ['url' => route('client.appointments')])
View Appointment
@endcomponent

If you need to make any further changes, please contact us at support@mindcare.com.

Best regards,<br>
{{ config('app.name') }}
@endcomponent 