
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="multikart">
    <meta name="keywords" content="multikart">
    <meta name="author" content="multikart">
    <link rel="icon" href="{{ asset('frontend') }}/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('frontend') }}/assets/images/favicon.png" type="image/x-icon">
    <title>Multikart - Multi-purpose E-commerce Html Template</title>

    <!--Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/assets/css/vendors/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/assets/css/vendors/remixicon.css">

    <!-- Slick slider css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/assets/css/vendors/slick.css">

    <!-- Animate icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/assets/css/vendors/animate.css">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/assets/css/vendors/themify-icons.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/assets/css/vendors/bootstrap.css">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/assets/css/style.css">

    <!-- CSS Toastify -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <style>
        .address-book-section .address-box{
    background: #fff;
    padding: 20px;
    border: 1px solid #eee;
    border-radius: 5px;
    height: 100%;
}

.address-box .btn-solid{
    background: #ea8a4a;
    color: #fff;
    border: none;
    padding: 6px 15px;
    font-size: 13px;
    border-radius: 0;
}

.address-box .address p,
.address-box .number p{
    margin-bottom: 5px;
    color: #555;
    line-height: 1.5;
}

.address-box .btn-light{
    background: #f5f5f5;
    border: 1px solid #eee;
    font-weight: 600;
}

.address-box .btn-light:hover{
    background: #eee;
}
    </style>

</head>

<body class="theme-color-1">


<!-- loader start -->
    @include('layouts.frontendmaster.loader')
<!-- loader end -->


<!-- header start -->
    @include('layouts.frontendmaster.header')
<!-- header end -->

    @yield('content')

    {{-- Cart Sidebar --}}
    @include('frontend.carts.cart')

<!-- Footer Section Start -->
    @include('layouts.frontendmaster.footer')
<!-- Footer Section End -->

