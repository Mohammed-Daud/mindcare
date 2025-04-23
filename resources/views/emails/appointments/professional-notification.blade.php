@component('mail::message')
# New Session Booking

Dear Dr. {{ $professionalName }},

You have a new session booking from {{ $clientName }}. Here are the details:

**Session Details:**
- Date: {{ $date }}
- Time: {{ $startTime }} - {{ $endTime }}
- Duration: {{ $duration }} minutes

**Payment Details:**
- Session Fee: ${{ number_format($fee, 2) }}
@if($discount > 0)
- Client Discount: ${{ number_format($discount, 2) }}
- Final Fee: ${{ number_format($finalFee, 2) }}
@endif

You can access the session by clicking the button below at the scheduled time:

@component('mail::button', ['url' => $sessionUrl])
Join Session
@endcomponent

**Pre-session Checklist:**
1. Review client information before the session
2. Test your camera and microphone
3. Ensure you have a stable internet connection
4. Find a quiet, private space for the session
5. Have your session notes ready
6. Have a backup device ready in case of technical issues

Please join the session 5 minutes before the scheduled time to ensure a smooth start.

Best regards,<br>
{{ config('app.name') }}

<small>If you're having trouble with the session link, copy and paste this URL into your browser: {{ $sessionUrl }}</small>
@endcomponent 