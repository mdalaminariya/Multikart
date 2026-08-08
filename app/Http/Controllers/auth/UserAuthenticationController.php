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

        // ❌ Don't login yet until verified
        if (!$user->hasVerifiedEmail()) {
            return redirect()->route('login')
                ->with('error', 'Please verify your email before logging in.');
        }

        Auth::login($user);
            $request->session()->regenerate();

            $user->update([
                'last_login' => now()
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

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
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
        return redirect()->route('home')->with('success', 'Logout successful!');
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
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|min:6',
        'g-recaptcha-response' => 'required'
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
        return back()->withErrors($validator)->withInput();
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

    // Store user id in session
    session([
        'verify_user_id' => $user->id
    ]);

    return redirect()->route('otp.verify.page')
        ->with('success', 'OTP sent to your email.');
}

public function otpVerifyPage()
{
    $user = User::find(session('verify_user_id'));

    if (!$user) {
        return redirect()->route('register')
            ->with('error', 'Session expired.');
    }

    return view('frontend.auth.emails.otp_verify', compact('user'));
}

public function resendOtp(Request $request)
{
    $userId = session('verify_user_id');

    if (!$userId) {
        return redirect()->route('register')
            ->with('error', 'Session expired.');
    }

    $user = User::find($userId);

    if (!$user) {
        return back()->with('error', 'User not found.');
    }

    // generate new OTP
    $otp = (string) random_int(100000, 999999);

    $user->update([
        'otp' => $otp,
        'otp_expires_at' => now()->addMinutes(3), // 3 minutes as you requested
    ]);

    Mail::to($user->email)->send(new OtpMail($otp));

    return back()->with('success', 'OTP resent successfully.');
}

public function otpVerify(Request $request)
{
    $request->validate([
        'otp' => 'required|digits:6',
    ]);

    $userId = session('verify_user_id');

    if (!$userId) {
        return redirect()->route('register')
            ->with('error', 'Session expired. Please register again.');
    }

    $user = User::find($userId);

    if (!$user) {
        return redirect()->route('register')
            ->with('error', 'User not found.');
    }

    // 1. check OTP exists
    if (!$user->otp) {
        return back()->with('error', 'OTP not found. Please resend OTP.');
    }

    // 2. check expiry FIRST
    if (now()->gt($user->otp_expires_at)) {
        return back()->with('error', 'OTP expired. Please resend OTP.');
    }

    // 3. strict compare
    if ((string)$user->otp !== (string)trim($request->otp)) {
        return back()->with('error', 'Invalid OTP');
    }

    // 4. verify user
    $user->update([
        'email_verified_at' => now(),
        'otp' => null,
        'otp_expires_at' => null,
    ]);

    session()->forget('verify_user_id');

    Auth::login($user);

    return redirect()->route('admin.dashboard')
        ->with('success', 'Email verified successfully.');
}
    // =========================
    // ADMIN USER CREATE PAGE
    // =========================
    public function view()
    {
        return view('backend.users.registration');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
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

        return back()->with('success', 'User Created Successfully');
    }

    // =========================
    // USER LIST
    // =========================
    public function list()
    {
        $users = User::where('role', '!=', 'admin')
            ->latest()
            ->get();

        return view('backend.users.userlist', compact('users'));
    }

    // =========================
    // DELETE USER
    // =========================
    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
        }

        return back()->with('success', 'User Deleted Successfully');
    }

    // =========================
    // VENDOR LIST
    // =========================
    public function index()
    {
        $vendors = User::where('role', 'seller')
            ->withCount(['physicalProducts', 'digitalProducts'])
            ->latest()
            ->get();

        return view('backend.vendors.index', compact('vendors'));
    }

    // =========================
    // VENDOR CREATE PAGE
    // =========================
    public function create()
    {
        return view('backend.vendors.create');
    }

    // =========================
    // VENDOR STORE
    // =========================
    public function vendorStore(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'store_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'fname' => $request->first_name,
            'lname' => $request->last_name,
            'store_name' => $request->store_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'seller',
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.vendors.list')
            ->with('success', 'Vendor Created Successfully');
    }

    // =========================
    // VENDOR EDIT
    // =========================
    public function edit($id)
    {
        $vendor = User::findOrFail($id);

        return view('backend.vendors.edit', compact('vendor'));
    }

    // =========================
    // VENDOR UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'store_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $vendor = User::findOrFail($id);

        $vendor->update([
            'fname' => $request->first_name,
            'lname' => $request->last_name,
            'store_name' => $request->store_name,
            'email' => $request->email,
            'role' => 'seller',
        ]);

        return redirect()->route('admin.vendors.list')
            ->with('success', 'Vendor Updated Successfully');
    }

    // =========================
    // VENDOR DELETE
    // =========================
    public function vendorDelete($id)
    {
        $vendor = User::find($id);

        if ($vendor) {
            $vendor->delete();
        }

        return redirect()->route('admin.vendors.list')
            ->with('success', 'Vendor Deleted Successfully');
    }
}
