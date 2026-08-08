@extends('layouts.backendmaster.master')

@section('content')
<div class="page-body">
<div class="container-fluid">

    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Order Tracking
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
                                    <li class="breadcrumb-item active">Order Tracking</li>
                                </ol>
                            </div>
                        </div>
                    </div>

    <div class="row">

        <div class="col-sm-12">

            <div class="card">

                <div class="card-body">

                    {{-- No Order --}}
                    @if(!$order)

                        <div class="text-center py-5">

                            <h4>No orders found.</h4>

                            <p class="text-muted">
                                There are currently no orders available for tracking.
                            </p>

                            <a href="{{ route('admin.orders.list') }}"
                               class="btn btn-primary">
                                Back to Orders
                            </a>

                        </div>

                    @else

                        <div class="row">

                            {{-- =====================================================
                                ORDER HEADER
                            ====================================================== --}}

                            <div class="col-12 overflow-hidden">

                                <div class="order-left-image">

                                    <div class="tracking-product-image">

                                        @php
                                            $firstItem = $order->items->first();

                                            $product = null;

                                            if ($firstItem) {

                                                if (
                                                    isset($firstItem->product_type) &&
                                                    $firstItem->product_type === 'digital'
                                                ) {
                                                    $product = \App\Models\Digital\Product\Product::find(
                                                        $firstItem->product_id
                                                    );
                                                } else {
                                                    $product = \App\Models\Physical\Product\Product::find(
                                                        $firstItem->product_id
                                                    );
                                                }
                                            }
                                        @endphp


                                        @if($product)

                                            @if(
                                                isset($firstItem->product_type) &&
                                                $firstItem->product_type === 'digital'
                                            )

                                                @if(!empty($product->images))

                                                    <img
                                                        src="{{ asset('uploads/digital/products/' . $product->images) }}"
                                                        class="img-fluid w-100 blur-up lazyload"
                                                        alt="{{ $product->title }}">

                                                @else

                                                    <img
                                                        src="{{ asset('assets/images/fashion/1.jpg') }}"
                                                        class="img-fluid w-100 blur-up lazyload"
                                                        alt="{{ $product->title }}">

                                                @endif

                                            @else

                                                @if(!empty($product->image))

                                                    <img
                                                        src="{{ asset('uploads/physical/products/' . $product->image) }}"
                                                        class="img-fluid w-100 blur-up lazyload"
                                                        alt="{{ $product->title }}">

                                                @else

                                                    <img
                                                        src="{{ asset('assets/images/fashion/1.jpg') }}"
                                                        class="img-fluid w-100 blur-up lazyload"
                                                        alt="{{ $product->title }}">

                                                @endif

                                            @endif

                                        @else

                                            <img
                                                src="{{ asset('assets/images/fashion/1.jpg') }}"
                                                class="img-fluid w-100 blur-up lazyload"
                                                alt="Product">

                                        @endif

                                    </div>


                                    <div class="order-image-contain">

                                        <h4>

                                            @if($product)
                                                {{ $product->title }}
                                            @else
                                                Order #{{ $order->id }}
                                            @endif

                                        </h4>


                                        <div class="tracker-number">

                                            <p>
                                                Order Number :

                                                <span>
                                                    #{{ $order->id }}
                                                </span>
                                            </p>


                                            <p>
                                                Order Status :

                                                <span class="text-capitalize">
                                                    {{ $order->status }}
                                                </span>
                                            </p>


                                            <p>
                                                Order Placed :

                                                <span>
                                                    {{ $order->created_at->format('F d, Y') }}
                                                </span>

                                            </p>

                                        </div>


                                        @if($order->status === 'pending')

                                            <h5>
                                                Your order has been placed and is waiting
                                                for approval.
                                            </h5>

                                        @elseif($order->status === 'approved')

                                            <h5>
                                                Your order has been approved and is being
                                                prepared.
                                            </h5>

                                        @elseif($order->status === 'delivered')

                                            <h5>
                                                Your order has been delivered successfully.
                                            </h5>

                                        @elseif($order->status === 'refund')

                                            <h5>
                                                Your order is currently under refund processing.
                                            </h5>

                                        @else

                                            <h5>
                                                Your order status is currently
                                                {{ ucfirst($order->status) }}.
                                            </h5>

                                        @endif

                                    </div>

                                </div>

                            </div>


                            {{-- =====================================================
                                ORDER PROGRESS
                            ====================================================== --}}

                            @php

                                $status = strtolower($order->status);

                                /*
                                |--------------------------------------------------
                                | Progress according to order status
                                |--------------------------------------------------
                                */

                                $pendingDone = true;

                                $approvedDone = in_array(
                                    $status,
                                    ['approved', 'delivered']
                                );

                                $shippedDone = $status === 'delivered';

                                $deliveredDone = $status === 'delivered';

                            @endphp


                            <ol class="progtrckr">


                                {{-- Pending --}}

                                <li class="{{ $pendingDone ? 'progtrckr-done' : 'progtrckr-todo' }}">

                                    <h5>
                                        Order Processing
                                    </h5>

                                    <h6>

                                        @if($order->created_at)
                                            {{ $order->created_at->format('h:i A') }}
                                        @else
                                            Pending
                                        @endif

                                    </h6>

                                </li>


                                {{-- Approved --}}

                                <li class="{{ $approvedDone ? 'progtrckr-done' : 'progtrckr-todo' }}">

                                    <h5>
                                        Approved
                                    </h5>

                                    <h6>

                                        @if($approvedDone)
                                            Approved
                                        @else
                                            Pending
                                        @endif

                                    </h6>

                                </li>


                                {{-- Shipped --}}

                                <li class="{{ $shippedDone ? 'progtrckr-done' : 'progtrckr-todo' }}">

                                    <h5>
                                        Shipped
                                    </h5>

                                    <h6>

                                        @if($shippedDone)
                                            Completed
                                        @else
                                            Pending
                                        @endif

                                    </h6>

                                </li>


                                {{-- Delivered --}}

                                <li class="{{ $deliveredDone ? 'progtrckr-done' : 'progtrckr-todo' }}">

                                    <h5>
                                        Delivered
                                    </h5>

                                    <h6>

                                        @if($deliveredDone)
                                            Delivered
                                        @else
                                            Pending
                                        @endif

                                    </h6>

                                </li>


                            </ol>


                            {{-- =====================================================
                                REFUND STATUS
                            ====================================================== --}}

                            @if($status === 'refund')

                                <div class="col-12 mt-3">

                                    <div class="alert alert-warning">

                                        <strong>Refund Status:</strong>

                                        This order is currently being processed
                                        for a refund.

                                    </div>

                                </div>

                            @endif


                            {{-- =====================================================
                                ORDER ITEMS TABLE
                            ====================================================== --}}

                            <div class="col-12 overflow-visible">

                                <div class="tracker-table all-package">

                                    <div class="table-responsive">

                                        <table class="table">

                                            <thead>

                                                <tr class="table-head">

                                                    <th scope="col">
                                                        Date
                                                    </th>

                                                    <th scope="col">
                                                        Time
                                                    </th>

                                                    <th scope="col">
                                                        Description
                                                    </th>

                                                    <th scope="col">
                                                        Location
                                                    </th>

                                                </tr>

                                            </thead>


                                            <tbody>


                                                {{-- Order Placed --}}

                                                <tr>

                                                    <td>

                                                        <h6>
                                                            {{ $order->created_at->format('d/m/Y') }}
                                                        </h6>

                                                    </td>

                                                    <td>

                                                        <h6>
                                                            {{ $order->created_at->format('h:i A') }}
                                                        </h6>

                                                    </td>

                                                    <td>

                                                    <p class="fw-bold">
                                                        {{ ucfirst($order->status) }}
                                                    </p>

                                                    </td>

                                                    <td>

                                                        <h6>
                                                           {{ $order->address ?? 'N/A' }}
                                                        </h6>

                                                    </td>

                                                </tr>


                                                {{-- Approved --}}

                                                @if(in_array($status, ['approved', 'delivered']))

                                                    <tr>

                                                        <td>

                                                            <h6>
                                                                {{ $order->updated_at->format('d/m/Y') }}
                                                            </h6>

                                                        </td>

                                                        <td>

                                                            <h6>
                                                                {{ $order->updated_at->format('h:i A') }}
                                                            </h6>

                                                        </td>

                                                        <td>

                                                            <p class="fw-bold">
                                                                Order Approved
                                                            </p>

                                                        </td>

                                                        <td>

                                                            <h6>
                                                                Processing Center
                                                            </h6>

                                                        </td>

                                                    </tr>

                                                @endif


                                                {{-- Delivered --}}

                                                @if($status === 'delivered')

                                                    <tr>

                                                        <td>

                                                            <h6>
                                                                {{ $order->updated_at->format('d/m/Y') }}
                                                            </h6>

                                                        </td>

                                                        <td>

                                                            <h6>
                                                                {{ $order->updated_at->format('h:i A') }}
                                                            </h6>

                                                        </td>

                                                        <td>

                                                            <p class="fw-bold">
                                                                Order Delivered
                                                            </p>

                                                        </td>

                                                        <td>

                                                            <h6>
                                                                Customer Address
                                                            </h6>

                                                        </td>

                                                    </tr>

                                                @endif


                                                {{-- Refund --}}

                                                @if($status === 'refund')

                                                    <tr>

                                                        <td>

                                                            <h6>
                                                                {{ $order->updated_at->format('d/m/Y') }}
                                                            </h6>

                                                        </td>

                                                        <td>

                                                            <h6>
                                                                {{ $order->updated_at->format('h:i A') }}
                                                            </h6>

                                                        </td>

                                                        <td>

                                                            <p class="fw-bold">
                                                                Refund Requested
                                                            </p>

                                                        </td>

                                                        <td>

                                                            <h6>
                                                                Refund Department
                                                            </h6>

                                                        </td>

                                                    </tr>

                                                @endif


                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>
</div>

@endsection
