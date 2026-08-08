@extends('layouts.frontendmaster.master')

@section('content')

<div class="breadcrumb-section">
    <div class="container">
        <h2>Cart</h2>

        <nav class="theme-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">Cart</li>
            </ol>
        </nav>
    </div>
</div>

<section class="cart-section section-b-space">
    <div class="container">

        <div class="table-responsive">

            <table class="table cart-table">

                <thead>
                    <tr class="table-head">
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($cartItems as $cartItem)

                    @php

                        $product = $cartItem->product;

                        if($cartItem->product_type == 'physical'){
                            $image = asset('uploads/physical/products/'.$product->image);
                        }else{
                            $image = asset('uploads/digital/products/'.$product->images);
                        }

                    @endphp

                    <tr>

                        <td>

                            <a href="{{ route('product.details',[$cartItem->product_type,$product->id]) }}">

                                <img src="{{ $image }}"
                                     class="img-fluid"
                                     width="80"
                                     alt="{{ $product->title }}">

                            </a>

                        </td>

                        <td>

                            <a href="{{ route('product.details',[$cartItem->product_type,$product->id]) }}">

                                {{ $product->title }}

                            </a>

                            <div class="mobile-cart-content row">

                                <div class="col">

                                    <div class="qty-box">

                                        <div class="input-group qty-container">

                                            <a href="{{ route('cart.decrease',$cartItem->id) }}"
                                               class="btn qty-btn-minus">

                                                <i class="ri-arrow-left-s-line"></i>

                                            </a>

                                            <input type="number"
                                                   readonly
                                                   class="form-control input-qty"
                                                   value="{{ $cartItem->quantity }}">

                                            <a href="{{ route('cart.increase',$cartItem->id) }}"
                                               class="btn qty-btn-plus">

                                                <i class="ri-arrow-right-s-line"></i>

                                            </a>

                                        </div>

                                    </div>

                                </div>

                                <div class="col table-price">

                                    <h2 class="td-color">
                                        ${{ number_format($cartItem->price,2) }}
                                    </h2>

                                </div>

                                <div class="col">

                                    <h2 class="td-color">

                                        <a href="{{ route('cart.remove',$cartItem->id) }}"
                                           class="icon remove-btn">

                                            <i class="ri-close-line"></i>

                                        </a>

                                    </h2>

                                </div>

                            </div>

                        </td>

                        <td class="table-price">

                            <h2>
                                ${{ number_format($cartItem->price,2) }}
                            </h2>

                        </td>

                        <td>

                            <div class="qty-box">

                                <div class="input-group qty-container">

                                    <a href="{{ route('cart.decrease',$cartItem->id) }}"
                                       class="btn qty-btn-minus">

                                        <i class="ri-arrow-left-s-line"></i>

                                    </a>

                                    <input type="number"
                                           readonly
                                           class="form-control input-qty"
                                           value="{{ $cartItem->quantity }}">

                                    <a href="{{ route('cart.increase',$cartItem->id) }}"
                                       class="btn qty-btn-plus">

                                        <i class="ri-arrow-right-s-line"></i>

                                    </a>

                                </div>

                            </div>

                        </td>

                        <td>

                            <h2 class="td-color">

                                ${{ number_format($cartItem->price * $cartItem->quantity,2) }}

                            </h2>

                        </td>

                        <td>

                            <a href="{{ route('cart.remove',$cartItem->id) }}"
                               class="icon remove-btn">

                                <i class="ri-close-line"></i>

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center py-5">

                            <h4>Your cart is empty.</h4>

                        </td>

                    </tr>

                @endforelse

                </tbody>

                <tfoot>

                    <tr>

                        <td colspan="4" class="d-md-table-cell d-none">
                            Total Price :
                        </td>

                        <td class="d-md-none">
                            Total Price :
                        </td>

                        <td>

                            <h2>

                                ${{ number_format($cartTotal,2) }}

                            </h2>

                        </td>

                    </tr>

                </tfoot>

            </table>

        </div>

        <div class="row cart-buttons">

            <div class="col-6">

                <a href="{{ url('/') }}"
                   class="btn btn-solid text-capitalize">

                    Continue Shopping

                </a>

            </div>

            <div class="col-6 text-end">

                <a href="{{ route('checkout.index') }}"
                   class="btn btn-solid text-capitalize">

                    Check Out

                </a>

            </div>

        </div>

    </div>
</section>

@endsection
