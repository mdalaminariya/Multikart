<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UserAuthenticationController extends Controller
{
    public function login()
    {
        return view('frontend.auth.login');
    }

public function loginSubmit(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    //  Email not found
    if (!$user) {
        return back()->withErrors([
            'email' => 'No account found with this email address.',
        ])->withInput();
    }

    // Wrong password
    if (!\Hash::check($request->password, $user->password)) {
        return back()->withErrors([
            'password' => 'Incorrect password.',
        ])->withInput();
    }


    Auth::login($user);
    $request->session()->regenerate();

    //  Email not verified
    if (!$user->hasVerifiedEmail()) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('error', 'Please verify your email before logging in.');
    }

    return redirect()->route('admin.dashboard')
        ->with('success', 'Login successful!');
}

    // Email verification handler
public function verify($id, $hash)
{
    $user = User::findOrFail($id);

    // minimal required check (must exist)
    if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        abort(403);
    }

    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

    Auth::login($user);

    return redirect()->route('admin.dashboard')->with('success', 'Email verified!');
}

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Logout successful!');
    }

    public function register()
    {
        return view('frontend.auth.register');
    }

    public function registerSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required',
            'g-recaptcha-response' => ['required']
        ]);

        $validator->after(function ($validator) use ($request) {

            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => '6LfeKc8sAAAAAEcG6sXcaYJLjZptjvirmtpsQhWT',
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]);

            if (!data_get($response->json(), 'success')) {
                $validator->errors()->add('g-recaptcha-response', 'Captcha verification failed.');
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->sendEmailVerificationNotification();

        return redirect()->route('login')
            ->with('success', 'Registration successful! Please verify your email.');
    }
}
