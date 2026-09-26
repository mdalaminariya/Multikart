@extends('layouts.frontendmaster.master')

@section('content')
{{-- breadcrumb start --}}
<div class="breadcrumb-section">
    <div class="container">
        <h2>Compare</h2>

        <nav class="theme-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    Compare
                </li>
            </ol>
        </nav>
    </div>
</div>
{{-- breadcrumb End --}}


{{-- section start --}}
<section class="compare-padding">
    <div class="container">

        <div class="row">
            <div class="col-sm-12">

                <div class="compare-page">

                    @if ($products->count() > 0)

                        <div class="table-wrapper table-responsive">

                            <table class="table">

                                {{-- =========================
                                    REMOVE BUTTONS
                                ========================== --}}
                                <thead>
                                    <tr class="th-compare">

                                        <td>Action</td>

                                        @foreach ($products as $product)

                                            <th class="item-row">

                                                <a href="{{ route('compare.remove', [$product->compare_type, $product->id]) }}"
                                                    class="remove-compare">
                                                    Remove
                                                </a>

                                            </th>

                                        @endforeach

                                    </tr>
                                </thead>


                                <tbody id="table-compare">

                                    {{-- =========================
                                        PRODUCT NAME
                                    ========================== --}}
                                    <tr>

                                        <th class="product-name">
                                            Product Name
                                        </th>

                                        @foreach ($products as $product)

                                            <td class="grid-link__title">

                                                <a href="{{ route('product.details', [$product->compare_type, $product->id]) }}">
                                                    {{ $product->title }}
                                                </a>

                                            </td>

                                        @endforeach

                                    </tr>


                                    {{-- =========================
                                        PRODUCT IMAGE
                                    ========================== --}}
                                    <tr>

                                        <th class="product-name">
                                            Product Image
                                        </th>

                                        @foreach ($products as $product)

                                            <td class="item-row">

                                                @if ($product->compare_type === 'physical')

                                                    {{-- Physical product image --}}
                                                    @if ($product->image)

                                                        <a href="{{ route('product.details', [$product->compare_type, $product->id]) }}">

                                                            <img src="{{ asset('uploads/physical/products/' . $product->image) }}"
                                                                alt="{{ $product->title }}"
                                                                class="featured-image">

                                                        </a>

                                                    @endif

                                                @else

                                                    {{-- Digital product image --}}
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

                                                        <a href="{{ route('product.details', [$product->compare_type, $product->id]) }}">

                                                            <img src="{{ asset('uploads/digital/products/' . $digitalImage) }}"
                                                                alt="{{ $product->title }}"
                                                                class="featured-image">

                                                        </a>

                                                    @endif

                                                @endif

                                                
                                                {{-- Price --}}
                                                @php
                                                    $currentPrice = (float) ($product->price ?? 0);
                                                    $originalPrice = (float) ($product->original_price ?? 0);

                                                    $discountPercentage = 0;

                                                    if ($originalPrice > 0 && $originalPrice > $currentPrice) {
                                                        $discountPercentage = round(
                                                            (($originalPrice - $currentPrice) / $originalPrice) * 100
                                                        );
                                                    }
                                                @endphp

                                                <div class="product-price product_price">

                                                    @if ($discountPercentage > 0)
                                                        <strong>
                                                            On Sale:
                                                        </strong>
                                                    @endif

                                                    <span>
                                                        ${{ number_format($currentPrice, 2) }}
                                                    </span>

                                                    @if ($discountPercentage > 0)
                                                        <del>
                                                            ${{ number_format($originalPrice, 2) }}
                                                        </del>

                                                        <span class="discounted-price">
                                                            {{ $discountPercentage }}% Off
                                                        </span>
                                                    @endif

                                                </div>



                                                {{-- Add to Cart --}}
                                                <div class="variants clearfix">

                                                    <a href="{{ route('cart.add', [$product->compare_type, $product->id]) }}"
                                                        title="Add to Cart"
                                                        class="add-to-cart btn btn-solid">

                                                        Add to Cart

                                                    </a>

                                                </div>


                                                <p class="grid-link__title hidden">
                                                    {{ $product->title }}
                                                </p>

                                            </td>

                                        @endforeach

                                    </tr>


                                    {{-- =========================
                                        PRODUCT DESCRIPTION
                                    ========================== --}}
                                    <tr>

                                        <th class="product-name">
                                            Product Description
                                        </th>

                                        @foreach ($products as $product)

                                            <td class="item-row">

                                                <p class="description-compare">

                                                    @if ($product->compare_type === 'physical')

                                                        {{ $product->description ?? 'No description available.' }}

                                                    @else

                                                        {{ $product->short_summary ?? $product->description ?? 'No description available.' }}

                                                    @endif

                                                </p>

                                            </td>

                                        @endforeach

                                    </tr>


                                    {{-- =========================
                                        AVAILABILITY
                                    ========================== --}}
                                    <tr>

                                        <th class="product-name">
                                            Availability
                                        </th>

                                        @foreach ($products as $product)

                                            <td class="available-stock">

                                                @if ($product->compare_type === 'physical')

                                                    @if ($product->quantity > 0)

                                                        <p>
                                                            Available In stock
                                                        </p>

                                                    @else

                                                        <p>
                                                            Out of stock
                                                        </p>

                                                    @endif

                                                @else

                                                    {{-- Digital products are generally available --}}
                                                    <p>
                                                        Available
                                                    </p>

                                                @endif

                                            </td>

                                        @endforeach

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    @else

                        {{-- =========================
                            EMPTY COMPARE
                        ========================== --}}

                        <div class="text-center py-5">

                            <h3>
                                No products to compare
                            </h3>

                            <p>
                                Add products to compare them here.
                            </p>

                            <a href="{{ route('home') }}"
                                class="btn btn-solid mt-3">
                                Continue Shopping
                            </a>

                        </div>

                    @endif

                </div>

            </div>
        </div>

    </div>
</section>
{{-- Section ends --}}
@endsection
