<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Models\WalletTransaction;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Validate selected address
        |--------------------------------------------------------------------------
        */
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Get selected address
        |--------------------------------------------------------------------------
        */
        $address = Address::where('id', $request->address_id)
            ->where('user_id', $user->id)
            ->first();

        if (!$address) {
            return back()->with('error', 'Please select a valid address.');
        }

        /*
        |--------------------------------------------------------------------------
        | Get cart
        |--------------------------------------------------------------------------
        */
        $cartItems = Cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        /*
        |--------------------------------------------------------------------------
        | Calculate total
        |--------------------------------------------------------------------------
        */
        $total = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Create Order
            |--------------------------------------------------------------------------
            */
            $order = Order::create([
                'user_id' => $user->id,

                'order_number' => 'ORD-' . strtoupper(uniqid()),

                // Automatically from logged-in user
                'name' => trim(
                    ($user->fname ?? '') . ' ' . ($user->lname ?? '')
                ),

                'email' => $user->email,

                // Phone from selected address
                'phone' => $address->phone,

                // Address selected at checkout
                'address' => trim(
                    ($address->address ?? '') .
                    (!empty($address->city) ? ', ' . $address->city : '')
                ),

                'total' => $total,

                'status' => 'pending',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Save Order Items
            |--------------------------------------------------------------------------
            */
            foreach ($cartItems as $cart) {

                $product = $cart->product;

                if (!$product) {
                    continue;
                }

                OrderItem::create([
                    'order_id' => $order->id,

                    'product_id' => $cart->product_id,

                    'product_type' => $cart->product_type,

                    'product_name' => $product->title,

                    'price' => $cart->price,

                    'quantity' => $cart->quantity,

                    'total' => $cart->price * $cart->quantity,
                ]);
            }

            // Current Wallet Balance
             $currentBalance = $user->wallet ?? 0;
            //   New Wallet Balance
             $newBalance = $currentBalance - $total;
                             WalletTransaction::create([

                    'user_id' => $user->id,

                    'order_id' => $order->id,

                    'transaction_id' => 'TXN' . strtoupper(
                        Str::random(12)
                    ),

                    'type' => 'debit',

                    'amount' => $total,

                    'balance_after' => $newBalance,

                    'description' =>
                        'Wallet amount successfully debited for Order #' .
                        $order->order_number,
                ]);

                // Update user's wallet balance
                $user->wallet = $newBalance;
                $user->save();

                // Empty Cart

            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect()
                ->route('order.success', $order->id)
                ->with('success', 'Order placed successfully!');

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Order could not be placed: ' . $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('frontend.carts.order-success', compact('order'));
    }
}
