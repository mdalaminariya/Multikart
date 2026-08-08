<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load('addresses');
        return view('frontend.dashboard.index', compact('user'));
    }

public function update(Request $request)
{
    $request->validate([
        'address_type' => 'nullable|string|max:255',
        'fname' => 'required|string|max:255',
        'lname' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:20',
    ]);

    $user = auth()->user();

    $user->update([
        'address_type' => $request->address_type,
        'fname' => $request->fname,
        'lname' => $request->lname,
        'email' => $request->email,
        'phone' => $request->phone,
    ]);

    return back()->with('success', 'Profile updated successfully.');
}

public function store_address(Request $request)
{
    $request->validate([
        'address_type' => 'nullable|string|max:255',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'city' => 'required|string|max:255',
    ]);

    $user = auth()->user();

    Address::create([
        'user_id' => $user->id,
        'address_type' => $request->address_type,
        'address' => $request->address,
        'phone' => $request->phone,
        'city' => $request->city,
    ]);

    return back()->with('success', 'Address added successfully.');
}

public function update_password(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|string|confirmed',
    ]);

    $user = auth()->user();

    if (!\Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    $user->update([
        'password' => \Hash::make($request->new_password),
    ]);

    return back()->with('success', 'Password updated successfully.');
}

public function update_address(Request $request)
{
    $request->validate([
        'address_type' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'city' => 'required|string|max:255',
    ]);

    $address = Address::where('user_id', auth()->id())->first();

    $address->update([
        'address_type' => $request->address_type,
        'address' => $request->address,
        'phone' => $request->phone,
        'city' => $request->city,
    ]);

    return back()->with('success', 'Address updated successfully.');
}
public function delete_address($id)
{
    $address = Address::where('user_id', auth()->id())->where('id', $id)->firstOrFail();
    $address->delete();

    return back()->with('success', 'Address deleted successfully.');
}

}
