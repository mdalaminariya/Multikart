<!-- Product slider -->
<section class="section-b-space pt-0 ratio_asos">
    <div class="container">

        <div class="g-3 g-md-4 row row-cols-2 row-cols-md-3 row-cols-xl-4">

            @forelse ($products as $product)

                <div>
                    <div class="basic-product theme-product-1">

                        <div class="overflow-hidden">

                            <div class="img-wrapper">

                                <div class="ribbon">
                                    <span>Exclusive</span>
                                </div>

                                <a href="{{ route('product.details', [$product->type, $product->id]) }}">
                                    <img src="{{ asset($product->image_path) }}"
                                         class="img-fluid blur-up lazyload"
                                         alt="">
                                </a>

                                <div class="rating-label">
                                    <i class="ri-star-fill"></i>
                                    <span>4.5</span>
                                </div>

                                    <div class="cart-info">

                                        <a href="#!" class="wishlist-icon">
                                            <i class="ri-heart-line"></i>
                                        </a>

                                        <a href="{{ route('cart.add', ['type' => $product->type, 'id' => $product->id]) }}">
                                            <i class="ri-shopping-cart-line"></i>
                                        </a>

                                        <a href="#!" data-bs-toggle="modal" data-bs-target="#quickView">
                                            <i class="ri-eye-line"></i>
                                        </a>

                                        <a href="compare.html">
                                            <i class="ri-loop-left-line"></i>
                                        </a>

                                    </div>

                            </div>

                            <div class="product-detail">

                                <div>

                                    <div class="brand-w-color">

                                        <a class="product-title"
                                           href="{{ route('product.details', [$product->type, $product->id]) }}">
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

                                        @if($product->discount)
                                            <del>${{ $product->discount }}</del>
                                            <span class="discounted-price">
                                                {{ (int) $product->discount }}% Off
                                            </span>
                                        @endif
                                    </h4>

                                </div>

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

            @empty
                <div class="col-12 text-center">
                    No products found
                </div>
            @endforelse

        </div>

    </div>
</section>
<!-- Product slider end -->
