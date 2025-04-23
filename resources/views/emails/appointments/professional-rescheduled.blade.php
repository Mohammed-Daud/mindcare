@component('mail::message')
# Appointment Rescheduled by Client

Dear Dr. {{ $professionalName }},

An appointment has been rescheduled by {{ $clientName }}.

**Previous Appointment:**
- Date: {{ $oldDate }}
- Time: {{ $oldTime }}

**New Appointment:**
- Date: {{ $newDate }}
- Time: {{ $newTime }}
- Duration: {{ $appointment->duration }} minutes

@if($appointment->notes)
**Client Notes:**
{{ $appointment->notes }}
@endif

You can view the appointment details in your dashboard:

@component('mail::button', ['url' => route('professional.appointments')])
View Appointment
@endcomponent

Best regards,<br>
{{ config('app.name') }}
@endcomponent 