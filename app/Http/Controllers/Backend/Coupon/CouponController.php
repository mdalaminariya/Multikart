<?php

namespace App\Http\Controllers\Backend\Coupon;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\physical\category\Category;
use App\Models\Digital\Category\Category as DigitalCategory;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $coupons = Coupon::query();

    if ($request->search) {

        $coupons->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('code', 'like', '%' . $request->search . '%');
    }

    $coupons = $coupons->latest()->get();

    return view('backend.coupons.index', compact('coupons'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        $digitalCategories = DigitalCategory::latest()->get();

        return view('backend.coupons.create', compact('categories', 'digitalCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'code' => 'required|unique:coupons,code',
    ]);

    Coupon::create([
        'title'         => $request->title,
        'code'          => $request->code,
        'start_date'    => $request->start_date,
        'end_date'      => $request->end_date,
        'free_shipping' => $request->has('free_shipping'),
        'quantity'      => $request->quantity,
        'discount_type' => $request->discount_type,
        'discount'      => $request->discount,
        'status'        => $request->status,

        // Restriction
        'products'      => $request->products,

        // Categories
        'category_id'   => $request->category_id,
        'category_type' => $request->category_type,

        'min_spend'     => $request->min_spend,
        'max_spend'     => $request->max_spend,

        // Usage
        'per_limit'     => $request->per_limit,
        'per_customer'  => $request->per_customer,
    ]);

    return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully');
}

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $coupon = Coupon::findOrFail($id);

        $coupon->delete();

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted successfully');
    }


}
