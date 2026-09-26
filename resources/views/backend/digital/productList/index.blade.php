```blade
@extends('layouts.backendmaster.master')

@section('content')

    <div class="page-body">

        {{-- Container-fluid starts --}}
        <div class="container-fluid">

            <div class="page-header">

                <div class="row">

                    <div class="col-lg-6">

                        <div class="page-header-left">

                            <h3>
                                Digital Product List
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

                            <li class="breadcrumb-item">
                                Digital
                            </li>

                            <li class="breadcrumb-item active">
                                Product List
                            </li>

                        </ol>

                    </div>

                </div>

            </div>

        </div>
        {{-- Container-fluid Ends --}}


        {{-- Container-fluid starts --}}
        <div class="container-fluid">

            <div class="row products-admin ratio_asos">

                @forelse ($products as $product)

                    <div class="col-xl-3 col-sm-6">

                        <div class="card">

                            <div class="card-body product-box">

                                {{-- PRODUCT IMAGE --}}
                                <div class="img-wrapper">

                                    <div class="front">

                                        <a href="{{ route('admin.digital.product.details', $product->id) }}">

                                            @php
                                                $productImage = null;

                                                /*
                                                 * Digital product can have images
                                                 * through digital_product_images relationship.
                                                 */
                                                if ($product->images && $product->images->count() > 0) {
                                                    $productImage = $product->images->first()->image;
                                                }

                                                /*
                                                 * Fallback to the image field
                                                 * if relationship image is unavailable.
                                                 */
                                                if (!$productImage && !empty($product->image)) {
                                                    $productImage = $product->image;
                                                }
                                            @endphp

                                            @if ($productImage)

                                                <img src="{{ asset('uploads/digital/products/' . $productImage) }}"
                                                    class="img-fluid blur-up lazyload bg-img"
                                                    alt="{{ $product->title }}">

                                            @else

                                                <img src="{{ asset('backend/assets/images/pro3/1.jpg') }}"
                                                    class="img-fluid blur-up lazyload bg-img"
                                                    alt="{{ $product->title }}">

                                            @endif

                                        </a>


                                        {{-- HOVER BUTTONS --}}
                                        <div class="product-hover">

                                            <ul>

                                                {{-- EDIT --}}
                                                <li>

                                                    <button
                                                        onclick="window.location='{{ route('admin.digital.product.edit', $product->id) }}'"
                                                        class="btn"
                                                        type="button">

                                                        <i class="fa fa-edit"></i>

                                                    </button>

                                                </li>


                                                {{-- DELETE --}}
                                                <li>

                                                    <button
                                                        onclick="window.location='{{ route('admin.digital.product.delete', $product->id) }}'"
                                                        class="btn"
                                                        type="button">

                                                        <i class="fa fa-trash"></i>

                                                    </button>

                                                </li>

                                            </ul>

                                        </div>

                                    </div>

                                </div>


                                {{-- PRODUCT DETAILS --}}
                                <div class="product-detail">

                                    {{-- RATING --}}
                                    <div class="rating">

                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>

                                    </div>


                                    {{-- TITLE --}}
                                    <a href="{{ route('admin.digital.product.details', $product->id) }}">

                                        <h6>
                                            {{ $product->title }}
                                        </h6>

                                    </a>


                                    {{-- PRICE --}}
                                    <h4>
                                        ${{ $product->price }}

                                        @if ($product->original_price)
                                            <del>
                                                ${{ $product->original_price }}
                                            </del>
                                        @endif
                                    </h4>


                                    {{-- COLORS --}}
                                    @if ($product->colors)

                                        <ul class="color-variant">

                                            @foreach (explode(',', $product->colors) as $color)

                                                <li style="background-color: {{ trim($color) }};"></li>

                                            @endforeach

                                        </ul>

                                    @else

                                        <h6>
                                            Color: Not available.
                                        </h6>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12 text-center text-danger">

                        <h5>
                            No Digital Product Found.
                        </h5>

                    </div>

                @endforelse

            </div>

        </div>
        {{-- Container-fluid Ends --}}

    </div>

@endsection


@section('script')

<script>

    document.addEventListener('DOMContentLoaded', function () {

        @if ($errors->any())

            Toastify({

                text: "{{ $errors->first() }}",

                duration: 4000,

                close: true,

                gravity: "top",

                position: "center",

                backgroundColor: "linear-gradient(to right, #FF0112, #D21302)",

            }).showToast();

        @endif


        @if (session('success'))

            Toastify({

                text: "{{ session('success') }}",

                duration: 3000,

                close: true,

                gravity: "top",

                position: "center",

                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",

            }).showToast();

        @endif


        @if (session('error'))

            Toastify({

                text: "{{ session('error') }}",

                duration: 3000,

                close: true,

                gravity: "top",

                position: "center",

                backgroundColor: "linear-gradient(to right, #FF0112, #D21302)",

            }).showToast();

        @endif

    });

</script>

@endsection
```
