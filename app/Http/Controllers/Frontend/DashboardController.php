<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BankDetail;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Address;
use App\Models\WalletTransaction;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $orders = Order::with('orderItems.product')->latest()->get();
        $transactions = WalletTransaction::where('user_id', $user->id)->latest()->get();
        $user = auth()->user()->load('addresses');
        $bankDetail = BankDetail::where('user_id', auth()->id())->first();
        return view('frontend.dashboard.index', compact('user', 'orders', 'transactions', 'bankDetail'));
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

public function saveBankDetails(Request $request)
{
    $request->validate([
        'bank_account_no'   => 'nullable|string|max:255',
        'bank_name'         => 'nullable|string|max:255',
        'bank_holder_name'  => 'nullable|string|max:255',
        'swift'             => 'nullable|string|max:255',
        'ifsc'              => 'nullable|string|max:255',
        'paypal_email'      => 'nullable|email|max:255',
    ]);

    BankDetail::updateOrCreate(
        [
            'user_id' => auth()->id(),
        ],
        [
            'bank_account_no'  => $request->bank_account_no,
            'bank_name'        => $request->bank_name,
            'bank_holder_name' => $request->bank_holder_name,
            'swift'            => $request->swift,
            'ifsc'             => $request->ifsc,
            'paypal_email'     => $request->paypal_email,
        ]
    );

    return back()->with('success','Bank and payment details saved successfully.'
    );
}

}
