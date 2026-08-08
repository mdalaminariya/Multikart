<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
</head>

<body style="margin:0;padding:0;background:#f4f4f4;font-family:Arial,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding:40px 0;">

                <table width="500" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:10px;padding:40px;box-shadow:0 5px 20px rgba(0,0,0,0.1);">

                    <tr>
                        <td align="center">

                            <h2 style="margin:0;color:#333;">
                                Email Verification
                            </h2>

                            <p style="margin-top:15px;color:#666;font-size:15px;line-height:1.7;">
                                Use the OTP below to verify your account.
                            </p>

                            <div style="
                                margin:30px 0;
                                background:#2d89ff;
                                color:white;
                                display:inline-block;
                                padding:15px 35px;
                                border-radius:8px;
                                font-size:30px;
                                font-weight:bold;
                                letter-spacing:5px;
                            ">
                                {{ $otp }}
                            </div>

                            <p style="color:#888;font-size:14px;line-height:1.6;">
                                This OTP will expire in 10 minutes.
                            </p>

                            <p style="margin-top:30px;color:#999;font-size:13px;">
                                If you did not create an account, please ignore this email.
                            </p>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
