<!-- Tab product -->
<div class="title1 section-t-space">
    <h4>exclusive products</h4>
    <h2 class="title-inner1">everyday casual</h2>
</div>

<section class="section-b-space pt-0 ratio_asos">
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="theme-tab">

                    {{-- ================= TAB TITLE ================= --}}
                    <ul class="tabs tab-title">

                        @foreach($groupedProducts as $subcategory => $items)
                            <li class="{{ $loop->first ? 'current' : '' }}">
                                <a href="tab-{{ $loop->index }}">
                                    {{ strtoupper($subcategory) }}
                                </a>
                            </li>
                        @endforeach

                    </ul>

                    {{-- ================= TAB CONTENT ================= --}}
                    <div class="tab-content-cls">

                        @foreach($groupedProducts as $category => $items)

                            <div id="tab-{{ $loop->index }}"
                                 class="tab-content {{ $loop->first ? 'active default' : '' }}">

                                <div class="g-3 g-md-4 row row-cols-2 row-cols-md-3 row-cols-xl-4">

                                    @foreach($items as $product)
                                        <div>
                                            <div class="basic-product theme-product-1">

                                                <div class="overflow-hidden">

                                                    {{-- IMAGE --}}
                                                    <div class="img-wrapper">
                                                        <a href="{{ route('product.details', [$product->type, $product->id]) }}">

                                                            <img src="{{ $product->image_path }}"
                                                                 class="img-fluid blur-up lazyload"
                                                                 alt="">
                                                        </a>

                                                        {{-- RATING --}}
                                                        <div class="rating-label">
                                                            <i class="ri-star-fill"></i>
                                                            <span>{{ $product->rating ?? 4.5 }}</span>
                                                        </div>

                                                        {{-- ACTIONS --}}
                                                        <div class="cart-info">
                                                            <a href="#!" class="wishlist-icon">
                                                                <i class="ri-heart-line"></i>
                                                            </a>

                                                            <button data-bs-toggle="modal"
                                                                    data-bs-target="#addtocart">
                                                                <i class="ri-shopping-cart-line"></i>
                                                            </button>

                                                            <a href="#!"
                                                               data-bs-toggle="modal"
                                                               data-bs-target="#quickView">
                                                                <i class="ri-eye-line"></i>
                                                            </a>

                                                            <a href="compare.html">
                                                                <i class="ri-loop-left-line"></i>
                                                            </a>
                                                        </div>

                                                    </div>

                                                    {{-- DETAILS --}}
                                                    <div class="product-detail">

                                                        <div>

                                                            <div class="brand-w-color">

                                                                <a class="product-title" href="{{ route('product.details', [$product->type, $product->id]) }}">
                                                                    {{ $product->title }}
                                                                </a>

                                                                <div class="color-panel">
                                                                        @if($product->colors)
                                                                            <ul class="color-variant">
                                                                                @foreach(explode(',', $product->colors) as $color)
                                                                                    <li style="background-color: {{ trim($color) }};"></li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @else
                                                                            N/A
                                                                        @endif
                                                                    <span>+2</span>
                                                                </div>
                                                            </div>

                                                            <h6>sub title</h6>

                                                            <h4 class="price">
                                                                ${{ $product->price }}
                                                                    <del>${{ $product->discount }}</del>

                                                                @if($product->discount)
                                                                    <span class="discounted-price">
                                                                        {{ (int) $product->discount }}% Off
                                                                    </span>
                                                                @endif
                                                            </h4>

                                                        </div>

                                                        {{-- OFFER --}}
                                                        <ul class="offer-panel">
                                                            <li>
                                                                <span class="offer-icon">
                                                                    <i class="ri-discount-percent-fill"></i>
                                                                </span>
                                                                Limited Time Offer: {{ (int) $product->discount }}% off
                                                            </li>
                                                            <li>
                                                                <span class="offer-icon">
                                                                    <i class="ri-discount-percent-fill"></i>
                                                                </span>
                                                                Limited Time Offer: {{ (int) $product->discount }}% off
                                                            </li>
                                                            <li>
                                                                <span class="offer-icon">
                                                                    <i class="ri-discount-percent-fill"></i>
                                                                </span>
                                                                Limited Time Offer: {{ (int) $product->discount }}% off
                                                            </li>
                                                        </ul>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
<!-- Tab product end -->
