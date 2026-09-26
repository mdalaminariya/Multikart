
<div class="offcanvas offcanvas-end cart-offcanvas" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
        <div class="offcanvas-header">
            <h3 class="offcanvas-title"> My Cart ({{ $cartItems->count() }})</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas">
                <i class="ri-close-line"></i>
            </button>
        </div>

        <div class="offcanvas-body">
            <div class="pre-text-box">
                <p>spend $20.96 More And Enjoy Free Shipping!</p>
                <div class="progress" role="progressbar">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 58.08%;">
                        <i class="ri-truck-line"></i>
                    </div>
                </div>
            </div>

            <div class="sidebar-title">
                <a href="{{ route('cart.clear') }}">
                    Clear Cart
                </a>
            </div>

            <div class="cart-media">
                <ul class="cart-product">
                    @foreach ($cartItems as $cartItem)
                        <li>
                            <div class="media">
                                <a href="{{ route('product.details', [$cartItem->product_type, $cartItem->product->id]) }}">
                                    <img
                                        src="{{ $cartItem->product_type == 'physical'
                                                ? asset('uploads/physical/products/'.$cartItem->product->image)
                                                : asset('uploads/digital/products/'.$cartItem->product->images) }}"
                                        class="img-fluid"
                                        alt="{{ $cartItem->product->title }}">
                                </a>
                                <div class="media-body">
                                    <a href="#!">
                                        <h4>{{ $cartItem->product->title }}</h4>
                                    </a>
                                    <h4 class="quantity">
                                        <span>{{ $cartItem->quantity }} x ${{ number_format($cartItem->price,2) }}</span>
                                    </h4>
                                    <div class="qty-box">
                                        <div class="input-group qty-container">

                                                <a href="{{ route('cart.decrease',$cartItem->id) }}"
                                                class="btn qty-btn-minus">

                                                    <i class="ri-subtract-line"></i>
                                                </a>

                                                <input readonly class="form-control input-qty"
                                                value="{{ $cartItem->quantity }}">

                                            <a href="{{ route('cart.increase',$cartItem->id) }}"
                                                class="btn qty-btn-plus">

                                                <i class="ri-add-line"></i>

                                                </a>
                                        </div>
                                    </div>
                                    <div class="close-circle">
                                        <a href="{{ route('cart.remove',$cartItem->id) }}"
                                        class="close_button delete-button">

                                        <i class="ri-delete-bin-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <ul class="cart_total">
                    <li>
                        <div class="total">
                            <h5>Sub Total : <span>${{ number_format($cartTotal,2) }}</span>
                            </h5>
                        </div>
                    </li>
                    <li>
                        <div class="buttons">
                            <a href="{{ route('cart.index') }}" class="btn view-cart">View Cart</a>
                            <a href="{{ route('checkout.index') }}" class="btn checkout">Check Out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
