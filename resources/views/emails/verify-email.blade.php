<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="x-apple-disable-message-reformatting">
<title>Email Verification - MindfulCare</title>

<style>
body, table, td, a{
    -webkit-text-size-adjust:100%;
    -ms-text-size-adjust:100%;
}
table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;}
img{-ms-interpolation-mode:bicubic; border:0; outline:none; text-decoration:none;}
table{border-collapse:collapse!important;}
a{text-decoration:none;}
</style>
</head>

<body style="margin:0;padding:0;background:#f4f4f4;font-family:Arial,Helvetica,sans-serif;color:#0e181b;">

<!-- Outer wrapper -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#f4f4f4;padding:40px 0;">
<tr>
<td align="center">

<!-- Main container -->
<table width="600" border="0" cellspacing="0" cellpadding="0" style="background:#ffffff;border-radius:12px;overflow:hidden;">
<tr>
<td align="center" style="padding:30px 20px;border-bottom:1px solid #e7e7e7;">
    <a href="#" target="_blank" style="font-size:26px;font-weight:bold;color:#19b3e6;text-decoration:none;">
        <img src="https://upload.wikimedia.org/wikipedia/commons/0/05/Octicons-verified.svg"
        width="32" height="32" alt="" style="vertical-align:middle;margin-right:8px;">
        MindfulCare
    </a>
</td>
</tr>

<!-- Banner image -->
<tr>
<td>
<img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDycqR6WEFKbYsnYbkWBYjcfH8bFs-advsu5Nu8PhbCQqrD9FM1PAo5IGvHEthTjabti7weDLWoFFVHNarcAmh2VOSeIvhINM_GvhxJLwniErUObUBr-xD84iKQgyjKncnY6qO22kndbXtuzmrWujh1H2JVFkBMkTnYFBx4gipDEPFWYIwbqcI1CpbuhQbj5I4AqSpTYNr2JbPB5YRsPih6UfR_eonpZYARMVV-u9kQIdzFL3pAMwa3i1dLeyKEVrMoKiziGi2EmtKC"
width="100%" alt="Calm nature scene" style="display:block;">
</td>
</tr>

<!-- Content -->
<tr>
<td style="padding:40px 30px;">
    <h1 style="font-size:24px;font-weight:bold;margin:0 0 20px 0;color:#0e181b;text-align:center;">
        Verify your email address
    </h1>

    <p style="font-size:16px;line-height:24px;margin:0 0 18px 0;color:#444;">Hello {{ $user->name }},</p>

    <p style="font-size:16px;line-height:24px;margin:0 0 18px 0;color:#444;">
        Welcome to MindfulCare. We are honored to be a part of your journey towards mental wellness.
    </p>

    <p style="font-size:16px;line-height:24px;margin:0 0 28px 0;color:#444;">
        For your security, please verify your email address to continue using your account safely.
    </p>

    <div align="center" style="margin-bottom:30px;">
        <a href="{{ $verificationUrl }}"
        style="display:inline-block;background:#19b3e6;color:#ffffff;font-size:16px;font-weight:bold;
        padding:14px 30px;border-radius:30px;text-decoration:none;">
            Verify Email Address
        </a>
    </div>

    <p style="font-size:14px;color:#888;margin:0 0 8px 0;text-align:center;">
        If the button doesn't work, copy and paste the link below:
    </p>
    <p style="font-size:14px;color:#19b3e6;word-break:break-all;text-align:center;">
        <a href="{{ $verificationUrl }}" style="color:#19b3e6;">
        {{ $verificationUrl }}
        </a>
    </p>

    <!-- Box message -->
    <table width="100%" border="0" cellspacing="0" cellpadding="0"
    style="background:#e8f7e5;border:1px solid #c8ebcc;border-radius:8px;margin-top:30px;">
    <tr>
    <td style="padding:16px;font-size:14px;color:#333;">
        <strong style="color:#126a42;">Didn't create an account?</strong>
        If you received this email by mistake, simply ignore it. Your email will not be linked until verified.
    </td>
    </tr>
    </table>

</td>
</tr>

<!-- Footer -->
<tr>
<td style="background:#f8fafc;padding:30px;text-align:center;font-size:12px;color:#777;">
    <p style="margin:0 0 10px 0;">This is an automated message. Please do not reply.</p>

    <p style="margin:0 0 10px 0;">
        <a href="#" style="color:#19b3e6;">Privacy Policy</a> •
        <a href="#" style="color:#19b3e6;">Terms</a> •
        <a href="#" style="color:#19b3e6;">Help Center</a>
    </p>

    <p style="margin:0;color:#aaa;font-size:11px;">
        MindfulCare Inc., 123 Wellness Way, Suite 400, San Francisco, CA 94103
    </p>
</td>
</tr>

</table>
<!-- end container -->

</td>
</tr>
</table>
<!-- end wrapper -->

</body>
</html>
