@extends('layouts.frontendmaster.master')

@section('content')

    <!-- Breadcrumb Section Start -->
    <div class="breadcrumb-section">
        <div class="container">
            <h2>Vendor profile</h2>
            <nav class="theme-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Vendor profile</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb Section End -->


    <!-- Vendor Profile Section Start -->
    <section class="vendor-profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="profile-left">

                        <!-- Vendor Image / Store Name -->
                        <div class="profile-image">
                            <div>

                                <img src="{{ asset('frontend/assets/images/logos/17.png') }}"
                                    alt="{{ $vendor->store_name ?? 'Store' }}"
                                    class="img-fluid">

                                <h3>
                                    {{ $vendor->store_name ?? 'Store Name' }}
                                </h3>

                                <!-- Rating -->
                                <div class="rating">
                                    @php
                                        $rating = round($averageRating ?? 0);
                                    @endphp

                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="ri-star-line {{ $i <= $rating ? 'fill' : '' }}"></i>
                                    @endfor
                                </div>

                                <h6>
                                    {{ $totalProducts ?? 0 }} products |
                                    {{ $totalReviews ?? 0 }} reviews
                                </h6>

                            </div>
                        </div>


                        <!-- Vendor Description -->
                        <div class="profile-detail">
                            <div>

                                <p>
                                    Based in our marketplace,
                                    {{ $vendor->store_name ?? 'This store' }}
                                    has been a Multikart member since
                                    {{ optional($vendor->created_at)->format('F d, Y') ?? 'recently' }}.

                                    {{ $vendor->store_name ?? 'Our store' }}
                                    is committed to providing quality products
                                    and excellent service to our customers.

                                    We believe in the principle of
                                    <strong>"Customer first, Quality uppermost".</strong>
                                </p>

                                <p>
                                    Welcome to
                                    {{ $vendor->store_name ?? 'our store' }}.

                                    We are focused on providing quality products
                                    and maintaining a great shopping experience
                                    for our customers.

                                    Thank you for choosing
                                    {{ $vendor->store_name ?? 'our store' }}.
                                </p>

                            </div>
                        </div>


                        <!-- Vendor Contact -->
                        <div class="vendor-contact">
                            <div>

                                <h6>follow us:</h6>

                                <div class="footer-social">
                                    <ul>

                                        <li>
                                            <a href="#!" target="_blank">
                                                <i class="ri-facebook-fill"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#!" target="_blank">
                                                <i class="ri-google-fill"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#!" target="_blank">
                                                <i class="ri-twitter-x-fill"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#!" target="_blank">
                                                <i class="ri-instagram-fill"></i>
                                            </a>
                                        </li>

                                    </ul>
                                </div>


                                <!-- Vendor Contact Details -->
                                <div class="vendor-details-box">

                                    <h6>if you have any query:</h6>

                                    <ul class="vendor-details">

                                        <li>
                                            <i class="ri-smartphone-line"></i>

                                            <h5>
                                                {{ $vendor->phone ?? 'Phone Number' }}
                                            </h5>
                                        </li>

                                        <li>
                                            <i class="ri-mail-line"></i>

                                            <h5>
                                                <a href="mailto:{{ $user->email }}">
                                                    {{ $user->email }}
                                                </a>
                                            </h5>
                                        </li>

                                    </ul>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Vendor Profile Section End -->


    <!-- Product Collection Section Start -->
    <section class="section-b-space ratio_asos">
        <div class="collection-wrapper">

            <div class="container">

                <div class="row">

                    <!-- ========================= -->
                    <!-- SIDEBAR -->
                    <!-- ========================= -->
                    <div class="col-xl-3 col-lg-4 collection-filter">

                        <!-- Mobile Filter Back -->
                        <div class="collection-filter-block">

                            <div class="collection-mobile-back">
                                <span class="filter-back">
                                    <i class="ri-arrow-left-s-line"></i>
                                    back
                                </span>
                            </div>


                            <div class="collection-collapse-block open">

                                <div class="accordion collection-accordion"
                                    id="accordionPanelsStayOpenExample">


                                    <!-- ========================= -->
                                    <!-- CATEGORIES -->
                                    <!-- ========================= -->
                                    <div class="accordion-item">

                                        <h2 class="accordion-header">
                                            <button class="accordion-button pt-0"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#panelsStayOpen-collapseOne">

                                                Categories

                                            </button>
                                        </h2>


                                        <div id="panelsStayOpen-collapseOne"
                                            class="accordion-collapse collapse show">

                                            <div class="accordion-body">

                                                @php
                                                    $categoryProducts = $products instanceof \Illuminate\Pagination\AbstractPaginator
                                                        ? $products->getCollection()
                                                        : collect($products);

                                                    $categories = $categoryProducts
                                                        ->map(function ($product) {
                                                            return optional($product->subcategory)->name;
                                                        })
                                                        ->filter()
                                                        ->unique()
                                                        ->sort()
                                                        ->values();
                                                @endphp


                                                <ul class="collection-listing">

                                                    @forelse ($categories as $category)

                                                        <li>
                                                            <div class="form-check">

                                                                <input class="form-check-input"
                                                                    type="checkbox"
                                                                    value="{{ $category }}"
                                                                    id="category-{{ \Illuminate\Support\Str::slug($category) }}">

                                                                <label class="form-check-label"
                                                                    for="category-{{ \Illuminate\Support\Str::slug($category) }}">

                                                                    {{ $category }}

                                                                </label>

                                                            </div>
                                                        </li>

                                                    @empty

                                                        <li>
                                                            <span>No categories found</span>
                                                        </li>

                                                    @endforelse

                                                </ul>

                                            </div>
                                        </div>

                                    </div>


