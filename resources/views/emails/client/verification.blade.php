@component('mail::message')
# Welcome to MindCare!

Dear {{ $name }},

Thank you for registering with MindCare. To complete your registration and start booking sessions with our professionals, please verify your email address by clicking the button below:

@component('mail::button', ['url' => $verificationUrl])
Verify Email Address
@endcomponent

This verification link will expire in 24 hours. If you did not create an account, no further action is required.

Best regards,<br>
{{ config('app.name') }}

<small>If you're having trouble clicking the "Verify Email Address" button, copy and paste the following URL into your web browser: {{ $verificationUrl }}</small>
@endcomponent 