<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')->latest()->get();
        return view('backend.orders.list', compact('orders'));
    }

public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:pending,processing,completed,cancelled',
    ]);

    $order->status = $request->input('status');
    $order->save();

    return redirect()->route('admin.orders.list')->with('success', 'Order status updated successfully.');
}

    public function delete(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.list')->with('success', 'Order deleted successfully.');
    }

    // order tracking
    public function tracking()
    {
        $order = Order::with('items')
            ->latest()
            ->first();

        return view('backend.orders.tracking', compact('order'));
    }

    public function trackingOrder(Order $order)
    {
        $order->load('items');

        return view('backend.orders.tracking', compact('order'));
    }

public function details(Order $order)
{
    $order->load('items');

    return view('backend.orders.details', compact('order'));
}
public function latestDetails()
{
    $order = Order::with('items')->latest()->first();

    if (!$order) {
        return redirect()
            ->route('admin.orders.list')
            ->with('error', 'No orders found.');
    }

    return view('backend.orders.details', compact('order'));
}
}
