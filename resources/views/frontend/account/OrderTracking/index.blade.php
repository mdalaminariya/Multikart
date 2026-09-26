@extends('layouts.frontendmaster.master')

@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <h2>Order tracking</h2>
        <nav class="theme-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">Order tracking</li>
            </ol>
        </nav>
    </div>
</div>
<!-- breadcrumb End -->

<!-- tracking page start -->
<section class="tracking-page section-b-space">
    <div class="container">

        <div class="title-header mb-3">
            <h5>Order Number: #{{ $order->order_id }}</h5>
        </div>

        <br>

        <!-- Order Products -->
<div class="table-responsive">
    <table class="table tacking-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Full Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Sub Total</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($order->items as $item)

                @php
                    $product = $item->product;
                @endphp

                <tr>
                    <td class="product-image">

                        @if ($product)

                            @if ($item->product_type === 'physical')

                                <img src="{{ asset('uploads/physical/products/' . $product->image) }}"
                                    class="img-fluid"
                                    alt="{{ $item->product_name }}">

                            @else

                                @php
                                    $digitalImage = is_array($product->images)
                                        ? ($product->images[0] ?? null)
                                        : $product->images;
                                @endphp

                                @if ($digitalImage)
                                    <img src="{{ asset('uploads/digital/products/' . $digitalImage) }}"
                                        class="img-fluid"
                                        alt="{{ $item->product_name }}">
                                @endif

                            @endif

                        @endif

                    </td>

                    <td>
                        <h6>{{ $item->product_name }}</h6>
                    </td>

                    <td>
                        <h6>
                            ${{ number_format($item->price, 2) }}
                        </h6>
                    </td>

                    <td>
                        <h6>{{ $item->quantity }}</h6>
                    </td>

                    <td>
                        <h6>
                            ${{ number_format($item->price * $item->quantity, 2) }}
                        </h6>
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>
</div>

        <br>

        <!-- Customer + Summary -->
        <div class="summary-details my-3">
            <div class="row g-4">

                <div class="col-xxl-8 col-lg-12 col-md-7">
                    <div class="details-box">

                        <h3 class="order-title">Consumer Details</h3>

                        <div class="customer-detail tracking-wrapper">
                            <ul class="row g-3">

                                <li class="col-sm-6">
                                    <label>Billing Address:</label>

                                    <h4>
                                        {{ $order->address }}
                                        <br>
                                        Phone : {{ $order->phone }}
                                    </h4>
                                </li>

                                <li class="col-sm-6">
                                    <label>Shipping Address:</label>

                                    <h4>
                                        {{ $order->address }}
                                        <br>
                                        Phone : {{ $order->phone }}
                                    </h4>
                                </li>

                                <li class="col-sm-6">
                                    <label>Delivery Slot:</label>

                                    <h4>
                                        {{ ucfirst($order->delivery_type) }}
                                        @if ($order->delivery_type === 'standard')
                                            | Approx 5 to 7 Days
                                        @endif
                                    </h4>
                                </li>

                                <li class="col-sm-3">
                                    <label>Payment Mode:</label>

                                    <div class="d-flex align-items-center gap-2">
                                        <h4>
                                            {{ strtoupper($order->payment_method) }}
                                        </h4>
                                    </div>
                                </li>

                                <li class="col-sm-3">
                                    <label>Payment Status:</label>

                                    <div class="d-flex align-items-center gap-2">
                                        <h4>
                                            {{ strtoupper($order->payment_status) }}
                                        </h4>
                                    </div>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>

                <!-- Summary -->
                <div class="col-xxl-4 col-lg-12 col-md-5">
                    <div class="details-box">

                        <h3 class="fw-semibold mb-3 order-title">
                            Summary
                        </h3>

                        <ul class="tracking-total tracking-wrapper">

                            <li>
                                Sub Total
                                <span>
                                    ${{ number_format($order->subtotal, 2) }}
                                </span>
                            </li>

                            <li>
                                Shipping
                                <span>
                                    ${{ number_format($order->shipping, 2) }}
                                </span>
                            </li>

                            <li>
                                Tax
                                <span>
                                    ${{ number_format($order->tax, 2) }}
                                </span>
                            </li>

                            @if ($order->discount > 0)
                                <li>
                                    Discount
                                    <span>
                                        -${{ number_format($order->discount, 2) }}
                                    </span>
                                </li>
                            @endif

                            <li>
                                Total
                                <span>
                                    ${{ number_format($order->total, 2) }}
                                </span>
                            </li>

                        </ul>

                    </div>
                </div>

            </div>
        </div>

        <br>

        <!-- Other Orders -->
        <div class="table-responsive">
            <table class="table tacking-table">

                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Order Date</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($orders as $otherOrder)
                        <tr>

                            <td class="product-image">
                                <h6>
                                    #{{ $otherOrder->order_number }}
                                </h6>
                            </td>

                            <td>
                                <h6>
                                    {{ $otherOrder->created_at->format('d M Y h:i A') }}
                                </h6>
                            </td>

                            <td>
                                <h6>
                                    ${{ number_format($otherOrder->total, 2) }}
                                </h6>
                            </td>

                            <td>
                                <h6>
                                    {{ ucfirst($otherOrder->status) }}
                                </h6>
                            </td>

                            <td>
                                <h6>
                                    <a href="{{ route('order.tracking', $otherOrder->id) }}">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                </h6>
                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>

    </div>
</section>
<!-- tracking page end -->
@endsection