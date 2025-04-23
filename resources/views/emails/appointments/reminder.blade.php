@component('mail::message')
# Session Reminder

Dear {{ $clientName }},

This is a reminder that you have a session scheduled for tomorrow with Dr. {{ $professionalName }}.

**Session Details:**
- Date: {{ $date }}
- Time: {{ $startTime }} - {{ $endTime }}
- Duration: {{ $duration }} minutes

You can join your session by clicking the button below at the scheduled time:

@component('mail::button', ['url' => $sessionUrl])
Join Session
@endcomponent

**Pre-session Checklist:**
1. Test your camera and microphone
2. Ensure you have a stable internet connection
3. Find a quiet, private space for your session
4. Have a backup device ready (like a phone) in case of technical issues
5. Prepare any questions or topics you'd like to discuss

We recommend joining the session 5 minutes before the scheduled time.

Best regards,<br>
{{ config('app.name') }}

<small>If you're having trouble with the session link, copy and paste this URL into your browser: {{ $sessionUrl }}</small>
@endcomponent 