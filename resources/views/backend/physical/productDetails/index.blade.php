@extends('layouts.backendmaster.master')

@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="card">
            <div class="row product-page-main card-body">

                <!-- LEFT: IMAGE SLIDER -->
                <div class="col-xl-5">

                  @if($product->images->count())

                    <div class="product-slider owl-carousel owl-theme" id="sync1">

                        {{-- MAIN IMAGE --}}
                        @if($product->image)
                        <div class="item">
                            <img src="{{ asset('uploads/physical/products/' . $product->image) }}" class="img-fluid">
                        </div>
                        @endif

                        {{-- GALLERY IMAGES --}}
                        @foreach ($product->images as $image)
                        <div class="item">
                            <img src="{{ asset('uploads/physical/products/' . $image->image) }}" class="img-fluid">
                        </div>
                        @endforeach

                    </div>

                    <div class="owl-carousel owl-theme mt-2" id="sync2">

                        @if($product->image)
                        <div class="item">
                            <img src="{{ asset('uploads/physical/products/' . $product->image) }}"
                                class="img-fluid" style="cursor:pointer;">
                        </div>
                        @endif

                        @foreach ($product->images as $image)
                        <div class="item">
                            <img src="{{ asset('uploads/physical/products/' . $image->image) }}"
                                class="img-fluid" style="cursor:pointer;">
                        </div>
                        @endforeach

                    </div>

                @else

                    <img src="{{ asset('assets/images/ecommerce/placeholder.jpg') }}"
                        class="img-fluid rounded">

                @endif

                </div>

                <!-- RIGHT: DETAILS -->
                <div class="col-xl-7">
                    <div class="product-page-details product-right">

                        <h2>{{ $product->title }}</h2>

                        <!-- ⭐ Rating -->
                        <div class="rating-list">
                            @php
                                $rating = round($avgRating ?? 0);
                            @endphp

                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $rating)
                                    <i class="ri-star-fill"></i>
                                @else
                                    <i class="ri-star-line"></i>
                                @endif
                            @endfor
                        </div>

                        <hr>

                        <h6 class="product-title">Product Details</h6>
                        <p>{!! $product->description !!}</p>

                        <!-- Price -->
                        <div class="product-price">
                            <h3>
                                ${{ number_format($product->price, 2) }}
                                @if($product->original_price)
                                <del>${{ number_format($product->original_price, 2) }}</del>
                                @endif
                            </h3>
                        </div>

                        <!-- 🎨 Colors -->
                     <td>
                            @if($product->colors)
                                <ul class="color-variant">
                                    @foreach(explode(',', $product->colors) as $color)
                                        <li style="background-color: {{ $color }};"></li>
                                    @endforeach
                                </ul>
                            @else
                                N/A
                            @endif
                        </td>
                        <hr>

                        <!-- 📏 Size -->
                        @if($product->size)
                        <h6 class="product-title size-text">
                            Select Size
                            <span class="pull-right">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#sizemodal">Size Chart</a>
                            </span>
                        </h6>

                       <div class="size-box">
                            <ul>
                                <li class="active"><a href="javascript:void(0)">s</a></li>
                                <li><a href="javascript:void(0)">m</a></li>
                                <li><a href="javascript:void(0)">l</a></li>
                                <li><a href="javascript:void(0)">xl</a></li>
                            </ul>
                        </div>
                        @endif

                        <!-- 📦 Quantity -->
                            <div class="d-flex align-items-center">

                                <!-- Minus -->
                                <button type="button"
                                        class="btn btn-light border px-3"
                                        onclick="decreaseQty()">
                                    -
                                </button>

                                <!-- Quantity -->
                                <input type="text"
                                    id="qty"
                                    value="1"
                                    readonly
                                    class="form-control text-center mx-2"
                                    style="width: 60px;">

                                <!-- Plus -->
                                <button type="button"
                                        class="btn btn-light border px-3"
                                        onclick="increaseQty()">
                                    +
                                </button>

                            </div>
                        <hr>

                        <!-- Buttons -->
                        <div class="mt-3">
                            <button class="btn btn-primary">Add To Cart</button>
                            <button class="btn btn-secondary">Buy Now</button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- 📏 Size Modal -->
<div class="modal fade" id="sizemodal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $product->title }}</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('backend/assets/images/size-chart.jpg') }}" class="img-fluid">
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
let qty = 1;

function updateUI() {
    document.getElementById('qty').value = qty;
    document.getElementById('totalPrice').innerText = (price * qty).toFixed(2);
}

function increaseQty() {
    qty++;
    updateUI();
}

function decreaseQty() {
    if (qty > 1) {
        qty--;
        updateUI();
    }
}
</script>
@endsection
