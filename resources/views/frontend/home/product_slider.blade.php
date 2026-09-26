<!-- Product slider -->

<section class="section-b-space pt-0 ratio_asos">

    <div class="container">

        <div class="g-3 g-md-4 row row-cols-2 row-cols-md-3 row-cols-xl-4">

            @forelse ($products as $product)

                {{-- PRODUCT CARD --}}
                <div>

                    <div class="basic-product theme-product-1">

                        <div class="overflow-hidden">

                            {{-- PRODUCT IMAGE --}}
                            <div class="img-wrapper">

                                <div class="ribbon">
                                    <span>Exclusive</span>
                                </div>

                                <a href="{{ route('product.details', [$product->type, $product->id]) }}">

                                    <img src="{{ asset($product->image_path) }}"
                                        class="img-fluid blur-up lazyload"
                                        alt="{{ $product->title }}">

                                </a>


                                {{-- RATING --}}
                                <div class="rating-label">

                                    <i class="ri-star-fill"></i>

                                    <span>4.5</span>

                                </div>


                                {{-- CART INFO --}}
                                <div class="cart-info">

                                    {{-- WISHLIST --}}
                                    <form action="{{ route('wishlist.toggle') }}"
                                        method="POST"
                                        class="wishlist-form">

                                        @csrf

                                        <input type="hidden"
                                            name="product_id"
                                            value="{{ $product->id }}">

                                        <input type="hidden"
                                            name="product_type"
                                            value="{{ $product->type }}">

                                        <button type="submit"
                                            class="wishlist-icon border-0 bg-transparent p-0">

                                            <i class="ri-heart-line"></i>

                                        </button>

                                    </form>


                                    {{-- CART --}}
                                    <a href="{{ route('cart.add', [
                                        'type' => $product->type,
                                        'id' => $product->id
                                    ]) }}">

                                        <i class="ri-shopping-cart-line"></i>

                                    </a>


                                    {{-- QUICK VIEW --}}
                                    <a href="#!"
                                        title="Quick View"
                                        data-bs-toggle="modal"
                                        data-bs-target="#quickView{{ $product->type }}{{ $product->id }}">

                                        <i class="ri-eye-line"></i>

                                    </a>


                                    {{-- COMPARE --}}
                                    <a href="{{ route('compare.add', [
                                        $product->type,
                                        $product->id
                                    ]) }}"
                                        title="Compare">

                                        <i class="ri-loop-left-line"></i>

                                    </a>

                                </div>

                            </div>


                            {{-- PRODUCT DETAILS --}}
                            <div class="product-detail">

                                <div>

                                    <div class="brand-w-color">

                                        <a class="product-title"
                                            href="{{ route('product.details', [
                                                $product->type,
                                                $product->id
                                            ]) }}">

                                            {{ $product->title }}

                                        </a>


                                        {{-- COLORS --}}
                                        <div class="color-panel">

                                            @if (!empty($product->colors))

                                                <ul class="color-variant">

                                                    @foreach (explode(',', $product->colors) as $color)

                                                        <li style="background-color: {{ trim($color) }};"></li>

                                                    @endforeach

                                                </ul>

                                            @else

                                                <span>N/A</span>

                                            @endif

                                        </div>

                                    </div>


                                    <h6>
                                        sub title
                                    </h6>


                                    {{-- PRICE --}}
                                    <h4 class="price">

                                        ${{ $product->price }}

                                        @if (!empty($product->discount))

                                            <del>
                                                ${{ $product->original_price }}
                                            </del>

                                            <span class="discounted-price">
                                                {{ (int) $product->discount }}% Off
                                            </span>

                                        @endif

                                    </h4>

                                </div>


                                {{-- OFFER PANEL --}}
                                <ul class="offer-panel">

                                    <li>

                                        <span class="offer-icon">
                                            <i class="ri-discount-percent-fill"></i>
                                        </span>

                                        Limited Time Offer:
                                        {{ (int) $product->discount }}% off

                                    </li>


                                    <li>

                                        <span class="offer-icon">
                                            <i class="ri-discount-percent-fill"></i>
                                        </span>

                                        Limited Time Offer:
                                        {{ (int) $product->discount }}% off

                                    </li>


                                    <li>

                                        <span class="offer-icon">
                                            <i class="ri-discount-percent-fill"></i>
                                        </span>

                                        Limited Time Offer:
                                        {{ (int) $product->discount }}% off

                                    </li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- QUICK VIEW MODAL --}}
                {{-- ================================================= --}}

                <div class="modal fade theme-modal-2 quick-view-modal"
                    id="quickView{{ $product->type }}{{ $product->id }}">

                    <div class="modal-dialog modal-lg modal-dialog-centered">

                        <div class="modal-content">


                            {{-- CLOSE --}}
                            <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">

                                <i class="ri-close-line"></i>

                            </button>


                            <div class="modal-body">

                                <div class="wrap-modal-slider">

                                    <div class="row g-sm-4 g-3">


                                        {{-- IMAGE --}}
                                        <div class="col-lg-6">

                                            <div class="row g-3">

                                                <div class="col-12">

                                                    <div class="view-main-slider">

                                                        <div>

                                                            <img src="{{ asset($product->image_path) }}"
                                                                class="img-fluid"
                                                                alt="{{ $product->title }}">

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>


                                        {{-- DETAILS --}}
                                        <div class="col-lg-6">

                                            <div class="right-sidebar-modal">


                                                {{-- NAME --}}
                                                <a class="name"
                                                    href="{{ route('product.details', [
                                                        $product->type,
                                                        $product->id
                                                    ]) }}">

                                                    {{ $product->title }}

                                                </a>


                                                {{-- RATING --}}
                                                <div class="product-rating">

                                                    <ul class="rating-list">

                                                        <li>
                                                            <i class="ri-star-line"></i>
                                                        </li>

                                                        <li>
                                                            <i class="ri-star-line"></i>
                                                        </li>

                                                        <li>
                                                            <i class="ri-star-line"></i>
                                                        </li>

                                                        <li>
                                                            <i class="ri-star-line"></i>
                                                        </li>

                                                        <li>
                                                            <i class="ri-star-line"></i>
                                                        </li>

                                                    </ul>

                                                    <div class="divider">
                                                        |
                                                    </div>

                                                    <a href="#!">
                                                        0 Review
                                                    </a>

                                                </div>


                                                {{-- PRICE --}}
                                                <div class="price-text">

                                                    <h3>

                                                        <span class="fw-normal">
                                                        </span>

                                                        ${{ number_format($product->price, 2) }}

                                                    </h3>

                                                    <span class="text">
                                                        Inclusive all the text
                                                    </span>

                                                </div>


                                                {{-- DESCRIPTION --}}
                                                <p class="description-text">

                                                    {{ $product->description ?? 'No description available.' }}

                                                </p>


                                                {{-- QUANTITY --}}
                                                <div class="qty-box">

                                                    <div class="input-group qty-container">

                                                        <button type="button"
                                                            class="btn qty-btn-minus">

                                                            <i class="ri-arrow-left-s-line"></i>

                                                        </button>


                                                        <input type="number"
                                                            readonly
                                                            name="qty"
                                                            class="form-control input-qty"
                                                            value="1">


                                                        <button type="button"
                                                            class="btn qty-btn-plus">

                                                            <i class="ri-arrow-right-s-line"></i>

                                                        </button>

                                                    </div>

                                                </div>


                                                {{-- BUTTONS --}}
                                                <div class="product-buy-btn-group">


                                                    {{-- ADD TO CART --}}
                                                    <a href="{{ route('cart.add', [
                                                        'type' => $product->type,
                                                        'id' => $product->id
                                                    ]) }}"
                                                        class="btn btn-animation btn-solid buy-button hover-solid scroll-button">

                                                        <span class="d-inline-block ring-animation">

                                                            <i class="ri-shopping-cart-line me-1"></i>

                                                        </span>

                                                        Add To Cart

                                                    </a>


                                                    {{-- BUY NOW --}}
                                                    <a href="{{ route('product.details', [
                                                        $product->type,
                                                        $product->id
                                                    ]) }}"
                                                        class="btn btn-solid buy-button">

                                                        Buy Now

                                                    </a>

                                                </div>


                                                {{-- COMPARE --}}
                                                <div class="buy-box compare-box">

                                                    <a href="#!">

                                                        <i class="ri-heart-line"></i>

                                                        <span>
                                                            Add To Wishlist
                                                        </span>

                                                    </a>


                                                    <a href="{{ route('compare.add', [
                                                        $product->type,
                                                        $product->id
                                                    ]) }}">

                                                        <i class="ri-refresh-line"></i>

                                                        <span>
                                                            Add To Compare
                                                        </span>

                                                    </a>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

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
