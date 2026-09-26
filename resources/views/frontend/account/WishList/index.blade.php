@extends('layouts.frontendmaster.master')

@section('content')
        <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <h2>Wishlist</h2>
            <nav class="theme-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Wishlist</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--section start-->
<section class="wishlist-section section-b-space">

    <div class="container">

        <div class="table-responsive">

            <table class="table cart-table">

                <thead>

                    <tr class="table-head">

                        <th>image</th>

                        <th>product name</th>

                        <th>price</th>

                        <th>availability</th>

                        <th>action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($wishlists as $wishlist)

                        <tr>

                            {{-- PRODUCT IMAGE --}}
                            <td>

                                <a href="{{ route('product.details', [
                                    $wishlist->product_type,
                                    $wishlist->product_id
                                ]) }}">

                                    <img src="{{ $wishlist->image }}"
                                        class="img-fluid"
                                        alt="{{ $wishlist->product_name }}">

                                </a>

                            </td>


                            {{-- PRODUCT NAME --}}
                            <td>

                                <a href="{{ route('product.details', [
                                    $wishlist->product_type,
                                    $wishlist->product_id
                                ]) }}">

                                    {{ $wishlist->product_name }}

                                </a>


                                {{-- MOBILE CONTENT --}}
                                <div class="mobile-cart-content row">

                                    <div class="col">

                                        <p>
                                            {{ $wishlist->availability }}
                                        </p>

                                    </div>


                                    <div class="col">

                                        <h2 class="td-color">

                                            ${{ number_format($wishlist->price, 2) }}

                                        </h2>

                                    </div>


                                    <div class="col">

                                        <h2 class="td-color">

                                            {{-- REMOVE --}}
                                            <form action="{{ route('wishlist.remove', $wishlist->id) }}"
                                                method="POST"
                                                class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="icon me-1 border-0 bg-transparent p-0">

                                                    <i class="ri-close-line"></i>

                                                </button>

                                            </form>


                                            {{-- CART --}}
                                            <a href="{{ route('cart.add', [
                                                'type' => $wishlist->product_type,
                                                'id' => $wishlist->product_id
                                            ]) }}"
                                                class="cart">

                                                <i class="ri-shopping-cart-line"></i>

                                            </a>

                                        </h2>

                                    </div>

                                </div>

                            </td>


                            {{-- PRICE --}}
                            <td>

                                <h2>
                                    ${{ number_format($wishlist->price, 2) }}
                                </h2>

                            </td>


                            {{-- AVAILABILITY --}}
                            <td>

                                <p>
                                    {{ $wishlist->availability }}
                                </p>

                            </td>


                            {{-- ACTION --}}
                            <td>

                                <div class="icon-box d-flex gap-2 justify-content-center">

                                    {{-- REMOVE --}}
                                    <form action="{{ route('wishlist.remove', $wishlist->id) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="icon me-1 border-0 bg-transparent p-0">

                                            <i class="ri-close-line"></i>

                                        </button>

                                    </form>


                                    {{-- ADD TO CART --}}
                                    <a href="{{ route('cart.add', [
                                        'type' => $wishlist->product_type,
                                        'id' => $wishlist->product_id
                                    ]) }}"
                                        class="cart">

                                        <i class="ri-shopping-cart-line"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="text-center py-5">

                                <h4>
                                    Your wishlist is empty
                                </h4>

                                <p class="mt-2">
                                    Add products to your wishlist and they will appear here.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- WISHLIST BUTTONS --}}
        <div class="wishlist-buttons">

            <a href="{{ route('home') }}"
                class="btn btn-solid">

                continue shopping

            </a>

            @if ($wishlists->count() > 0)

                <a href="{{ route('checkout') }}"
                    class="btn btn-solid">

                    check out

                </a>

            @endif

        </div>

    </div>

</section>
    <!--section end-->

@endsection