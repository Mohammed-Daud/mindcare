<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="x-apple-disable-message-reformatting">
<title>Password Reset - {{ config('app.name') }}</title>

<style>
    body, table, td, a {
        -webkit-text-size-adjust:100%;
        -ms-text-size-adjust:100%;
    }
    table, td {
        mso-table-lspace:0pt;
        mso-table-rspace:0pt;
    }
    img {
        border:0;
        outline:none;
        text-decoration:none;
        -ms-interpolation-mode:bicubic;
    }
    table {
        border-collapse:collapse !important;
    }
</style>
</head>

<body style="margin:0;padding:0;background-color:#f6f7f8;font-family:Arial,Helvetica,sans-serif;color:#0e181b;">

<!-- Wrapper -->
<table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="padding:40px 0;background:#f6f7f8;">
<tr>
<td align="center">

<!-- Container -->
<table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;border-radius:14px;overflow:hidden;">

<!-- Header -->
<tr>
<td align="center" style="padding:30px 20px;border-bottom:1px solid #eef2f5;">
    <span style="font-size:26px;font-weight:bold;color:#19b3e6;">
        {{ config('app.name') }}
    </span>
</td>
</tr>

<!-- Hero Image -->
<tr>
<td>
<img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDycqR6WEFKbYsnYbkWBYjcfH8bFs-advsu5Nu8PhbCQqrD9FM1PAo5IGvHEthTjabti7weDLWoFFVHNarcAmh2VOSeIvhINM_GvhxJLwniErUObUBr-xD84iKQgyjKncnY6qO22kndbXtuzmrWujh1H2JVFkBMkTnYFBx4gipDEPFWYIwbqcI1CpbuhQbj5I4AqSpTYNr2JbPB5YRsPih6UfR_eonpZYARMVV-u9kQIdzFL3pAMwa3i1dLeyKEVrMoKiziGi2EmtKC"
width="100%" height="240" alt="Calming landscape" style="display:block;width:100%;height:auto;">
</td>
</tr>

<!-- Content -->
<tr>
<td style="padding:40px 32px;">

<h1 style="margin:0 0 20px 0;font-size:26px;font-weight:bold;color:#0e181b;">
Reset Your Password
</h1>

<p style="margin:0 0 18px 0;font-size:16px;line-height:24px;color:#333;">
Hello {{ $user->name }},
</p>

<p style="margin:0 0 24px 0;font-size:16px;line-height:24px;color:#333;">
We received a request to reset the password for your {{ config('app.name') }} account. To keep your private health information secure, please use the button below to create a new password.
</p>

<!-- Button -->
<table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin:30px 0;">
<tr>
<td align="center">
<a href="{{ $resetUrl }}"
style="background:#19b3e6;color:#ffffff;font-size:16px;font-weight:bold;
padding:14px 36px;border-radius:30px;display:inline-block;text-decoration:none;">
Reset Password
</a>
</td>
</tr>
</table>

<p style="margin:0 0 6px 0;font-size:14px;color:#64748b;text-align:center;">
If the button doesn't work, copy and paste this link into your browser:
</p>

<p style="margin:0;font-size:14px;text-align:center;word-break:break-all;">
<a href="{{ $resetUrl }}" style="color:#19b3e6;">
{{ $resetUrl }}
</a>
</p>

<!-- Security Box -->
<table width="100%" cellpadding="0" cellspacing="0" role="presentation"
style="margin-top:30px;background:#e8f2ff;border-radius:10px;border:1px solid #cfe3ff;">
<tr>
<td style="padding:20px;">
<p style="margin:0 0 12px 0;font-size:14px;line-height:22px;color:#0e181b;">
<strong>Security Notice:</strong> This link expires in <strong>{{config('auth.passwords.users.expire')}} minutes</strong>.
Please do <strong style="color:#c53030;">not share this link</strong> with anyone.
</p>

<p style="margin:0;font-size:14px;line-height:22px;color:#0e181b;">
If you did not request a password reset, you can safely ignore this email.
Your account remains secure.
</p>
</td>
</tr>
</table>

</td>
</tr>

<!-- Footer -->
<tr>
<td style="background:#f8fbfc;padding:28px 24px;text-align:center;border-top:1px solid #eef2f5;">
<p style="margin:0 0 12px 0;font-size:12px;color:#64748b;font-style:italic;">
This is an automated security notification from {{ config('app.name') }}.
</p>

<p style="margin:0 0 12px 0;font-size:12px;">
<a href="#" style="color:#19b3e6;margin:0 6px;">Privacy Policy</a>
<a href="#" style="color:#19b3e6;margin:0 6px;">Terms</a>
<a href="#" style="color:#19b3e6;margin:0 6px;">Support</a>
</p>

<p style="margin:0;font-size:11px;color:#9aa5b1; text-align:center">
© {{ date('Y') }} {{ config('app.name') }} Behavioral Health Services<br>
123 Wellness Way, Suite 400, San Francisco, CA 94103
</p>
</td>
</tr>

</table>
<!-- End container -->

<p style="margin-top:20px;font-size:12px;color:#64748b;text-align:center;">
Was this sent by mistake? <a href="#" style="color:#19b3e6;">Report an issue</a>
</p>

</td>
</tr>
</table>
<!-- End wrapper -->

</body>
</html>
