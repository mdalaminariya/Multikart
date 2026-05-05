<?php

namespace App\Http\Controllers\Backend\AccountSettings;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AccountSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Laravel\Socialite\Facades\Socialite;

class AccountSettingController extends Controller
{
    // SHOW PROFILE PAGE
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        $setting = AccountSetting::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'first_name' => $user->fname ?? null,
                'last_name'  => $user->lname ?? null,
                'email'      => $user->email ?? null,

                'gender'   => null,
                'phone'    => null,
                'dob'      => null,
                'location' => null,
                'image'    => null,

                'allow_notifications' => 0,
                'enable_notifications' => 0,
                'own_activity_notification' => 0,
                'dnd' => 0,

                'facebook' => null,
                'google'   => null,
                'twitter'  => null,

                'performance'   => 0,
                'overtime'      => 0,
                'leaves_taken'  => 0,
            ]
        );

        return view('backend.settings.profile', compact('user', 'setting'));
    }

    // UPDATE PROFILE
    public function update(Request $request)
    {
        // ✅ VALIDATION
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $manager = new ImageManager(new Driver());
        $user = User::findOrFail(Auth::id());

        $imageName = $user->image;

        // ✅ IMAGE UPLOAD FIXED
        if ($request->hasFile('image')) {

            $path = public_path('uploads/profile/');

            // create folder if not exists
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            // delete old image
            if ($user->image && file_exists($path . $user->image)) {
                unlink($path . $user->image);
            }

            // always use PNG (safe)
            $imageName = Auth::id() . '-' . time() . '.png';

            $image = $manager->read($request->file('image'));
            $image->toPng()->save($path . $imageName);
        }

        // ✅ UPDATE USER (IMAGE SAVED HERE)
        $user->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'image' => $imageName,
        ]);

        // ✅ UPDATE SETTINGS
        AccountSetting::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'gender'   => $request->gender,
                'phone'    => $request->phone,
                'dob'      => $request->dob,
                'location' => $request->location,

                'allow_notifications' => $request->has('allow_notifications'),
                'enable_notifications' => $request->has('enable_notifications'),
                'own_activity_notification' => $request->has('own_activity_notification'),
                'dnd' => $request->has('dnd'),

                'facebook' => $request->facebook,
                'google'   => $request->google,
                'twitter'  => $request->twitter,

                'performance'  => $request->performance ?? 0,
                'overtime'     => $request->overtime ?? 0,
                'leaves_taken' => $request->leaves_taken ?? 0,
            ]
        );

        return redirect()->route('admin.account.setting')
            ->with('success', 'Profile updated successfully');
    }

    // EDIT PAGE
    public function edit()
    {
        $user = User::findOrFail(Auth::id());

        $setting = AccountSetting::firstOrCreate(
            ['user_id' => Auth::id()]
        );

        return view('backend.settings.editProfile', compact('user', 'setting'));
    }

    // social
    public function connectSocial($type)
{
    $setting = AccountSetting::firstOrCreate(
        ['user_id' => Auth::id()]
    );

    // You can later replace these with real OAuth login links
    switch ($type) {

        case 'facebook':
            $setting->facebook = 'https://facebook.com/your-profile';
            break;

        case 'google':
            $setting->google = 'https://google.com/your-profile';
            break;

        case 'twitter':
            $setting->twitter = 'https://twitter.com/your-profile';
            break;
    }

    $setting->save();

    return back()->with('success', ucfirst($type).' connected successfully!');
}

public function redirectToProvider($provider)
{
    return Socialite::driver($provider)->redirect();
}

public function handleProviderCallback($provider)
{
    $socialUser = Socialite::driver($provider)->user();

    $user = User::updateOrCreate(
        [
            'email' => $socialUser->getEmail(),
        ],
        [
            'fname' => $socialUser->getName() ?? 'User',
            'lname' => '',
            'image' => $socialUser->getAvatar(),
        ]
    );

    AccountSetting::updateOrCreate(
        ['user_id' => $user->id],
        [
            $provider => $socialUser->getEmail(), // or store ID
        ]
    );

    Auth::login($user);

    return redirect()->route('admin.account.setting');
}
}
