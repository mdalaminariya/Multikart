@extends('layouts.frontendmaster.master')

@section('content')
        <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <h2>Vendor dashboard</h2>
            <nav class="theme-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Vendor dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--  dashboard section start -->
    <section class="dashboard-section section-b-space user-dashboard-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="dashboard-sidebar">
                        <div class="profile-top">
                            <div class="profile-image vendor-image">
                            @if (auth()->user()->image == 'default.png')
                            <img src="{{ asset('uploads/profile/default/default.png') }}" class="img-fluid img-90 blur-up lazyloaded">
                            @else
                            <img src="{{ asset('uploads/profile/'. auth()->user()->image) }}" class="img-fluid img-90 blur-up lazyloaded">
                            @endif
                            </div>
                            <div class="profile-detail">

                                    <h5>{{ $vendor->store_name }}</h5>
                                    <h6>750 followers | 10 review</h6>
                                    <h6>{{ $user->email }}</h6>
                            </div>
                        </div>
                        <div class="faq-tab">
                            <ul class="nav nav-tabs" id="top-tab" role="tablist">
                                <li class="nav-item">
                                    <a data-bs-toggle="tab" class="nav-link active" href="#dashboard"><i
                                            class="ri-home-line"></i> dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a data-bs-toggle="tab" class="nav-link" href="#products"><i
                                            class="ri-product-hunt-line"></i> products</a>
                                </li>
                                <li class="nav-item">
                                    <a data-bs-toggle="tab" class="nav-link" href="#orders"><i
                                            class="ri-file-text-line"></i> orders</a>
                                </li>
                                <li class="nav-item">
                                    <a data-bs-toggle="tab" class="nav-link" href="#profile"><i
                                            class="ri-user-3-line"></i> profile</a>
                                </li>
                                <li class="nav-item">
                                    <a data-bs-toggle="tab" class="nav-link" href="#settings"><i
                                            class="ri-settings-line"></i> settings</a>
                                </li>
                                <li class="nav-item logout-cls">
                                    <a href="{{ route('home') }}" class="btn loagout-btn">
                                        <i class="ri-logout-box-r-line"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="faq-content tab-content" id="top-tabContent">
                        <div class="tab-pane fade show active" id="dashboard">
                            <div class="counter-section">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="counter-box">
                                        <img src="{{ asset('frontend') }}/assets/images/icon/dashboard/order.png" alt=""
                                            class="img-fluid">
                                        <div>
                                            <h3>{{ $totalProducts }}</h3>
                                            <h5>total products</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="counter-box">
                                        <img src="{{ asset('frontend') }}/assets/images/icon/dashboard/sale.png" alt=""
                                            class="img-fluid">
                                        <div>
                                            <h3>{{ number_format($totalSales, 2) }}</h3>
                                            <h5>total sales</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="counter-box">
                                        <img src="{{ asset('frontend') }}/assets/images/icon/dashboard/homework.png" alt=""
                                            class="img-fluid">
                                        <div>
                                            <h3>{{ $pendingOrders }}</h3>
                                            <h5>order pending</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="chart-order"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-sm-4 g-3">
                                <div class="col-12">
                                    <div class="dashboard-table">
                                        <div class="wallet-table">
                                            <div class="top-sec mb-3">
                                                <h3>trending products</h3>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table cart-table order-table">
                                                    <thead>
                                                        <tr>
                                                            <th>image</th>
                                                            <th>product name</th>
                                                            <th>price</th>
                                                            <th>sales</th>
                                                        </tr>
                                                    </thead>
                                                        <tbody>
                                                            @forelse($trendingProducts as $trend)

                                                                @php
                                                                    $product = $trend['product'];

                                                                    if ($trend['product_type'] === 'physical') {

                                                                        $image = $product && $product->image
                                                                            ? asset('uploads/physical/products/' . $product->image)
                                                                            : asset('assets/images/fashion-1/product/5.jpg');

                                                                    } else {

                                                                        $images = $product
                                                                            ? json_decode($product->images, true)
                                                                            : [];

                                                                        $image = is_array($images) && count($images) > 0
                                                                            ? asset('uploads/digital/products/' . $images[0])
                                                                            : asset('assets/images/fashion-1/product/5.jpg');
                                                                    }
                                                                @endphp

                                                                <tr>
                                                                    <td class="image-box">
                                                                        <img src="{{ $image }}"
                                                                            alt="{{ $product->title ?? 'Product' }}"
                                                                            class="blur-up lazyloaded">
                                                                    </td>

                                                                    <td>
                                                                        {{ $product->title ?? 'Product' }}
                                                                    </td>

                                                                    <td>
                                                                        ${{ number_format($trend['price'], 2) }}
                                                                    </td>

                                                                    <td>
                                                                        {{ $trend['sales'] }}
                                                                    </td>
                                                                </tr>

                                                            @empty

                                                                <tr>
                                                                    <td colspan="4" class="text-center">
                                                                        No sales yet
                                                                    </td>
                                                                </tr>

                                                            @endforelse
                                                        </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<div class="col-12">
    <div class="dashboard-table">
        <div class="wallet-table">

            <div class="top-sec mb-3">
                <h3>recent orders</h3>
            </div>

            <div class="table-responsive">

                <table class="table cart-table order-table">

                    <thead>
                        <tr>
                            <th>order id</th>
                            <th>product details</th>
                            <th>status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($orders->take(5) as $item)

                            @php
                                $product = $item->product;

                                $status = strtolower(
                                    $item->order->status ?? 'pending'
                                );

                                if (
                                    $status === 'cancelled' ||
                                    $status === 'canceled'
                                ) {
                                    $badgeClass = 'bg-debit';
                                } elseif (
                                    $status === 'shipped' ||
                                    $status === 'delivered' ||
                                    $status === 'completed'
                                ) {
                                    $badgeClass = 'bg-credit';
                                } else {
                                    $badgeClass = 'bg-pending';
                                }
                            @endphp

                            <tr>

                                <td>
                                    #{{ $item->order_id }}
                                </td>

                                <td>
                                    {{ $product->title ?? 'Product unavailable' }}
                                </td>

                                <td>
                                    <span class="badge {{ $badgeClass }} custom-badge rounded-0">
                                        {{ $status }}
                                    </span>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="text-center">
                                    No orders yet
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="products">
                            <div class="dashboard-table">
                                <div class="wallet-table">
                                    <div class="top-sec">
                                        <h3>all products</h3>
                                        <a href="{{ route('admin.digital.product.index') }}" class="btn btn-sm btn-solid">+ add new</a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table cart-table order-table">
                                            <thead>
                                                <tr>
                                                    <th>image</th>
                                                    <th>product name</th>
                                                    <th>category</th>
                                                    <th>price</th>
                                                    <th>stock</th>
                                                    <th>sales</th>
                                                    <th>edit/delete</th>
                                                </tr>
                                            </thead>
                                                <tbody>

                                                @if($products->count() > 0)

                                                @foreach($products as $product)

                                                    <tr>

                                                        {{-- Image --}}
                                                        <td class="image-box">
                                                            <img src="{{ $product->display_image }}"
                                                                alt="{{ $product->title }}"
                                                                class="blur-up lazyloaded">
                                                        </td>

                                                        {{-- Product Name --}}
                                                        <td>
                                                            {{ $product->title }}
                                                        </td>

                                                        {{-- Category --}}
                                                        <td>
                                                            {{ $product->subcategory->name ?? 'Uncategorized' }}
                                                        </td>

                                                        {{-- Price --}}
                                                        <td class="fw-bold text-theme">
                                                            ${{ number_format($product->display_price, 2) }}
                                                        </td>

                                                        {{-- Stock --}}
                                                        <td>
                                                            {{ $product->display_stock }}
                                                        </td>

                                                        {{-- Sales --}}
                                                        <td>
                                                            {{ $product->display_sales }}
                                                        </td>

                                                        {{-- Edit / Delete --}}
                                                        <td>

                                                            {{-- Edit --}}
                                                            <a href="{{ $product->product_type === 'physical'
                                                                ? route('admin.product.edit', $product->id)
                                                                : route('admin.digital.product.edit', $product->id) }}">

                                                                <i class="fa fa-pencil-square-o me-1"></i>
                                                            </a>

                                                            {{-- Delete --}}
                                                            <a href="{{ $product->product_type === 'physical'
                                                                ? route('admin.product.delete', $product->id)
                                                                : route('admin.digital.product.delete', $product->id) }}"
                                                            onclick="return confirm('Are you sure you want to delete this product?')">

                                                                <i class="fa fa-trash-o ms-1 text-theme"></i>
                                                            </a>

                                                        </td>

                                                    </tr>

                                                @endforeach

                                                @else
                                                <tr>
                                                    <td colspan="7" class="text-center">
                                                        No products found.
                                                    </td>
                                                </tr>

                                                @endif

                                                </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="orders">
                            <div class="dashboard-table">
                                <div class="wallet-table">
                                    <div class="top-sec">
                                        <h3>orders</h3>
                                        <a href="#!" class="btn btn-sm btn-solid">add product</a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table cart-table order-table">
                                            <thead>
                                                <tr>
                                                    <th>order id</th>
                                                    <th>product details</th>
                                                    <th>status</th>
                                                    <th>price</th>
                                                </tr>
                                            </thead>
                                                <tbody>

                                                    @forelse($orders as $item)

                                                        <tr>

                                                            {{-- ORDER ID --}}
                                                            <td>
                                                                #{{ $item->order->order_number ?? $item->order_id }}
                                                            </td>

                                                            {{-- PRODUCT DETAILS --}}
                                                            <td>
                                                                @if($item->product_type === 'physical')

                                                                    @php
                                                                        $product = \App\Models\Physical\Product\Product::find($item->product_id);
                                                                    @endphp

                                                                    {{ $product->title ?? 'Product' }}

                                                                @elseif($item->product_type === 'digital')

                                                                    @php
                                                                        $product = \App\Models\Digital\Product\Product::find($item->product_id);
                                                                    @endphp

                                                                    {{ $product->title ?? 'Product' }}

                                                                @else

                                                                    Product

                                                                @endif
                                                            </td>

                                                            {{-- STATUS --}}
                                                            <td>

                                                                @php
                                                                    $status = strtolower($item->order->status ?? 'pending');
                                                                @endphp

                                                                @if($status === 'shipped')

                                                                    <span class="badge bg-credit custom-badge rounded-0">
                                                                        shipped
                                                                    </span>

                                                                @elseif($status === 'pending')

                                                                    <span class="badge bg-pending custom-badge rounded-0">
                                                                        pending
                                                                    </span>

                                                                @elseif($status === 'cancelled' || $status === 'canceled')

                                                                    <span class="badge bg-debit custom-badge rounded-0">
                                                                        cancelled
                                                                    </span>

                                                                @elseif($status === 'delivered')

                                                                    <span class="badge bg-credit custom-badge rounded-0">
                                                                        delivered
                                                                    </span>

                                                                @else

                                                                    <span class="badge bg-pending custom-badge rounded-0">
                                                                        {{ $status }}
                                                                    </span>

                                                                @endif

                                                            </td>

                                                            {{-- PRICE --}}
                                                            <td>
                                                                ${{ number_format($item->price * $item->quantity, 2) }}
                                                            </td>

                                                        </tr>

                                                    @empty

                                                        <tr>
                                                            <td colspan="4" class="text-center">
                                                                No orders found.
                                                            </td>
                                                        </tr>

                                                    @endforelse

                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile">
                            <div class="dashboard-box">
                                <div class="dashboard-title">
                                    <h4>profile</h4>
                                    <span data-toggle="modal"
                                        data-bs-toggle="modal"
                                        data-bs-target="#edit-profile">
                                        edit
                                    </span>
                                </div>

                            <div class="dashboard-detail">
                                <ul>
                                    <li class="details">
                                        <h5>
                                            <span>company name</span>
                                            {{ $vendor->store_name ?? 'Not provided' }}
                                        </h5>
                                    </li>

                                    <li class="details">
                                        <h5>
                                            <span>email address</span>
                                            {{ $vendor->user->email }}
                                        </h5>
                                    </li>
                                    <li class="details">
                                        <h5>
                                            <span>phone number</span>
                                            {{ $vendor->phone ?? 'Not provided' }}
                                        </h5>
                                    </li>

                                    <li class="details">
                                        <h5>
                                            <span>Country / Region</span>
                                            {{ $vendor->country ?? 'Not provided' }}
                                        </h5>
                                    </li>

                                    <li class="details">
                                        <h5>
                                            <span>Year Established</span>
                                            {{ $vendor->year_established ?? 'Not provided' }}
                                        </h5>
                                    </li>

                                    <li class="details">
                                        <h5>
                                            <span>Total Employees</span>
                                            {{ $vendor->total_employees ?? 'Not provided' }}
                                        </h5>
                                    </li>

                                    <li class="details">
                                        <h5>
                                            <span>category</span>
                                            {{ $vendor->category ?? 'Not provided' }}
                                        </h5>
                                    </li>

                                    <li class="details">
                                        <h5>
                                            <span>street address</span>
                                            {{ $vendor->address ?? 'Not provided' }}
                                        </h5>
                                    </li>

                                    <li class="details">
                                        <h5>
                                            <span>city/state</span>
                                            {{ $vendor->city ?? 'Not provided' }}
                                        </h5>
                                    </li>

                                    <li class="details">
                                        <h5>
                                            <span>zip</span>
                                            {{ $vendor->zip ?? 'Not provided' }}
                                        </h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        </div>
                        {{-- Update vendor profile --}}
                        <div class="modal fade" id="edit-profile" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProfileLabel">
                                        Edit Profile
                                    </h5>

                                    <button type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close">
                                    </button>
                                </div>

                                    <form action="{{ route('vendor.profile.update') }}" method="POST">
                                        @csrf

                                        <div class="modal-body">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Company Name</label>
                                                        <input type="text"
                                                            name="store_name"
                                                            class="form-control"
                                                            value="{{ old('store_name', $vendor->store_name) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Country / Region</label>
                                                        <input type="text"
                                                            name="country"
                                                            class="form-control"
                                                            value="{{ old('country', $vendor->country) }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Phone Number</label>
                                                        <input type="text"
                                                            name="phone"
                                                            class="form-control"
                                                            value="{{ old('phone', $vendor->phone) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Year Established</label>
                                                        <input type="text"
                                                            name="year_established"
                                                            class="form-control"
                                                            value="{{ old('year_established', $vendor->year_established) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Total Employees</label>
                                                        <input type="number"
                                                            name="total_employees"
                                                            class="form-control"
                                                            value="{{ old('total_employees', $vendor->total_employees) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Category</label>
                                                        <input type="text"
                                                            name="category"
                                                            class="form-control"
                                                            value="{{ old('category', $vendor->category) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Street Address</label>
                                                        <input type="text"
                                                            name="address"
                                                            class="form-control"
                                                            value="{{ old('address', $vendor->address) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>City / State</label>
                                                        <input type="text"
                                                            name="city"
                                                            class="form-control"
                                                            value="{{ old('city', $vendor->city) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>ZIP</label>
                                                        <input type="text"
                                                            name="zip"
                                                            class="form-control"
                                                            value="{{ old('zip', $vendor->zip) }}">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button"
                                                    class="btn btn-secondary"
                                                    data-bs-dismiss="modal">
                                                Close
                                            </button>

                                            <button type="submit"
                                                    class="btn btn-primary">
                                                Save Changes
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>

                            </div>


                            <div class="tab-pane fade" id="settings">

                                    <div class="dashboard-box">

                                        <div class="dashboard-title">
                                            <h4>settings</h4>
                                        </div>

                                        <div class="dashboard-detail">

                                            {{-- ========================= --}}
                                            {{-- NOTIFICATIONS --}}
                                            {{-- ========================= --}}

                                            <div class="account-setting">

                                                <h5>Notifications</h5>

                                                <form action="{{ route('vendor.settings.notifications') }}" method="POST">
                                                    @csrf

                                                    <ul class="setting-list">

                                                        <li class="form-check">

                                                            <input
                                                                class="radio_animated form-check-input"
                                                                type="hidden"
                                                                name="allow_notifications"
                                                                value="0"
                                                            >

                                                            <input
                                                                class="radio_animated form-check-input"
                                                                type="checkbox"
                                                                name="allow_notifications"
                                                                id="exampleRadios1"
                                                                value="1"
                                                                {{ $setting->allow_notifications ? 'checked' : '' }}
                                                            >

                                                            <label class="form-check-label" for="exampleRadios1">
                                                                Allow Desktop Notifications
                                                            </label>

                                                        </li>


                                                        <li class="form-check">

                                                            <input
                                                                type="hidden"
                                                                name="enable_notifications"
                                                                value="0"
                                                            >

                                                            <input
                                                                class="radio_animated form-check-input"
                                                                type="checkbox"
                                                                name="enable_notifications"
                                                                id="exampleRadios2"
                                                                value="1"
                                                                {{ $setting->enable_notifications ? 'checked' : '' }}
                                                            >

                                                            <label class="form-check-label" for="exampleRadios2">
                                                                Enable Notifications
                                                            </label>

                                                        </li>


                                                        <li class="form-check">

                                                            <input
                                                                type="hidden"
                                                                name="own_activity_notification"
                                                                value="0"
                                                            >

                                                            <input
                                                                class="radio_animated form-check-input"
                                                                type="checkbox"
                                                                name="own_activity_notification"
                                                                id="exampleRadios3"
                                                                value="1"
                                                                {{ $setting->own_activity_notification ? 'checked' : '' }}
                                                            >

                                                            <label class="form-check-label" for="exampleRadios3">
                                                                Get notification for my own activity
                                                            </label>

                                                        </li>


                                                        <li class="form-check">

                                                            <input
                                                                type="hidden"
                                                                name="dnd"
                                                                value="0"
                                                            >

                                                            <input
                                                                class="radio_animated form-check-input"
                                                                type="checkbox"
                                                                name="dnd"
                                                                id="exampleRadios4"
                                                                value="1"
                                                                {{ $setting->dnd ? 'checked' : '' }}
                                                            >

                                                            <label class="form-check-label" for="exampleRadios4">
                                                                DND
                                                            </label>

                                                        </li>

                                                    </ul>

                                                    <button type="submit" class="btn btn-solid btn-xs mt-3">
                                                        Save Settings
                                                    </button>

                                                </form>

                                            </div>


                                            {{-- ========================= --}}
                                            {{-- DEACTIVATE ACCOUNT --}}
                                            {{-- ========================= --}}

                                            <div class="account-setting">

                                                <h5>deactivate account</h5>

                                                <form action="{{ route('vendor.settings.deactivate') }}" method="POST">
                                                    @csrf

                                                    <ul class="setting-list">

                                                        <li class="form-check">

                                                            <input
                                                                class="radio_animated form-check-input"
                                                                type="radio"
                                                                name="deactivation_reason"
                                                                id="exampleRadios45"
                                                                value="I have a privacy concern"
                                                                checked
                                                            >

                                                            <label class="form-check-label" for="exampleRadios45">
                                                                I have a privacy concern
                                                            </label>

                                                        </li>


                                                        <li class="form-check">

                                                            <input
                                                                class="radio_animated form-check-input"
                                                                type="radio"
                                                                name="deactivation_reason"
                                                                id="exampleRadios5"
                                                                value="This is temporary"
                                                            >

                                                            <label class="form-check-label" for="exampleRadios5">
                                                                This is temporary
                                                            </label>

                                                        </li>


                                                        <li class="form-check">

                                                            <input
                                                                class="radio_animated form-check-input"
                                                                type="radio"
                                                                name="deactivation_reason"
                                                                id="exampleRadios6"
                                                                value="other"
                                                            >

                                                            <label class="form-check-label" for="exampleRadios6">
                                                                other
                                                            </label>

                                                        </li>

                                                    </ul>

                                                    <button type="submit" class="btn btn-solid btn-xs mt-4">
                                                        Deactivate Account
                                                    </button>

                                                </form>

                                            </div>


                                            {{-- ========================= --}}
                                            {{-- DELETE ACCOUNT --}}
                                            {{-- ========================= --}}

                                            <div class="account-setting">

                                                <h5>Delete account</h5>

                                                <form action="{{ route('vendor.settings.delete') }}" method="POST">
                                                    @csrf

                                                    <ul class="setting-list">

                                                        <li class="form-check">

                                                            <input
                                                                class="radio_animated form-check-input"
                                                                type="radio"
                                                                name="deletion_reason"
                                                                id="exampleRadios7"
                                                                value="No longer usable"
                                                                checked
                                                            >

                                                            <label class="form-check-label" for="exampleRadios7">
                                                                No longer usable
                                                            </label>

                                                        </li>


                                                        <li class="form-check">

                                                            <input
                                                                class="radio_animated form-check-input"
                                                                type="radio"
                                                                name="deletion_reason"
                                                                id="exampleRadios8"
                                                                value="Want to switch on other account"
                                                            >

                                                            <label class="form-check-label" for="exampleRadios8">
                                                                Want to switch on other account
                                                            </label>

                                                        </li>


                                                        <li class="form-check">

                                                            <input
                                                                class="radio_animated form-check-input"
                                                                type="radio"
                                                                name="deletion_reason"
                                                                id="exampleRadios9"
                                                                value="other"
                                                            >

                                                            <label class="form-check-label" for="exampleRadios9">
                                                                other
                                                            </label>

                                                        </li>

                                                    </ul>

                                                    <button type="submit" class="btn btn-solid btn-xs mt-3">
                                                        Delete Account
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
    </section>
    <!--  dashboard section end -->

