<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserAuthenticationController extends Controller
{
    // =========================
    // LOGIN PAGE
    // =========================

    public function login()
    {
        return view('frontend.auth.login');
    }

    // =========================
    // LOGIN SUBMIT
    // =========================

    public function loginSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'No account found with this email address.',
            ])->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Incorrect password.',
            ])->withInput();
        }

        // Don't login until email is verified
        if (!$user->hasVerifiedEmail()) {
            return redirect()->route('login')
                ->with('error', 'Please verify your email before logging in.');
        }

        Auth::login($user);

        $request->session()->regenerate();

        $user->update([
            'last_login' => now(),
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Login successful!');
    }

    // =========================
    // EMAIL VERIFY
    // =========================

    public function verify($id, $hash)
    {
        $user = User::findOrFail($id);

        if (!hash_equals(
            (string) $hash,
            sha1($user->getEmailForVerification())
        )) {
            abort(403);
        }

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        Auth::login($user);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Email verified!');
    }

    // =========================
    // LOGOUT
    // =========================

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home')
            ->with('success', 'Logout successful!');
    }

    // =========================
    // REGISTER PAGE
    // =========================

    public function register()
    {
        return view('frontend.auth.register');
    }

    // =========================
    // USER REGISTER
    // =========================

    public function registerSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:6',
            'g-recaptcha-response' => 'required',
        ]);

        $validator->after(function ($validator) use ($request) {

            $response = Http::asForm()->post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'secret' => '6LfeKc8sAAAAAEcG6sXcaYJLjZptjvirmtpsQhWT',
                    'response' => $request->input('g-recaptcha-response'),
                    'remoteip' => $request->ip(),
                ]
            );

            if (!data_get($response->json(), 'success')) {
                $validator->errors()->add(
                    'g-recaptcha-response',
                    'Captcha verification failed.'
                );
            }
        });

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Generate OTP
        $otp = rand(100000, 999999);

        // Create user
        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        // Send OTP Mail
        Mail::to($user->email)->send(new OtpMail($otp));

        // Store user ID in session
        session([
            'verify_user_id' => $user->id,
        ]);

        return redirect()
            ->route('otp.verify.page')
            ->with('success', 'OTP sent to your email.');
    }

    // =========================
    // OTP VERIFY PAGE
    // =========================

    public function otpVerifyPage()
    {
        $user = User::find(session('verify_user_id'));

        if (!$user) {
            return redirect()
                ->route('register')
                ->with('error', 'Session expired.');
        }

        return view(
            'frontend.auth.emails.otp_verify',
            compact('user')
        );
    }

    // =========================
    // RESEND OTP
    // =========================

    public function resendOtp(Request $request)
    {
        $userId = session('verify_user_id');

        if (!$userId) {
            return redirect()
                ->route('register')
                ->with('error', 'Session expired.');
        }

        $user = User::find($userId);

        if (!$user) {
            return back()
                ->with('error', 'User not found.');
        }

        // Generate new OTP
        $otp = (string) random_int(100000, 999999);

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(3),
        ]);

        Mail::to($user->email)->send(new OtpMail($otp));

        return back()
            ->with('success', 'OTP resent successfully.');
    }

    // =========================
    // OTP VERIFY
    // =========================

    public function otpVerify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $userId = session('verify_user_id');

        if (!$userId) {
            return redirect()
                ->route('register')
                ->with('error', 'Session expired. Please register again.');
        }

        $user = User::find($userId);

        if (!$user) {
            return redirect()
                ->route('register')
                ->with('error', 'User not found.');
        }

        // Check OTP exists
        if (!$user->otp) {
            return back()
                ->with('error', 'OTP not found. Please resend OTP.');
        }

        // Check expiry
        if (now()->gt($user->otp_expires_at)) {
            return back()
                ->with('error', 'OTP expired. Please resend OTP.');
        }

        // Strict compare
        if ((string) $user->otp !== (string) trim($request->otp)) {
            return back()
                ->with('error', 'Invalid OTP');
        }

        // Verify user
        $user->update([
            'email_verified_at' => now(),
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        session()->forget('verify_user_id');

        Auth::login($user);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Email verified successfully.');
    }

    // =========================================================
    // ADMIN USER CREATE PAGE
    // =========================================================

    public function view()
    {
        return view('backend.users.registration');
    }

    // =========================================================
    // ADMIN CREATE USER
    // =========================================================

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:manager,user',
        ]);

        User::create([
            'fname' => $request->first_name,
            'lname' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email_verified_at' => now(),
        ]);

        return back()
            ->with('success', 'User Created Successfully');
    }

    // =========================================================
    // USER LIST
    // =========================================================

    public function list()
    {
        $users = User::where('role', '!=', 'admin')
            ->latest()
            ->get();

        return view(
            'backend.users.userlist',
            compact('users')
        );
    }

    // =========================================================
    // DELETE USER
    // =========================================================

    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
        }

        return back()
            ->with('success', 'User Deleted Successfully');
    }

    // =========================================================
    // VENDOR LIST
    // =========================================================

    public function index()
    {
        $vendors = User::where('role', 'vendor')
            ->withCount([
                'physicalProducts',
                'digitalProducts',
            ])
            ->latest()
            ->get();

        return view(
            'backend.vendors.index',
            compact('vendors')
        );
    }

    // =========================================================
    // VENDOR CREATE PAGE
    // =========================================================

    public function create()
    {
        return view('backend.vendors.create');
    }

    // =========================================================
    // ADMIN CREATES VENDOR ACCOUNT
    // =========================================================
    //
    // Admin only enters:
    // fname
    // lname
    // email
    // password
    //
    // Vendor will enter the remaining information themselves.
    // =========================================================

    public function vendorStore(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            // This makes the account a vendor
            'role' => 'vendor',

            // Admin-created vendor is already verified
            'email_verified_at' => now(),
        ]);

        return redirect()
            ->route('admin.vendors.list')
            ->with('success', 'Vendor created successfully.');
    }

    // =========================================================
    // VENDOR EDIT PAGE
    // =========================================================
    //
    // Admin does not edit vendor store/bank information.
    // Vendor manages their own information.
    // =========================================================

    public function edit($id)
    {
        $vendor = User::where('role', 'vendor')
            ->findOrFail($id);

        return view(
            'backend.vendors.edit',
            compact('vendor')
        );
    }

    // =========================================================
    // VENDOR UPDATE
    // =========================================================
    //
    // If this route is still used from the admin panel,
    // it only updates the vendor's basic account information.
    //
    // Store/bank/contact information is updated by the vendor.
    // =========================================================

    public function update(Request $request, $id)
    {
        $vendor = User::where('role', 'vendor')
            ->findOrFail($id);

        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $vendor->id,
        ]);

        $vendor->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('admin.vendors.list')
            ->with('success', 'Vendor updated successfully.');
    }

    // =========================================================
    // VENDOR DELETE
    // =========================================================

    public function vendorDelete($id)
    {
        $vendor = User::where('role', 'vendor')
            ->findOrFail($id);

        $vendor->delete();

        return redirect()
            ->route('admin.vendors.list')
            ->with('success', 'Vendor deleted successfully.');
    }

    // =========================================================
    // VENDOR PROFILE PAGE
    // =========================================================
    //
    // Vendor sees their own information and fills in:
    //
    // store_name
    // phone
    // address
    // city
    // country
    // bank_account_no
    // bank_name
    // bank_holder_name
    // swift
    // ifsc
    // paypal_email
    //
    // =========================================================

    public function vendorProfile()
    {
        $user = Auth::user();

        // Make sure only vendors can access this page
        if ($user->role !== 'vendor') {
            abort(403);
        }

        return view(
            'frontend.vendor.profile',
            compact('user')
        );
    }

    // =========================================================
    // VENDOR PROFILE UPDATE
    // =========================================================

    public function vendorProfileUpdate(Request $request)
    {
        $user = Auth::user();

        // Make sure only vendors can update this information
        if ($user->role !== 'vendor') {
            abort(403);
        }

        $request->validate([
            'store_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',

            'bank_account_no' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'bank_holder_name' => 'nullable|string|max:255',
            'swift' => 'nullable|string|max:255',
            'ifsc' => 'nullable|string|max:255',

            'paypal_email' => 'nullable|email|max:255',
        ]);

        $user->update([
            'store_name' => $request->store_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,

            'bank_account_no' => $request->bank_account_no,
            'bank_name' => $request->bank_name,
            'bank_holder_name' => $request->bank_holder_name,
            'swift' => $request->swift,
            'ifsc' => $request->ifsc,

            'paypal_email' => $request->paypal_email,
        ]);

        return back()
            ->with('success', 'Store information updated successfully.');
    }
}