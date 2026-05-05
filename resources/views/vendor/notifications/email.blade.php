<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verify Email</title>
</head>

<body style="margin:0; padding:0; background:#f4f6fb; font-family: Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6fb; padding:40px 0;">
<tr>
<td align="center">

    <!-- Card -->
    <table width="100%" cellpadding="0" cellspacing="0"
           style="max-width:500px; background:#ffffff; border-radius:12px; padding:30px; box-shadow:0 5px 20px rgba(0,0,0,0.05);">

        <!-- Logo -->
        <tr>
            <td align="center" style="padding-bottom:20px;">
                <img src="{{ asset('logo.png') }}" width="100" alt="Logo">
            </td>
        </tr>

        <!-- Title -->
        <tr>
            <td align="center">
                <h2 style="margin:0; color:#333;">
                    👋 Hello {{ $user->fname ?? 'User' }}
                </h2>
                <p style="color:#777; font-size:14px; margin-top:8px;">
                    Welcome! Please verify your email to get started
                </p>
            </td>
        </tr>

        <!-- Divider -->
        <tr>
            <td style="padding:20px 0;">
                <hr style="border:none; border-top:1px solid #eee;">
            </td>
        </tr>

        <!-- Message -->
        <tr>
            <td style="color:#555; font-size:15px; line-height:1.6;">
                Thank you for signing up with us 🎉 <br><br>
                To activate your account, please confirm your email address by clicking the button below.
            </td>
        </tr>

        <!-- Button -->
        <tr>
            <td align="center" style="padding:30px 0;">
                <a href="{{ $actionUrl }}"
                   style="
                        background: linear-gradient(135deg,#4f7cff,#3358ff);
                        color:#ffffff;
                        padding:14px 28px;
                        text-decoration:none;
                        border-radius:8px;
                        font-weight:bold;
                        display:inline-block;
                        box-shadow:0 4px 10px rgba(79,124,255,0.3);
                   ">
                    Verify Email Address
                </a>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="color:#999; font-size:13px; text-align:center;">
                If you didn’t create this account, you can safely ignore this email.
            </td>
        </tr>

    </table>

    <!-- Bottom text -->
    <p style="font-size:12px; color:#aaa; margin-top:20px;">
        © {{ date('Y') }} Your Company. All rights reserved.
    </p>

</td>
</tr>
</table>

</body>
</html>