<!-- ========================= -->
<!-- COLOURS -->
<!-- ========================= -->

<div class="accordion-item">

    <h2 class="accordion-header">

        <button class="accordion-button"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#panelsStayOpen-collapseThree">

            Colours

        </button>

    </h2>

    <div id="panelsStayOpen-collapseThree"
        class="accordion-collapse collapse show">

        <div class="accordion-body">

            <ul class="collection-listing">

                @forelse ($colors as $color)

                    <li>

                        <div class="form-check">

                            <input class="form-check-input"
                                type="checkbox"
                                name="color[]"
                                value="{{ $color }}"
                                id="color-{{ Str::slug($color) }}">

                            <label class="form-check-label"
                                for="color-{{ Str::slug($color) }}">

                                {{ $color }}

                            </label>

                        </div>

                    </li>

                @empty

                    <li>
                        <span>No colours found</span>
                    </li>

                @endforelse

            </ul>

        </div>

    </div>

</div>


                                    <!-- ========================= -->
                                    <!-- RATING -->
                                    <!-- ========================= -->
<div class="accordion-item">

    <h2 class="accordion-header">

        <button class="accordion-button"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#panelsStayOpen-collapseFive">

            Rating

        </button>

    </h2>


    <div id="panelsStayOpen-collapseFive"
        class="accordion-collapse collapse show">

        <div class="accordion-body">

            @php
                /*
                 * $ratingCounts should come from VendorController.
                 *
                 * Example:
                 * [
                 *     5 => 10,
                 *     4 => 6,
                 *     3 => 2,
                 *     2 => 1,
                 *     1 => 0,
                 * ]
                 */
                $ratingCounts = $ratingCounts ?? collect();

                $ratingCounts = collect($ratingCounts);
            @endphp


            <ul class="collection-listing">

                @for ($rating = 5; $rating >= 1; $rating--)

                    @php
                        $count = $ratingCounts->get($rating, 0);
                    @endphp

                    @if ($count > 0)

                        <li>

                            <div class="form-check">

                                <input class="form-check-input"
                                    type="checkbox"
                                    name="rating[]"
                                    value="{{ $rating }}"
                                    id="rating{{ $rating }}">

                                <label class="form-check-label"
                                    for="rating{{ $rating }}">

                                    <span>

                                        <span class="star-rating">

                                            @for ($star = 1; $star <= 5; $star++)

                                                @if ($star <= $rating)

                                                    <i class="ri-star-fill"></i>

                                                @else

                                                    <i class="ri-star-line"></i>

                                                @endif

                                            @endfor

                                        </span>

                                        <span>
                                            ({{ $rating }} Star)
                                        </span>

                                        <span>
                                            ({{ $count }})
                                        </span>

                                    </span>

                                </label>

                            </div>

                        </li>

                    @endif

                @endfor

            </ul>

        </div>

    </div>

</div>


<!-- ========================= -->
<!-- PRICE -->
<!-- ========================= -->

