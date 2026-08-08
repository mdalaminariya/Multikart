@extends('layouts.frontendmaster.master')

@section('content')

<div class="breadcrumb-section">
        <div class="container">
            <h2>checkout</h2>
            <nav class="theme-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">checkout</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="section-b-space checkout-section-2">
        <div class="container">
            <div class="checkout-page">
                <div class="checkout-form">
                    <div class="row g-sm-4 g-3">
                        <div class="col-lg-7">
                            <div class="left-sidebar-checkout">
                                <div class="checkout-detail-box">
                                    <ul>
                                        <li>
                                            <div class="checkout-box">

                                                <div class="checkout-title">
                                                    <h4>Shipping Address</h4>

                                                    <button data-bs-toggle="modal"
                                                            data-bs-target="#addAddress"
                                                            class="d-flex align-items-center btn">
                                                        <i class="ri-add-line me-1"></i>
                                                        Add New
                                                    </button>
                                                </div>

                                                <div class="checkout-detail">
                                                    <div class="row g-3">

                                                        @forelse($addresses as $address)

                                                        <div class="col-xxl-6 col-lg-12 col-md-6">

                                                            <div class="delivery-address-box">

                                                                <input
                                                                    class="form-check-input"
                                                                    type="radio"
                                                                    name="address_id"
                                                                    id="address{{ $address->id }}"
                                                                    value="{{ $address->id }}"
                                                                    {{ $loop->first ? 'checked' : '' }}>

                                                                <label class="form-check-label"
                                                                    for="address{{ $address->id }}">

                                                                    <span class="name">
                                                                        {{ $address->address_type }}
                                                                    </span>

                                                                    <span class="address text-content">
                                                                        <span class="text-title">Address :</span>
                                                                        {{ $address->address }}
                                                                    </span>

                                                                    <span class="address text-content">
                                                                        <span class="text-title">Phone :</span>
                                                                        {{ $address->phone }}
                                                                    </span>

                                                                </label>

                                                            </div>

                                                        </div>

                                                        @empty

                                                        <div class="col-12">
                                                            No addresses available.
                                                        </div>

                                                        @endforelse

                                                    </div>
                                                </div>

                                            </div>
                                        </li>

                                        <li>
                                            <div class="checkout-box">
                                                <div class="checkout-title">
                                                    <h4>Billing Address</h4>
                                                    <button data-bs-toggle="modal" data-bs-target="#addAddress" class="d-flex align-items-center btn"><i class="ri-add-line me-1"></i> Add New</button>
                                                </div>

                                                <div class="checkout-detail">
                                                    <div class="row g-3">

                                                        @forelse($addresses as $address)

                                                        <div class="col-xxl-6 col-lg-12 col-md-6">

                                                            <div class="delivery-address-box">

                                                                <input
                                                                    class="form-check-input"
                                                                    type="radio"
                                                                    name="billingAddress_id"
                                                                    id="billingAddress{{ $address->id }}"
                                                                    value="{{ $address->id }}"
                                                                    {{ $loop->first ? 'checked' : '' }}>

                                                                <label class="form-check-label"
                                                                    for="billingAddress{{ $address->id }}">

                                                                    <span class="name">
                                                                        {{ $address->address_type }}
                                                                    </span>

                                                                    <span class="address text-content">
                                                                        <span class="text-title">Address :</span>
                                                                        {{ $address->address }}
                                                                    </span>

                                                                    <span class="address text-content">
                                                                        <span class="text-title">Phone :</span>
                                                                        {{ $address->phone }}
                                                                    </span>

                                                                </label>

                                                            </div>

                                                        </div>

                                                        @empty

                                                        <div class="col-12">
                                                            No addresses available.
                                                        </div>

                                                        @endforelse

                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="checkout-box">
                                                <div class="checkout-title">
                                                    <h4>Delivery Options</h4>
                                                </div>

                                                <div class="checkout-detail">
                                                    <div class="row g-3">
                                                        <div class="col-xxl-6 col-lg-12 col-md-6">
                                                            <div class="delivery-address-box">
                                                                <input class="form-check-input" type="radio" name="checkbox2" id="check7">
                                                                <label class="form-check-label" for="check7">Standard
                                                                    Delivery | Approx 5 to 7 Days</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-xxl-6 col-lg-12 col-md-6">
                                                            <div class="delivery-address-box">
                                                                <input class="form-check-input" type="radio" name="checkbox2" id="check8" checked="">
                                                                <label class="form-check-label" for="check8">Express
                                                                    Delivery | Schedule </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="checkout-box">
                                                <div class="checkout-title">
                                                    <h4>Payment Options</h4>
                                                </div>

                                                <div class="checkout-detail">
                                                    <div class="row g-3">
                                                        <div class="col-sm-6">
                                                            <div class="delivery-address-box">
                                                                <input class="form-check-input" type="radio" name="checkbox3" id="check9">
                                                                <label class="form-check-label" for="check9">CASH ON
                                                                    DELIVERY</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="delivery-address-box">
                                                                <input class="form-check-input" type="radio" name="checkbox3" id="check10" checked="">
                                                                <label class="form-check-label" for="check10">PAYPAL</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="delivery-address-box">
                                                                <input class="form-check-input" type="radio" name="checkbox3" id="check11" checked="">
                                                                <label class="form-check-label" for="check11">STRIPE</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="delivery-address-box">
                                                                <input class="form-check-input" type="radio" name="checkbox3" id="check12" checked="">
                                                                <label class="form-check-label" for="check12">SSLCOMMERZ</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="delivery-address-box">
                                                                <input class="form-check-input" type="radio" name="checkbox3" id="check13" checked="">
                                                                <label class="form-check-label" for="check13">FLUTTERWAVE</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="delivery-address-box">
                                                                <input class="form-check-input" type="radio" name="checkbox3" id="check14" checked="">
                                                                <label class="form-check-label" for="check14">PAYSTACK</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="delivery-address-box">
                                                                <input class="form-check-input" type="radio" name="checkbox3" id="check15" checked="">
                                                                <label class="form-check-label" for="check15">MOLLIE</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="delivery-address-box">
                                                                <input class="form-check-input" type="radio" name="checkbox3" id="check16" checked="">
                                                                <label class="form-check-label" for="check16">BANK
                                                                    TRANSFER</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="delivery-address-box">
                                                                <input class="form-check-input" type="radio" name="checkbox3" id="check17" checked="">
                                                                <label class="form-check-label" for="check17">BKASH</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="delivery-address-box">
                                                                <input class="form-check-input" type="radio" name="checkbox3" id="check18" checked="">
                                                                <label class="form-check-label" for="check18">CCAVENUE</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="delivery-address-box">
                                                                <input class="form-check-input" type="radio" name="checkbox3" id="check19" checked="">
                                                                <label class="form-check-label" for="check19">PHONEPE</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="delivery-address-box">
                                                                <input class="form-check-input" type="radio" name="checkbox3" id="20" checked="">
                                                                <label class="form-check-label" for="20">INSTAMOJO</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="checkout-right-box">
                                <div class="checkout-details">
                                    <div class="order-box">
                                        <div class="title-box">
                                            <h4>Summary Order</h4>
                                            <p>For a better experience, verify your goods and choose your shipping
                                                option.</p>
                                        </div>

                                            <ul class="qty">

                                            @foreach($cartItems as $item)

                                            <li>

                                            <div class="cart-image">

                                            @if($item->product_type=='physical')

                                            <img src="{{ asset('uploads/physical/products/'.$item->product->image) }}"
                                            class="img-fluid">

                                            @else

                                            <img src="{{ asset('uploads/digital/products/'.$item->product->image) }}"
                                            class="img-fluid">

                                            @endif

                                            </div>

                                            <div class="cart-content">

                                            <div>

                                            <h4>{{ $item->product->title }}</h4>

                                            <h5>
                                            ${{ number_format($item->price,2) }}
                                            ×
                                            {{ $item->quantity }}
                                            </h5>

                                            </div>

                                            <span class="text-theme">
                                            ${{ number_format($item->price * $item->quantity,2) }}
                                            </span>

                                            </div>

                                            </li>

                                            @endforeach

                                            </ul>
                                    </div>
                                </div>

                                <div class="checkout-details">
                                    <div class="order-box">
                                        <div class="title-box">
                                            <h4>Billing Summary</h4>
                                            <div class="promo-code-box">
                                                <div class="promo-title">
                                                    <h5>Promo code</h5>
                                                    <button class="btn" data-bs-toggle="modal" data-bs-target="#couponModal"><i class="ri-coupon-line"></i>View
                                                        All</button>
                                                </div>
                                                <div class="row g-sm-3 g-2 mb-3">
                                                    <div class="col-md-6">
                                                        <div class="coupon-box">
                                                            <div class="card-name">
                                                                <h6>Holiday Savings</h6>
                                                            </div>
                                                            <div class="coupon-content">
                                                                <div class="coupon-apply">
                                                                   @forelse ($coupons as $coupon)
                                                                     <h6 class="coupon-code success-color">{{ $coupon->code }}</h6>

                                                                     <a href="javascript:void(0)"
                                                                     class="btn theme-btn border-btn copy-btn mt-0"
                                                                     onclick="copyCoupon('{{ $coupon->code }}')">
                                                                     Copy Code
                                                                    </a>

                                                                    @empty
                                                                      <p>No coupons available.</p>
                                                                     @endforelse
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="coupon-input-box">
                                                    <input type="text" id="coupon" class="form-control" placeholder="Enter Coupon Code Here...">
                                                    <button class="apply-button btn">Apply now</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="custom-box-loader">
                                            <ul class="sub-total">
                                                <li>Sub Total <span class="count">${{ number_format($subTotal,2) }}</span></li>
                                                <li> Shipping <span class="count">${{ number_format($shipping,2) }}</span></li>
                                                <li> Tax <span class="count">${{ number_format($tax,2) }}</span></li>
                                                <li>
                                                    <h4 class="txt-muted">Points</h4>
                                                    <h4 class="price txt-muted">${{ number_format($total,2) }}</h4>
                                                </li>
                                                <li class="border-cls">
                                                    <label for="ponts" class="form-check-label m-0">Would you prefer
                                                        to pay using points?</label>
                                                    <input type="checkbox" id="ponts" class="checkbox_animated check-it">
                                                </li>
                                                <li class="border-cls">
                                                    <label for="wallet" class="form-check-label m-0">Would you
                                                        prefer to pay using wallet?</label>
                                                    <input type="checkbox" id="wallet" class="checkbox_animated check-it">
                                                </li>
                                            </ul>
                                        </div>
                                        <ul class="total">
                                            <li>Total <span class="count">${{ number_format($total,2) }}</span></li>
                                        </ul>
                                        <div class="text-end">

                                            <form action="{{ route('order.store') }}" method="POST">
                                                @csrf

                                                <input
                                                    type="hidden"
                                                    name="address_id"
                                                    id="selected_address_id"
                                                    value="{{ $addresses->first()?->id }}">

                                                <button type="submit" class="btn order-btn">
                                                    Place Order
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add new address modal start -->
            <div class="modal fade theme-modal-2" id="addAddress">
                <div class="modal-dialog modal-dialog-centered">
                    <form action="{{ route('dashboard.address.store') }}" method="POST">
                        @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fw-semibold">Address</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                <i class="ri-close-line"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-sm-4 g-2">
                                <div class="col-12">
                                    <div class="form-box">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" name="address_type" class="form-control" id="title" placeholder="Enter Title">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-box">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-box">
                                        <label for="number" class="form-label">Phone Number</label>
                                        <input type="number" name="phone" class="form-control" id="number"
                                            placeholder="Enter Your Phone Number">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-box">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" name="city" class="form-control" id="city" placeholder="Enter City">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-md btn-outline fw-bold"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-solid">Submit</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <!-- Add new address modal End -->


                                                <!-- Coupon modal start -->
                                                <div class="modal coupon-modal fade theme-modal-2" id="couponModal">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title fw-semibold">Apply Coupon</h3>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                    <i class="ri-close-line"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row g-3">
                                                                @forelse ($discountCoupons as $Coupons)
                                                                        <div class="col-md-6">
                                                                            <div class="coupon-box">
                                                                                <div class="coupon-name">
                                                                                    <div class="card-name">
                                                                                        <div>
                                                                                            <h5 class="fw-semibold dark-text">{{ $Coupons->title }}</h5>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="coupon-content">
                                                                                    <p>Save 40% on holiday gifts and decorations.</p>
                                                                                    <div class="coupon-apply">
                                                                                        <h6 class="coupon-code success-color">#{{ $Coupons->code }}</h6>
                                                                                            <a href="javascript:void(0)"
                                                                                            class="btn theme-btn border-btn copy-btn mt-0"
                                                                                            onclick="copyCoupon('{{ $Coupons->code }}')">
                                                                                            Copy Code
                                                                                            </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                @empty
                                                                        <div class="col-12">
                                                                            No coupons available.
                                                                        </div>
                                                                @endforelse
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Coupon modal End -->
    </section>
    
<script>
    function selectShippingAddress(addressId) {
        document.getElementById('selected_address_id').value = addressId;
    }
</script>
@endsection