<!-- Search Modal Start -->
    <div class="modal fade search-modal theme-modal-2" id="searchModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5">Search in store</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="ri-close-line"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="search-input-box">
                    <input type="text" class="form-control" placeholder="Search with brands and categories...">
                    <i class="ri-search-2-line"></i>
                </div>

                <ul class="search-category">
                    <li class="category-title">Top search:</li>
                    <li>
                        <a href="category-page.html">Baby Essentials</a>
                    </li>
                    <li>
                        <a href="category-page.html">Bag Emporium</a>
                    </li>
                    <li>
                        <a href="category-page.html">Bags</a>
                    </li>
                    <li>
                        <a href="category-page.html">Books</a>
                    </li>
                </ul>

                <div class="search-product-box mt-sm-4 mt-3">
                    <h3 class="search-title">Most Searched</h3>

                    <div class="row row-cols-xl-4 row-cols-md-3 row-cols-2 g-sm-4 g-3">
                        <div class="col">
                            <div class="basic-product theme-product-1">
                                <div class="overflow-hidden">
                                    <div class="img-wrapper">
                                        <div class="ribbon"><span>Exclusive</span></div>
                                        <a href="product-page(image-swatch).html">
                                            <img src="assets/images/fashion-1/product/1.jpg"
                                                 class="img-fluid blur-up lazyloaded" alt="">
                                        </a>
                                        <div class="rating-label"><i class="ri-star-fill"></i><span>2.5</span>
                                        </div>
                                        <div class="cart-info">
                                            <a href="#!" title="Add to Wishlist" class="wishlist-icon">
                                                <i class="ri-heart-line"></i>
                                            </a>
                                            <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart">
                                                <i class="ri-shopping-cart-line"></i>
                                            </button>
                                            <a href="#!" data-bs-toggle="modal" data-bs-target="#quickView"
                                               title="Quick View">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <a href="compare.html" title="Compare">
                                                <i class="ri-loop-left-line"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-detail">
                                        <div>
                                            <div class="brand-w-color">
                                                <a class="product-title" href="product-page(accordian).html">
                                                    Glamour Gaze
                                                </a>
                                                <div class="color-panel">
                                                    <ul>
                                                        <li style="background-color: papayawhip;"></li>
                                                        <li style="background-color: burlywood;"></li>
                                                        <li style="background-color: gainsboro;"></li>
                                                    </ul>
                                                    <span>+2</span>
                                                </div>
                                            </div>
                                            <h6>Boyfriend Shirts</h6>
                                            <h4 class="price">$ 2.79<del> $3.00 </del><span
                                                    class="discounted-price"> 7%
                                                        Off
                                                    </span>
                                            </h4>
                                        </div>
                                        <ul class="offer-panel">
                                            <li>
                                                    <span class="offer-icon">
                                                        <i class="ri-discount-percent-fill"></i>
                                                    </span>
                                                Limited Time Offer: 4% off
                                            </li>
                                            <li><span class="offer-icon"><i
                                                        class="ri-discount-percent-fill"></i></span>
                                                Limited Time Offer: 4% off</li>
                                            <li><span class="offer-icon"><i
                                                        class="ri-discount-percent-fill"></i></span>
                                                Limited Time Offer: 4% off</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="basic-product theme-product-1">
                                <div class="overflow-hidden">
                                    <div class="img-wrapper">
                                        <a href="product-page(accordian).html"><img
                                                src="assets/images/fashion-1/product/11.jpg"
                                                class="img-fluid blur-up lazyloaded" alt=""></a>
                                        <div class="rating-label"><i class="ri-star-s-fill"></i>
                                            <span>6.5</span>
                                        </div>
                                        <div class="cart-info">
                                            <a href="#!" title="Add to Wishlist" class="wishlist-icon">
                                                <i class="ri-heart-line"></i>
                                            </a>
                                            <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart">
                                                <i class="ri-shopping-cart-line"></i>
                                            </button>
                                            <a href="#!" data-bs-toggle="modal" data-bs-target="#quickView"
                                               title="Quick View">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <a href="compare.html" title="Compare">
                                                <i class="ri-loop-left-line"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-detail">
                                        <div>
                                            <div class="brand-w-color">
                                                <a class="product-title" href="product-page(accordian).html">
                                                    VogueVista
                                                </a>
                                            </div>
                                            <h6>Chic Crop Top</h6>
                                            <h4 class="price">$ 5.60<del> $6.80 </del><span
                                                    class="discounted-price"> 5%
                                                        Off
                                                    </span>
                                            </h4>
                                        </div>
                                        <ul class="offer-panel">
                                            <li><span class="offer-icon"><i
                                                        class="ri-discount-percent-fill"></i></span>
                                                Limited Time Offer: 25% off</li>
                                            <li><span class="offer-icon"><i
                                                        class="ri-discount-percent-fill"></i></span>
                                                Limited Time Offer: 25% off</li>
                                            <li><span class="offer-icon"><i
                                                        class="ri-discount-percent-fill"></i></span>
                                                Limited Time Offer: 25% off</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="basic-product theme-product-1">
                                <div class="overflow-hidden">
                                    <div class="img-wrapper">
                                        <a href="product-page(accordian).html"><img
                                                src="assets/images/fashion-1/product/15.jpg"
                                                class="img-fluid blur-up lazyloaded" alt=""></a>
                                        <div class="rating-label"><i class="ri-star-s-fill"></i>
                                            <span>3.7</span>
                                        </div>
                                        <div class="cart-info">
                                            <a href="#!" title="Add to Wishlist" class="wishlist-icon">
                                                <i class="ri-heart-line"></i>
                                            </a>
                                            <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart">
                                                <i class="ri-shopping-cart-line"></i>
                                            </button>
                                            <a href="#!" data-bs-toggle="modal" data-bs-target="#quickView"
                                               title="Quick View">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <a href="compare.html" title="Compare">
                                                <i class="ri-loop-left-line"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-detail">
                                        <div>
                                            <div class="brand-w-color">
                                                <a class="product-title" href="product-page(accordian).html">
                                                    Urban Chic
                                                </a>
                                            </div>
                                            <h6>Classic Jacket</h6>
                                            <h4 class="price">$ 3.80 </h4>
                                        </div>
                                        <ul class="offer-panel">
                                            <li><span class="offer-icon"><i
                                                        class="ri-discount-percent-fill"></i></span>
                                                Limited Time Offer: 10% off</li>
                                            <li><span class="offer-icon"><i
                                                        class="ri-discount-percent-fill"></i></span>
                                                Limited Time Offer: 10% off</li>
                                            <li><span class="offer-icon"><i
                                                        class="ri-discount-percent-fill"></i></span>
                                                Limited Time Offer: 10% off</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="basic-product theme-product-1">
                                <div class="overflow-hidden">
                                    <div class="img-wrapper">
                                        <a href="product-page(image-swatch).html">
                                            <img src="assets/images/fashion-1/product/16.jpg"
                                                 class="img-fluid blur-up lazyloaded" alt="">
                                        </a>
                                        <div class="rating-label"><i class="ri-star-s-fill"></i>
                                            <span>8.7</span>
                                        </div>
                                        <div class="cart-info">
                                            <a href="#!" title="Add to Wishlist" class="wishlist-icon">
                                                <i class="ri-heart-line"></i>
                                            </a>
                                            <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart">
                                                <i class="ri-shopping-cart-line"></i>
                                            </button>
                                            <a href="#!" data-bs-toggle="modal" data-bs-target="#quickView"
                                               title="Quick View">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <a href="compare.html" title="Compare">
                                                <i class="ri-loop-left-line"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-detail">
                                        <div>
                                            <div class="brand-w-color">
                                                <a class="product-title" href="product-page(accordian).html">
                                                    Couture Edge
                                                </a>
                                            </div>
                                            <h6>Versatile Shacket</h6>
                                            <h4 class="price"> $3.00
                                            </h4>
                                        </div>
                                        <ul class="offer-panel">
                                            <li><span class="offer-icon"><i
                                                        class="ri-discount-percent-fill"></i></span>
                                                Limited Time Offer: 12% off</li>
                                            <li><span class="offer-icon"><i
                                                        class="ri-discount-percent-fill"></i></span>
                                                Limited Time Offer: 12% off</li>
                                            <li><span class="offer-icon"><i
                                                        class="ri-discount-percent-fill"></i></span>
                                                Limited Time Offer: 12% off</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Modal End -->


