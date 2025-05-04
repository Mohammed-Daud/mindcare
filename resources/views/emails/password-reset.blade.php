@component('mail::message')
# Reset Your Password

You are receiving this email because we received a password reset request for your {{ $userType ?? 'user' }} account.

@component('mail::button', ['url' => $resetUrl])
Reset Password
@endcomponent

This password reset link will expire in 60 minutes.

If you did not request a password reset, no further action is required.

Best regards,<br>
{{ config('app.name') }}

<small>If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:</small>

<small>{{ $resetUrl }}</small>
@endcomponent