<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class OtpAuthController extends Controller
{
    // =========================
    // SHOW PAGE
    // =========================
    public function index()
    {
        return view('backend.forgetPassword.index');
    }

    // =========================
    // 1. SEND OTP
    // =========================
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        // Get user ONCE
        $user = User::where('email', $request->email)->first();

        // Generate OTP
        $otp = rand(100000, 999999);

        // Save OTP
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        // Full name (first + last)
        $name = trim(($user->fname ?? '') . ' ' . ($user->lname ?? ''));
        $name = $name ?: 'User';

        // =========================
        // EMAIL TEMPLATE
        // =========================
        Mail::send([], [], function ($message) use ($user, $otp, $name) {

            $message->to($user->email)
                ->subject('Password Reset OTP')
                ->html("
                    <div style='background:#f4f6f9;padding:40px 20px;font-family:Arial,sans-serif;'>

                        <div style='max-width:600px;margin:auto;background:#ffffff;
                                    border-radius:14px;overflow:hidden;
                                    box-shadow:0 5px 20px rgba(0,0,0,0.08);'>

                            <div style='background:#7366ff;padding:30px;text-align:center;color:#fff;'>
                                <h1 style='margin:0;font-size:28px;'>Multikart</h1>
                                <p style='margin-top:10px;font-size:15px;opacity:0.9;'>
                                    Password Reset Verification
                                </p>
                            </div>

                            <div style='padding:40px 30px;text-align:center;'>

                                <h2 style='margin-bottom:10px;color:#222;'>
                                    Hello my dear {$name},
                                </h2>

                                <p style='color:#666;font-size:15px;line-height:24px;'>
                                    Use the verification code below to reset your password.
                                    This OTP is valid for 10 minutes.
                                </p>

                                <div style='margin:35px 0;'>
                                    <span style='display:inline-block;
                                                background:#f4f4f4;
                                                color:#7366ff;
                                                font-size:34px;
                                                letter-spacing:8px;
                                                font-weight:bold;
                                                padding:18px 35px;
                                                border-radius:12px;
                                                border:2px dashed #7366ff;'>
                                        {$otp}
                                    </span>
                                </div>

                                <p style='font-size:14px;color:#999;'>
                                    If you did not request this, ignore this email.
                                </p>

                            </div>

                            <div style='background:#f9f9f9;
                                        padding:20px;
                                        text-align:center;
                                        font-size:13px;
                                        color:#888;'>
                                © " . date('Y') . " Multikart. All rights reserved.
                            </div>

                        </div>
                    </div>
                ");
        });

        return back()
            ->with('success', 'OTP sent successfully')
            ->with('otp_sent', true)
            ->with('email', $request->email);
    }

    // =========================
    // 2. VERIFY OTP
    // =========================
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp != $request->otp) {
            return back()
                ->withErrors(['otp' => 'Invalid OTP'])
                ->with('otp_sent', true)
                ->with('email', $request->email);
        }

        if (Carbon::now()->gt($user->otp_expires_at)) {
            return back()
                ->withErrors(['otp' => 'OTP expired'])
                ->with('otp_sent', true)
                ->with('email', $request->email);
        }

        return back()
            ->with('success', 'OTP verified successfully')
            ->with('otp_verified', true)
            ->with('email', $request->email)
            ->with('otp', $request->otp);
    }

    // =========================
    // 3. RESET PASSWORD
    // =========================
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp != $request->otp) {
            return back()
                ->withErrors(['otp' => 'Invalid OTP'])
                ->with('otp_sent', true)
                ->with('email', $request->email);
        }

        if (Carbon::now()->gt($user->otp_expires_at)) {
            return back()
                ->withErrors(['otp' => 'OTP expired'])
                ->with('otp_sent', true)
                ->with('email', $request->email);
        }

        // Update password
        $user->password = Hash::make($request->password);

        // Clear OTP
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return redirect()
            ->route('login')
            ->with('success', 'Password reset successful');
    }
}
