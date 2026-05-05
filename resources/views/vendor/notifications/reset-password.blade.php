<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>

<body style="margin:0; padding:0; background:#f4f6fb; font-family: Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
<tr>
<td align="center">

    <table width="100%" cellpadding="0" cellspacing="0"
           style="max-width:500px; background:#ffffff; border-radius:12px; padding:30px; box-shadow:0 5px 20px rgba(0,0,0,0.05);">

        <!-- Logo -->
        <tr>
            <td align="center" style="padding-bottom:20px;">
                <img src="{{ asset('logo.png') }}" width="100">
            </td>
        </tr>

        <!-- Title -->
        <tr>
            <td align="center">
                <h2 style="margin:0; color:#333;">
                    🔐 Hello {{ $user->fname ?? 'User' }}
                </h2>
                <p style="color:#777; font-size:14px; margin-top:8px;">
                    Reset your password securely
                </p>
            </td>
        </tr>

        <tr>
            <td style="padding:20px 0;">
                <hr style="border:none; border-top:1px solid #eee;">
            </td>
        </tr>

        <!-- Message -->
        <tr>
            <td style="color:#555; font-size:15px; line-height:1.6;">
                We received a request to reset your password.<br><br>
                Click the button below to create a new password.
            </td>
        </tr>

        <!-- Button -->
        <tr>
            <td align="center" style="padding:30px 0;">
                <a href="{{ $actionUrl }}"
                   style="background:#ff6b6b; color:#fff; padding:14px 28px; text-decoration:none; border-radius:8px; font-weight:bold;">
                    Reset Password
                </a>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="color:#999; font-size:13px; text-align:center;">
                This link will expire in 60 minutes.<br>
                If you didn’t request this, just ignore this email.
            </td>
        </tr>

    </table>

</td>
</tr>
</table>

</body>
</html>