<!-- cookie bar start -->
<div class="cookie-bar">
    <p>We use cookies to improve our site and your shopping experience. By continuing to browse our site you accept
        our cookie policy.</p>
    <a href="#!" class="btn btn-solid btn-xs">accept</a>
    <a href="#!" class="btn btn-solid btn-xs">decline</a>
</div>
<!-- cookie bar end -->

<!--modal popup start-->
<div class="modal fade bd-example-modal-lg theme-modal" id="exampleModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
             <div class="modal-body modal1">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="modal-bg">
                                <button type="button" class="btn-close"
                                        data-bs-dismiss="modal"><span>&times;</span></button>
                                <div class="offer-content"> <img src="assets/images/Offer-banner.png"
                                                                 class="img-fluid blur-up lazyload" alt="">
                                    <h2>newsletter</h2>
                                    <form
                                        action="https://pixelstrap.us19.list-manage.com/subscribe/post?u=5a128856334b598b395f1fc9b&amp;id=082f74cbda"
                                        class="auth-form needs-validation" method="post"
                                        id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
                                        target="_blank">
                                        <div class="form-group mx-sm-3">
                                            <input type="email" class="form-control" name="EMAIL" id="mce-EMAIL"
                                                   placeholder="Enter your email" required="required">
                                            <button type="submit" class="btn btn-solid"
                                                    id="mc-submit">subscribe</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--modal popup end-->


<!-- Quick-view modal popup start-->
    @include('layouts.frontendmaster.quickview')
<!-- Quick-view modal popup end-->


<!-- theme setting start -->
    @include('layouts.frontendmaster.themesetting')
<!-- theme setting end -->

<!-- exit modal popup start-->
<div class="modal fade bd-example-modal-lg theme-modal exit-modal" id="exit_popup" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body modal1">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="modal-bg">
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    <i class="ri-close-line"></i>
                                </button>
                                <div class="media">
                                    <img src="assets/images/stop.png"
                                         class="stop img-fluid blur-up lazyload me-3" alt="">
                                    <div class="media-body text-start align-self-center">
                                        <div>
                                            <h2>wait!</h2>
                                            <h4>We want to give you
                                                <b>10% discount</b>
                                                <span>for your first order</span>
                                            </h4>
                                            <h5>Use discount code at checkout</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- facebook chat section start -->
<!-- <div id="fb-root"></div>
    <script>
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src =
                'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script> -->
<!-- Your customer chat code -->
<!-- <div class="fb-customerchat" attribution=setup_tool page_id="2123438804574660" theme_color="#0084ff"
        logged_in_greeting="Hi! Welcome to PixelStrap Themes  How can we help you?"
        logged_out_greeting="Hi! Welcome to PixelStrap Themes  How can we help you?">
    </div> -->
<!-- facebook chat section end -->


<!-- tap to top -->
<div class="tap-top top-cls">
    <div>
        <i class="ri-arrow-up-double-line"></i>
    </div>
</div>
<!-- tap to top end -->


<!-- latest jquery-->
<script src="{{ asset('frontend') }}/assets/js/jquery-3.3.1.min.js"></script>

<!-- fly cart ui jquery-->
<script src="{{ asset('frontend') }}/assets/js/jquery-ui.min.js"></script>

<!-- exitintent jquery-->
<script src="{{ asset('frontend') }}/assets/js/jquery.exitintent.js"></script>
<script src="{{ asset('frontend') }}/assets/js/exit.js"></script>

<!-- slick js-->
<script src="{{ asset('frontend') }}/assets/js/slick.js"></script>

<!-- menu js-->
<script src="{{ asset('frontend') }}/assets/js/menu.js"></script>

<!-- lazyload js-->
<script src="{{ asset('frontend') }}/assets/js/lazysizes.min.js"></script>

<!-- Bootstrap js-->
<script src="{{ asset('frontend') }}/assets/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap Notification js-->
<script src="{{ asset('frontend') }}/assets/js/bootstrap-notify.min.js"></script>

<!-- Fly cart js-->
<script src="{{ asset('frontend') }}/assets/js/fly-cart.js"></script>

<!-- Theme js-->
<script src="{{ asset('frontend') }}/assets/js/theme-setting.js"></script>
<script src="{{ asset('frontend') }}/assets/js/script.js"></script>

{{-- Google reCAPTCHA --}}
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <!-- JS Toastify -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

{{--Newslater modal show once --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
  let hasSeenModal = sessionStorage.getItem("modalShown");

  if (!hasSeenModal) {
    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
    myModal.show();

    sessionStorage.setItem("modalShown", "true");
  }
});
</script>

</body>

</html>