<script>
document.addEventListener("DOMContentLoaded", function () {

    // Check whether ApexCharts is loaded
    if (typeof ApexCharts === 'undefined') {
        console.error('ApexCharts is not loaded.');
        return;
    }

    // =========================
    // SALES CHART
    // =========================

    var salesElement = document.querySelector("#chart");

    if (salesElement) {

        var salesOptions = {
            series: [{
                name: 'Sales',
                data: @json(array_values($monthlySales->toArray()))
            }],

            chart: {
                type: 'area',
                height: 350,
                toolbar: {
                    show: false
                }
            },

            xaxis: {
                categories: @json(array_keys($monthlySales->toArray()))
            },

            dataLabels: {
                enabled: false
            },

            stroke: {
                curve: 'smooth'
            },

            tooltip: {
                y: {
                    formatter: function (value) {
                        return Number(value).toFixed(2);
                    }
                }
            }
        };

        var salesChart = new ApexCharts(
            salesElement,
            salesOptions
        );

        salesChart.render();
    }


    // =========================
    // ORDERS CHART
    // =========================

    var orderElement = document.querySelector("#chart-order");

    if (orderElement) {

        var orderOptions = {
            series: [{
                name: 'Orders',
                data: @json(array_values($monthlyOrders->toArray()))
            }],

            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }
            },

            xaxis: {
                categories: @json(array_keys($monthlyOrders->toArray()))
            },

            dataLabels: {
                enabled: false
            }
        };

        var orderChart = new ApexCharts(
            orderElement,
            orderOptions
        );

        orderChart.render();
    }

});
</script>

@endsection
