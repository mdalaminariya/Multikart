@extends('layouts.backendmaster.master')

@section('content')
            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Order Details
                                        <small>Multikart Admin panel</small>
                                    </h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Menus</li>
                                    <li class="breadcrumb-item active">Order Details</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="bg-inner cart-section order-details-table">
                        <div class="row g-4">

                            {{-- LEFT SIDE --}}
                            <div class="col-xl-8">

                                <div class="card-details-title">
                                    <h3>
                                        Order Number
                                        <span>#{{ $order->order_number }}</span>
                                    </h3>
                                </div>

                                <div class="table-responsive table-details">

                                    <table class="table cart-table table-borderless">

                                        <thead>
                                            <tr>
                                                <th colspan="2">Items</th>

                                                <th class="text-end" colspan="2">
                                                    <a href="javascript:void(0)"
                                                       class="theme-color">
                                                        Edit Items
                                                    </a>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @forelse($order->items as $item)

                                                <tr class="table-order">

                                                    {{-- Product Image --}}
                                                    <td>
                                                        <a href="javascript:void(0)">

                                                            @if($item->product_type == 'physical')

                                                                <img
                                                                    src="{{ asset('uploads/physical/products/' . optional($item->product)->image) }}"
                                                                    class="img-fluid blur-up lazyload"
                                                                    alt="{{ $item->product_name }}">

                                                            @else

                                                                <img
                                                                    src="{{ asset('uploads/digital/products/' . optional($item->product)->image) }}"
                                                                    class="img-fluid blur-up lazyload"
                                                                    alt="{{ $item->product_name }}">

                                                            @endif

                                                        </a>
                                                    </td>

                                                    {{-- Product Name --}}
                                                    <td>

                                                        <p>Product Name</p>

                                                        <h5>
                                                            {{ $item->product_name }}
                                                        </h5>

                                                    </td>

                                                    {{-- Quantity --}}
                                                    <td>

                                                        <p>Quantity</p>

                                                        <h5>
                                                            {{ $item->quantity }}
                                                        </h5>

                                                    </td>

                                                    {{-- Price --}}
                                                    <td>

                                                        <p>Price</p>

                                                        <h5>
                                                            ${{ number_format($item->price, 2) }}
                                                        </h5>

                                                    </td>

                                                </tr>

                                            @empty

                                                <tr>
                                                    <td colspan="4" class="text-center">
                                                        No items found for this order.
                                                    </td>
                                                </tr>

                                            @endforelse

                                        </tbody>

                                        <tfoot>

                                            {{-- Subtotal --}}
                                            <tr class="table-order">

                                                <td colspan="3">
                                                    <h5>Subtotal :</h5>
                                                </td>

                                                <td>
                                                    <h4>
                                                        ${{ number_format(
                                                            $order->items->sum(function ($item) {
                                                                return $item->price * $item->quantity;
                                                            }),
                                                            2
                                                        ) }}
                                                    </h4>
                                                </td>

                                            </tr>

                                            {{-- Shipping --}}
                                            <tr class="table-order">

                                                <td colspan="3">
                                                    <h5>Shipping :</h5>
                                                </td>

                                                <td>
                                                    <h4>
                                                        ${{ number_format($order->shipping ?? 0, 2) }}
                                                    </h4>
                                                </td>

                                            </tr>

                                            {{-- Tax --}}
                                            <tr class="table-order">

                                                <td colspan="3">
                                                    <h5>Tax(GST) :</h5>
                                                </td>

                                                <td>
                                                    <h4>
                                                        ${{ number_format($order->tax ?? 0, 2) }}
                                                    </h4>
                                                </td>

                                            </tr>

                                            {{-- Total --}}
                                            <tr class="table-order">

                                                <td colspan="3">

                                                    <h4 class="theme-color fw-bold">
                                                        Total Price :
                                                    </h4>

                                                </td>

                                                <td>

                                                    <h4 class="theme-color fw-bold">
                                                        ${{ number_format($order->total, 2) }}
                                                    </h4>

                                                </td>

                                            </tr>

                                        </tfoot>

                                    </table>

                                </div>
                            </div>


                            {{-- RIGHT SIDE --}}
                            <div class="col-xl-4">

                                <div class="row g-4">

                                    {{-- ORDER SUMMARY --}}
                                    <div class="col-12">

                                        <div class="order-success">

                                            <h4>summery</h4>

                                            <ul class="order-details">

                                                <li>
                                                    Order ID:
                                                    {{ $order->id }}
                                                </li>

                                                <li>
                                                    Order Number:
                                                    {{ $order->order_number }}
                                                </li>

                                                <li>
                                                    Order Date:
                                                    {{ $order->created_at->format('F d, Y') }}
                                                </li>

                                                <li>
                                                    Order Total:
                                                    ${{ number_format($order->total, 2) }}
                                                </li>

                                                <li>
                                                    Status:
                                                    <strong>
                                                        {{ ucfirst($order->status) }}
                                                    </strong>
                                                </li>

                                            </ul>

                                        </div>

                                    </div>


                                    {{-- SHIPPING ADDRESS --}}
                                    <div class="col-12">

                                        <div class="order-success">

                                            <h4>shipping address</h4>

                                            <ul class="order-details">

                                                <li>
                                                    {{ $order->name ?? 'N/A' }}
                                                </li>

                                                <li>
                                                    {{ $order->address ?? 'N/A' }}
                                                </li>

                                                <li>
                                                    {{ $order->email ?? 'N/A' }}
                                                </li>

                                                <li>
                                                    Contact No.
                                                    {{ $order->phone ?? 'N/A' }}
                                                </li>

                                            </ul>

                                        </div>

                                    </div>


                                    {{-- PAYMENT METHOD --}}
                                    <div class="col-12">

                                        <div class="order-success">

                                            <div class="payment-mode">

                                                <h4>payment method</h4>

                                                <p>
                                                    {{ $order->payment_method ?? 'Payment method not specified.' }}
                                                </p>

                                            </div>

                                        </div>

                                    </div>


                                    {{-- DELIVERY --}}
                                    <div class="col-12">

                                        <div class="order-success">

                                            <div class="delivery-sec">

                                                <h3>
                                                    expected date of delivery:

                                                    <span>
                                                        @if($order->expected_delivery_date)
                                                            {{ \Carbon\Carbon::parse($order->expected_delivery_date)->format('F d, Y') }}
                                                        @else
                                                            Pending
                                                        @endif
                                                    </span>

                                                </h3>

                                                <a href="{{ route('admin.orders.tracking.list') }}">
                                                    track order
                                                </a>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- section end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

@endsection
