@component('mail::message')
# Session Booking Confirmation

Dear {{ $clientName }},

Your session with Dr. {{ $professionalName }} has been confirmed. Here are the details:

**Session Details:**
- Date: {{ $date }}
- Time: {{ $startTime }} - {{ $endTime }}
- Duration: {{ $duration }} minutes

**Payment Details:**
- Session Fee: ${{ number_format($fee, 2) }}
@if($discount > 0)
- Discount: ${{ number_format($discount, 2) }}
- Final Fee: ${{ number_format($finalFee, 2) }}
@endif

You can join your session by clicking the button below at the scheduled time:

@component('mail::button', ['url' => $sessionUrl])
Join Session
@endcomponent

**Important Notes:**
1. Please join the session 5 minutes before the scheduled time.
2. Ensure you have a stable internet connection.
3. Find a quiet, private space for your session.
4. Have a backup device ready (like a phone) in case of technical issues.

If you need to cancel or reschedule, please do so at least 24 hours before the session.

Best regards,<br>
{{ config('app.name') }}

<small>If you're having trouble with the session link, copy and paste this URL into your browser: {{ $sessionUrl }}</small>
@endcomponent 