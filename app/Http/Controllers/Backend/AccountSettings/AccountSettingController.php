<?php

namespace App\Http\Controllers\Backend\AccountSettings;

use App\Http\Controllers\Controller;
use App\Models\AccountSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Laravel\Socialite\Facades\Socialite;

class AccountSettingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SHOW PROFILE PAGE
    |--------------------------------------------------------------------------
    */
    public function settings()
    {
        $user = User::findOrFail(Auth::id());

        $setting = AccountSetting::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'first_name' => $user->fname,
                'last_name' => $user->lname,
                'email' => $user->email,
                'gender' => null,
                'phone' => null,
                'dob' => null,
                'location' => null,
                'image' => null,

                // Notifications
                'allow_notifications' => 0,
                'enable_notifications' => 0,
                'own_activity_notification' => 0,
                'dnd' => 0,

                // Other settings
                'performance' => 0,
                'overtime' => 0,
                'leaves_taken' => 0,
            ]
        );

        return view(
            'backend.settings.profile',
            compact('user', 'setting')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFILE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::findOrFail(Auth::id());

        /*
        |--------------------------------------------------------------------------
        | PROFILE IMAGE
        |--------------------------------------------------------------------------
        */

        $imageName = $user->image;

        if ($request->hasFile('image')) {

            $manager = new ImageManager(new Driver());

            $path = public_path('uploads/profile/');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            // Delete old image
            if (
                $user->image &&
                file_exists($path . $user->image)
            ) {
                unlink($path . $user->image);
            }

            // New image
            $imageName = Auth::id() . '-' . time() . '.png';

            $image = $manager->read($request->file('image'));

            $image->toPng()->save(
                $path . $imageName
            );
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE USER
        |--------------------------------------------------------------------------
        */

        $user->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'image' => $imageName,
        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE ACCOUNT SETTINGS
        |--------------------------------------------------------------------------
        */

        AccountSetting::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'first_name' => $request->fname,
                'last_name' => $request->lname,
                'email' => $request->email,

                'gender' => $request->gender,
                'phone' => $request->phone,
                'dob' => $request->dob,
                'location' => $request->location,

                'facebook' => $request->facebook,
                'google' => $request->google,
                'twitter' => $request->twitter,

                'performance' => $request->performance ?? 0,
                'overtime' => $request->overtime ?? 0,
                'leaves_taken' => $request->leaves_taken ?? 0,
            ]
        );

        return redirect()
            ->route('admin.account.setting')
            ->with('success', 'Profile updated successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT PROFILE PAGE
    |--------------------------------------------------------------------------
    */
    public function edit()
    {
        $user = User::findOrFail(Auth::id());

        $setting = AccountSetting::firstOrCreate(
            ['user_id' => Auth::id()]
        );

        return view(
            'backend.settings.editProfile',
            compact('user', 'setting')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE NOTIFICATION SETTINGS
    |--------------------------------------------------------------------------
    */
    public function updateNotifications(Request $request)
    {
        $setting = AccountSetting::firstOrCreate(
            ['user_id' => Auth::id()]
        );

        $setting->update([
            'allow_notifications' => $request->boolean('allow_notifications'),
            'enable_notifications' => $request->boolean('enable_notifications'),
            'own_activity_notification' => $request->boolean('own_activity_notification'),
            'dnd' => $request->boolean('dnd'),
        ]);

        return back()->with(
            'success',
            'Notification settings updated successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DEACTIVATE ACCOUNT
    |--------------------------------------------------------------------------
    */
    public function deactivate(Request $request)
    {
        $request->validate([
            'deactivation_reason' => 'required|string|max:255',
        ]);

        $setting = AccountSetting::firstOrCreate(
            ['user_id' => Auth::id()]
        );

        $setting->update([
            'deactivation_reason' => $request->deactivation_reason,
        ]);

        $user = Auth::user();

        $user->update([
            'is_deactivated' => true,
        ]);

        Auth::logout();

        return redirect('/')
            ->with('success', 'Your account has been deactivated.');
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE ACCOUNT
    |--------------------------------------------------------------------------
    */
    public function deleteAccount(Request $request)
    {
        $request->validate([
            'deletion_reason' => 'required|string|max:255',
        ]);

        $setting = AccountSetting::firstOrCreate(
            ['user_id' => Auth::id()]
        );

        $setting->update([
            'deletion_reason' => $request->deletion_reason,
        ]);

        $user = Auth::user();

        Auth::logout();

        $user->delete();

        return redirect('/')
            ->with('success', 'Your account has been deleted.');
    }


    /*
    |--------------------------------------------------------------------------
    | CONNECT SOCIAL ACCOUNT
    |--------------------------------------------------------------------------
    */
    public function connectSocial($type)
    {
        $setting = AccountSetting::firstOrCreate(
            ['user_id' => Auth::id()]
        );

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

            default:
                return back()->with(
                    'error',
                    'Invalid social account.'
                );
        }

        $setting->save();

        return back()->with(
            'success',
            ucfirst($type) . ' connected successfully!'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SOCIAL LOGIN REDIRECT
    |--------------------------------------------------------------------------
    */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    /*
    |--------------------------------------------------------------------------
    | SOCIAL LOGIN CALLBACK
    |--------------------------------------------------------------------------
    */
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
            [
                'user_id' => $user->id,
            ],
            [
                $provider => $socialUser->getEmail(),
            ]
        );

        Auth::login($user);

        return redirect()
            ->route('admin.account.setting');
    }
}
