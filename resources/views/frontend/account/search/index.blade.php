@extends('layouts.frontendmaster.master')

@section('content')
        <!--section start-->
    <section class="authentication-page">
        <div class="container">
            <section class="search-block">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <form class="form-header">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search Products......">
                                    <div class="input-group-append">
                                        <button class="btn btn-solid" type="submit">
                                            <i class="ri-search-line"></i>Search
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <!-- section end -->


    <!-- product section start -->
<section class="section-b-space ratio_asos">
    <div class="container">
        <div class="row g-sm-4 g-3">

            @forelse ($products as $product)

                <div class="col-lg-3 col-md-4 col-6">
                    <div class="basic-product theme-product-1">
                        <div class="overflow-hidden">

                            <div class="img-wrapper">

                                <a href="{{ route('product.details', [$product->type, $product->id]) }}">

                                    @if ($product->type === 'physical')
                                        <img src="{{ asset('uploads/physical/products/' . $product->image) }}"
                                            class="img-fluid blur-up lazyload"
                                            alt="{{ $product->title }}">
                                    @else
                                        @php
                                            $digitalImage = $product->images;

                                            if (is_string($digitalImage)) {
                                                $decoded = json_decode($digitalImage, true);

                                                if (is_array($decoded)) {
                                                    $digitalImage = $decoded[0] ?? null;
                                                }
                                            } elseif (is_array($digitalImage)) {
                                                $digitalImage = $digitalImage[0] ?? null;
                                            }
                                        @endphp

                                        @if ($digitalImage)
                                            <img src="{{ asset('uploads/digital/products/' . $digitalImage) }}"
                                                class="img-fluid blur-up lazyload"
                                                alt="{{ $product->title }}">
                                        @endif
                                    @endif

                                </a>

                                <div class="rating-label">
                                    <i class="ri-star-fill"></i>
                                    <span>4.5</span>
                                </div>

                                <div class="cart-info">
                                    <a href="#!" title="Add to Wishlist" class="wishlist-icon">
                                        <i class="ri-heart-line"></i>
                                    </a>

                                    <a href="{{ route('cart.add', [$product->type, $product->id]) }}"
                                        title="Add to cart">
                                        <i class="ri-shopping-cart-line"></i>
                                    </a>

                                    <a href="{{ route('product.details', [$product->type, $product->id]) }}"
                                        title="Quick View">
                                        <i class="ri-eye-line"></i>
                                    </a>

                                    <a href="#!" title="Compare">
                                        <i class="ri-loop-left-line"></i>
                                    </a>
                                </div>

                            </div>

                            <div class="product-detail">
                                <div>

                                    <div class="brand-w-color">

                                        <a class="product-title"
                                            href="{{ route('product.details', [$product->type, $product->id]) }}">
                                            {{ $product->brand ?? 'No Brand' }}
                                        </a>

                                        @if ($product->type === 'physical' && $product->colors)
                                            <div class="color-panel">
                                                <ul>
                                                    @foreach (explode(',', $product->colors) as $color)
                                                        <li style="background-color: {{ trim($color) }};"></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                    </div>

                                    <h6>{{ $product->title }}</h6>

                                    <h4 class="price">
                                        ${{ number_format($product->price, 2) }}

                                        @if (!empty($product->discount) && $product->discount > 0)
                                            <span class="discounted-price">
                                                {{ $product->discount }}% Off
                                            </span>
                                        @endif
                                    </h4>

                                </div>

                                <ul class="offer-panel">
                                    @if (!empty($product->discount) && $product->discount > 0)
                                        <li>
                                            <span class="offer-icon">
                                                <i class="ri-discount-percent-fill"></i>
                                            </span>
                                            Limited Time Offer: {{ $product->discount }}% off
                                        </li>
                                    @endif
                                </ul>

                            </div>

                        </div>
                    </div>
                </div>

            @empty

                <div class="col-12">
                    <div class="text-center py-5">
                        <h3>No products found</h3>
                        <p>Try searching for another product.</p>
                    </div>
                </div>

            @endforelse

        </div>
    </div>
</section>
    <!-- product section end -->

@endsection