<div class="accordion-item">

    <h2 class="accordion-header">

        <button class="accordion-button"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#panelsStayOpen-collapseSix">

            Price

        </button>

    </h2>

    <div id="panelsStayOpen-collapseSix"
        class="accordion-collapse collapse show">

        <div class="accordion-body price-body">

            <div class="wrapper">

                <div class="range-slider">

                    <input type="text"
                        class="js-range-slider"
                        name="price"
                        value=""
                        data-min="{{ $minPrice }}"
                        data-max="{{ $maxPrice }}"
                        data-from="{{ $minPrice }}"
                        data-to="{{ $maxPrice }}">

                </div>

            </div>

        </div>

    </div>

</div>


                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- ========================= -->
                    <!-- PRODUCT CONTENT -->
                    <!-- ========================= -->
                    <div class="collection-content col-xl-9 col-lg-8">

                        <div class="page-main-content">

                            <div class="row">

                                <div class="col-sm-12">


                                    <!-- Banner -->
                                    <div class="top-banner-wrapper">

                                        <a href="#!">

                                            <img src="{{ asset('frontend/assets/images/inner-page/banner/1.png') }}"
                                                class="img-fluid blur-up lazyload"
                                                alt="Vendor Products">

                                        </a>

                                    </div>


                                    <!-- Mobile Filter Button -->
                                    <button class="filter-btn btn">

                                        <i class="ri-filter-fill"></i>

                                        Filter

                                    </button>


                                    <div class="collection-product-wrapper">


                                        <!-- ========================= -->
                                        <!-- PRODUCT TOP FILTER -->
                                        <!-- ========================= -->
                                        <div class="product-top-filter mt-0">

                                            <div class="product-filter-content w-100">

                                                <div class="d-flex align-items-center gap-sm-3 gap-2">

                                                    <select class="form-select">

                                                        <option selected>
                                                            Ascending Order
                                                        </option>

                                                        <option value="1">
                                                            Descending Order
                                                        </option>

                                                        <option value="2">
                                                            Low - High Price
                                                        </option>

                                                        <option value="3">
                                                            High - Low Price
                                                        </option>

                                                    </select>


                                                    <select class="form-select">

                                                        <option selected>
                                                            10 Products
                                                        </option>

                                                        <option value="1">
                                                            25 Products
                                                        </option>

                                                        <option value="2">
                                                            50 Products
                                                        </option>

                                                        <option value="3">
                                                            100 Products
                                                        </option>

                                                    </select>

                                                </div>


                                                <!-- Grid View -->
                                                <div class="collection-grid-view">

                                                    <ul>

                                                        <li class="product-2-layout-view grid-icon">

                                                            <img src="{{ asset('frontend/assets/images/inner-page/icon/2.png') }}"
                                                                alt="sort">

                                                        </li>


                                                        <li class="product-3-layout-view grid-icon active">

                                                            <img src="{{ asset('frontend/assets/images/inner-page/icon/3.png') }}"
                                                                alt="sort">

                                                        </li>


                                                        <li class="product-4-layout-view grid-icon">

                                                            <img src="{{ asset('frontend/assets/images/inner-page/icon/4.png') }}"
                                                                alt="sort">

                                                        </li>


                                                        <li class="list-layout-view list-icon">

                                                            <img src="{{ asset('frontend/assets/images/inner-page/icon/list.png') }}"
                                                                alt="sort">

                                                        </li>

                                                    </ul>

                                                </div>

                                            </div>

                                        </div>


                                        <!-- ========================= -->
                                        <!-- PRODUCT GRID -->
                                        <!-- ========================= -->
                                        <div class="product-wrapper-grid">

                                            <div class="row g-3 g-sm-4">


                                                @forelse ($products as $product)

                                                    <div class="col-xl-4 col-6 col-grid-box">

                                                        <div class="basic-product theme-product-1">

                                                            <div class="overflow-hidden">


                                                                <!-- Product Image -->
                                                                <div class="img-wrapper">

                                                                    <a href="{{ route('product.details', [$product->type, $product->id]) }}">


                                                                        @if ($product->type === 'physical')

                                                                            @if (!empty($product->image))

                                                                                <img src="{{ asset('uploads/physical/products/' . $product->image) }}"
                                                                                    class="w-100 img-fluid blur-up lazyload"
                                                                                    alt="{{ $product->title }}">

                                                                            @else

                                                                                <img src="{{ asset('frontend/assets/images/product/placeholder.jpg') }}"
                                                                                    class="w-100 img-fluid"
                                                                                    alt="{{ $product->title }}">

                                                                            @endif


                                                                        @else

                                                                            @php

                                                                                /*
                                                                                 * Digital product images
                                                                                 * are stored as JSON.
                                                                                 */
                                                                                $digitalImages = $product->images;

                                                                                if (is_string($digitalImages)) {

                                                                                    $digitalImages = json_decode(
                                                                                        $digitalImages,
                                                                                        true
                                                                                    );

                                                                                }

                                                                            @endphp


                                                                            @if (is_array($digitalImages) && count($digitalImages) > 0)

                                                                                <img src="{{ asset('uploads/digital/products/' . $digitalImages[0]) }}"
                                                                                    class="w-100 img-fluid blur-up lazyload"
                                                                                    alt="{{ $product->title }}">

                                                                            @else

                                                                                <img src="{{ asset('frontend/assets/images/product/placeholder.jpg') }}"
                                                                                    class="w-100 img-fluid"
                                                                                    alt="{{ $product->title }}">

                                                                            @endif

                                                                        @endif

                                                                    </a>


                                                                    <!-- Rating -->
                                                                    <div class="rating-label">

                                                                        <i class="ri-star-fill"></i>

                                                                        <span>
                                                                            4.5
                                                                        </span>

                                                                    </div>


                                                                    <!-- Cart / Wishlist / Quick View -->
                                                                    <div class="cart-info">


                                                                        <!-- Wishlist -->
                                                                        <a href="#!"
                                                                            title="Add to Wishlist"
                                                                            class="wishlist-icon">

                                                                            <i class="ri-heart-line"></i>

                                                                        </a>


                                                                        <!-- Physical Product Cart -->
                                                                        @if ($product->type === 'physical')

                                                                            <a href="{{ route('cart.add', ['type' => 'physical', 'id' => $product->id]) }}"
                                                                                title="Add to cart">

                                                                                <i class="ri-shopping-cart-line"></i>

                                                                            </a>

                                                                        @endif


                                                                        <!-- Quick View -->
                                                                        <a href="#quickView"
                                                                            data-bs-toggle="modal"
                                                                            title="Quick View">

                                                                            <i class="ri-eye-line"></i>

                                                                        </a>

                                                                    </div>

                                                                </div>


                                                                <!-- Product Details -->
                                                                <div class="product-detail">

                                                                    <div>


                                                                        <!-- Product Type -->
                                                                        @if ($product->type === 'physical')

                                                                            <span class="badge bg-primary">
                                                                                Physical
                                                                            </span>

                                                                        @else

                                                                            <span class="badge bg-success">
                                                                                Digital
                                                                            </span>

                                                                        @endif


                                                                        <!-- Product Title -->
                                                                        <h6>

                                                                            <a href="{{ route('product.details', [$product->type, $product->id]) }}">

                                                                                {{ $product->title }}

                                                                            </a>

                                                                        </h6>


                                                                        <!-- Description -->
                                                                        <p>

                                                                            {{ Str::limit($product->description ?? '', 100) }}

                                                                        </p>



                                                                    <!-- Price -->
                                                                    <h4 class="price">
                                                                        ${{ number_format($product->price, 2) }}

                                                                        @if (
                                                                            $product->type === 'physical' &&
                                                                            !empty($product->original_price) &&
                                                                            $product->original_price > $product->price
                                                                        )
                                                                            <del>
                                                                                ${{ number_format($product->original_price, 2) }}
                                                                            </del>
                                                                        @endif
                                                                    </h4>



                                                                    </div>


                                                                    <!-- Offer Panel -->
                                                                    <ul class="offer-panel">


                                                                        @if ($product->type === 'physical')

                                                                            <li>

                                                                                <span class="offer-icon">

                                                                                    <i class="ri-truck-line"></i>

                                                                                </span>

                                                                                Physical Product

                                                                            </li>

                                                                        @else

                                                                            <li>

                                                                                <span class="offer-icon">

                                                                                    <i class="ri-download-2-line"></i>

                                                                                </span>

                                                                                Instant Digital Download

                                                                            </li>

                                                                        @endif


                                                                    </ul>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>


                                                @empty

                                                    <div class="col-12 text-center">

                                                        <p class="mb-0">

                                                            No products found.

                                                        </p>

                                                    </div>

                                                @endforelse


                                            </div>

                                        </div>


                                        <!-- ========================= -->
                                        <!-- PAGINATION -->
                                        <!-- ========================= -->
                                        @if ($products instanceof \Illuminate\Pagination\AbstractPaginator)

                                            <div class="product-pagination">

                                                <div class="theme-paggination-block">

                                                    <nav>

                                                        {{ $products->links() }}

                                                    </nav>

                                                </div>

                                            </div>

                                        @endif


                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>
    <!-- Product Collection Section End -->

@endsection
