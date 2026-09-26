<header>
    <div class="top-header">
        <div class="mobile-fix-option"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-contact">
                        <ul>
                            <li>Welcome to Our store Multikart</li>
                            <li><i class="ri-phone-fill"></i>Call Us: 123 - 456 - 7890</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 text-end">
                    <ul class="header-dropdown">
                        <li class="mobile-wishlist"><a href="#!"><i class="ri-heart-fill"></i></a>
                        </li>
                        <li class="onhover-dropdown mobile-account"> <i class="ri-user-fill"></i>
                            My Account
                            <ul class="onhover-show-div">
                                <li><a href="{{ Auth::check() ? route('admin.dashboard') : route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">register</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-menu">
                    <div class="menu-left">
                        <div class="navbar">
                            <a href="#!" onclick="openNav()">
                                <div class="bar-style"><i class="ri-bar-chart-horizontal-line sidebar-bar"></i>
                                </div>
                            </a>
                            <div id="mySidenav" class="sidenav">
                                <a href="#!" class="sidebar-overlay" onclick="closeNav()"></a>
                                <nav>
                                    <div onclick="closeNav()">
                                        <div class="sidebar-back text-start"><i
                                                class="ri-arrow-left-s-line pe-2"></i>
                                            Back</div>
                                    </div>

                                    <ul id="sub-menu" class="sm pixelstrap sm-vertical">

                                        @forelse ($menuCategories as $category)

                                            <li>
                                                <a href="{{ route('shop', [
                                                    'type' => $category->menu_type,
                                                    'category' => $category->id
                                                ]) }}">
                                                    {{ $category->name }}
                                                </a>

                                                @if ($category->subcategories->count())
                                                    <ul>

                                                        @foreach ($category->subcategories as $subcategory)

                                                            <li>
                                                                <a href="{{ route('shop', [
                                                                    'type' => $category->menu_type,
                                                                    'category' => $category->id,
                                                                    'subcategory' => $subcategory->id
                                                                ]) }}">
                                                                    {{ $subcategory->name }}
                                                                </a>
                                                            </li>

                                                        @endforeach

                                                    </ul>
                                                @endif

                                            </li>

                                        @empty

                                            <li>
                                                <a href="#!">No Categories Available</a>
                                            </li>

                                        @endforelse

                                    </ul>


                                </nav>
                            </div>
                        </div>
                        <div class="brand-logo">
                            <a href="index.html">
                                <img src="assets/images/logo.png" class="img-fluid blur-up lazyload" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="menu-right pull-right">
                        <div>
                            <nav id="main-nav">
                                <div class="toggle-nav"><i class="ri-bar-chart-horizontal-line sidebar-bar"></i>
                                </div>
                                <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                    <li class="mobile-box">
                                        <div class="mobile-back text-end">Menu<i class="ri-close-line"></i></div>
                                    </li>
                                    <li><a href="{{ route('home') }}">Home</a></li>

                                    <li class="mega hover-cls">

                                <a href="javascript:void(0)"> feature
                                    <div class="lable-nav">new</div>
                                </a>

                                        <ul class="mega-menu full-mega-menu">
                                            <li>
                                                <div class="container">

                                                    @php
                                                        /*
                                                        |--------------------------------------------------------------------------
                                                        | Keep Multikart's original 6-column mega menu structure
                                                        |--------------------------------------------------------------------------
                                                        */

                                                        $featureColumns = [
                                                            collect(),
                                                            collect(),
                                                            collect(),
                                                            collect(),
                                                            collect(),
                                                            collect(),
                                                        ];

                                                        /*
                                                        |--------------------------------------------------------------------------
                                                        | Distribute Feature Categories across the 6 columns
                                                        |--------------------------------------------------------------------------
                                                        */

                                                        foreach ($featureCategories as $index => $featureCategory) {
                                                            $columnIndex = $index % 6;

                                                            $featureColumns[$columnIndex]->push(
                                                                $featureCategory
                                                            );
                                                        }
                                                    @endphp

                                                    <div class="row g-xl-4 g-0">

                                                        {{-- COLUMN 1 --}}
                                                        <div class="col mega-box">
                                                            <div class="link-section">

                                                                @foreach ($featureColumns[0] as $featureCategory)

                                                                    <div class="menu-title">
                                                                        <h5>
                                                                            {{ $featureCategory->name }}
                                                                        </h5>
                                                                    </div>

                                                                    <div class="menu-content">
                                                                        <ul>

                                                                            @foreach ($featureCategory->features as $feature)

                                                                                <li>
                                                                                    <a href="{{ $feature->url ?: '#!' }}">

                                                                                        {{ $feature->title }}

                                                                                        @if ($feature->icon)
                                                                                            <i class="ms-2 {{ $feature->icon }}"></i>
                                                                                        @endif

                                                                                        @if ($feature->badge)
                                                                                            <span class="new-tag">
                                                                                                {{ $feature->badge }}
                                                                                            </span>
                                                                                        @endif

                                                                                    </a>
                                                                                </li>

                                                                            @endforeach

                                                                        </ul>
                                                                    </div>

                                                                @endforeach

                                                            </div>
                                                        </div>


                                                        {{-- COLUMN 2 --}}
                                                        <div class="col mega-box">
                                                            <div class="link-section">

                                                                @foreach ($featureColumns[1] as $featureCategory)

                                                                    <div class="menu-title">
                                                                        <h5>
                                                                            {{ $featureCategory->name }}
                                                                        </h5>
                                                                    </div>

                                                                    <div class="menu-content">
                                                                        <ul>

                                                                            @foreach ($featureCategory->features as $feature)

                                                                                <li>
                                                                                    <a href="{{ $feature->url ?: '#!' }}">

                                                                                        {{ $feature->title }}

                                                                                        @if ($feature->icon)
                                                                                            <i class="ms-2 {{ $feature->icon }}"></i>
                                                                                        @endif

                                                                                        @if ($feature->badge)
                                                                                            <span class="new-tag">
                                                                                                {{ $feature->badge }}
                                                                                            </span>
                                                                                        @endif

                                                                                    </a>
                                                                                </li>

                                                                            @endforeach

                                                                        </ul>
                                                                    </div>

                                                                @endforeach

                                                            </div>
                                                        </div>


                                                        {{-- COLUMN 3 --}}
                                                        <div class="col mega-box">
                                                            <div class="link-section">

                                                                @foreach ($featureColumns[2] as $featureCategory)

                                                                    <div class="menu-title">
                                                                        <h5>
                                                                            {{ $featureCategory->name }}
                                                                        </h5>
                                                                    </div>

                                                                    <div class="menu-content">
                                                                        <ul>

                                                                            @foreach ($featureCategory->features as $feature)

                                                                                <li>
                                                                                    <a href="{{ $feature->url ?: '#!' }}">

                                                                                        {{ $feature->title }}

                                                                                        @if ($feature->icon)
                                                                                            <i class="ms-2 {{ $feature->icon }}"></i>
                                                                                        @endif

                                                                                        @if ($feature->badge)
                                                                                            <span class="new-tag">
                                                                                                {{ $feature->badge }}
                                                                                            </span>
                                                                                        @endif

                                                                                    </a>
                                                                                </li>

                                                                            @endforeach

                                                                        </ul>
                                                                    </div>

                                                                @endforeach

                                                            </div>
                                                        </div>


                                                        {{-- COLUMN 4 --}}
                                                        <div class="col mega-box">
                                                            <div class="link-section">

                                                                @foreach ($featureColumns[3] as $featureCategory)

                                                                    <div class="menu-title">
                                                                        <h5>
                                                                            {{ $featureCategory->name }}
                                                                        </h5>
                                                                    </div>

                                                                    <div class="menu-content">
                                                                        <ul>

                                                                            @foreach ($featureCategory->features as $feature)

                                                                                <li>
                                                                                    <a href="{{ $feature->url ?: '#!' }}">

                                                                                        {{ $feature->title }}

                                                                                        @if ($feature->icon)
                                                                                            <i class="ms-2 {{ $feature->icon }}"></i>
                                                                                        @endif

                                                                                        @if ($feature->badge)
                                                                                            <span class="new-tag">
                                                                                                {{ $feature->badge }}
                                                                                            </span>
                                                                                        @endif

                                                                                    </a>
                                                                                </li>

                                                                            @endforeach

                                                                        </ul>
                                                                    </div>

                                                                @endforeach

                                                            </div>
                                                        </div>


                                                        {{-- COLUMN 5 --}}
                                                        <div class="col mega-box">
                                                            <div class="link-section">

                                                                @foreach ($featureColumns[4] as $featureCategory)

                                                                    <div class="menu-title">
                                                                        <h5>
                                                                            {{ $featureCategory->name }}
                                                                        </h5>
                                                                    </div>

                                                                    <div class="menu-content">
                                                                        <ul>

                                                                            @foreach ($featureCategory->features as $feature)

                                                                                <li>
                                                                                    <a href="{{ $feature->url ?: '#!' }}">

                                                                                        {{ $feature->title }}

                                                                                        @if ($feature->icon)
                                                                                            <i class="ms-2 {{ $feature->icon }}"></i>
                                                                                        @endif

                                                                                        @if ($feature->badge)
                                                                                            <span class="new-tag">
                                                                                                {{ $feature->badge }}
                                                                                            </span>
                                                                                        @endif

                                                                                    </a>
                                                                                </li>

                                                                            @endforeach

                                                                        </ul>
                                                                    </div>

                                                                @endforeach

                                                            </div>
                                                        </div>


                                                        {{-- COLUMN 6 --}}
                                                        <div class="col mega-box">
                                                            <div class="link-section">

                                                                @foreach ($featureColumns[5] as $featureCategory)

                                                                    <div class="menu-title">
                                                                        <h5>
                                                                            {{ $featureCategory->name }}
                                                                        </h5>
                                                                    </div>

                                                                    <div class="menu-content">
                                                                        <ul>

                                                                            @foreach ($featureCategory->features as $feature)

                                                                                <li>
                                                                                    <a href="{{ $feature->url ?: '#!' }}">

                                                                                        {{ $feature->title }}

                                                                                        @if ($feature->icon)
                                                                                            <i class="ms-2 {{ $feature->icon }}"></i>
                                                                                        @endif

                                                                                        @if ($feature->badge)
                                                                                            <span class="new-tag">
                                                                                                {{ $feature->badge }}
                                                                                            </span>
                                                                                        @endif

                                                                                    </a>
                                                                                </li>

                                                                            @endforeach

                                                                        </ul>
                                                                    </div>

                                                                @endforeach

                                                            </div>
                                                        </div>

                                                    </div>


                                                    {{-- Multikart original bottom banner --}}
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <img
                                                                src="{{ asset('assets/images/menu-banner.jpg') }}"
                                                                alt=""
                                                                class="img-fluid mega-img d-xl-block d-none"
                                                            >
                                                        </div>
                                                    </div>

                                                </div>
                                            </li>
                                        </ul>

                                    </li>


                                    <li class="mega hover-cls">

                                        <a href="javascript:void(0)">product</a>

                                        <ul class="mega-menu full-mega-menu">

                                            <li>

                                                <div class="container">

                                                    <div class="row g-xl-4 g-0">

                                                        @php
                                                            /*
                                                            |--------------------------------------------------------------------------
                                                            | Split categories into 6 columns
                                                            |--------------------------------------------------------------------------
                                                            */

                                                            $menuColumns = $menuCategories->chunk(
                                                                ceil($menuCategories->count() / 6)
                                                            );
                                                        @endphp


                                                        @forelse ($menuColumns as $column)

                                                            <div class="col mega-box">

                                                                <div class="link-section">

                                                                    @foreach ($column as $category)

                                                                        <div class="menu-title">

                                                                            <h5>
                                                                                {{ $category->name }}
                                                                            </h5>

                                                                        </div>


                                                                        <div class="menu-content">

                                                                            <ul>

                                                                                @forelse ($category->subcategories as $subcategory)

                                                                                    <li>

                                                                                        <a href="{{ route('shop', [
                                                                                            'type' => $category->menu_type,
                                                                                            'category' => $category->id,
                                                                                            'subcategory' => $subcategory->id
                                                                                        ]) }}">

                                                                                            {{ $subcategory->name }}

                                                                                        </a>

                                                                                    </li>

                                                                                @empty

                                                                                    <li>

                                                                                        <a href="{{ route('shop', [
                                                                                            'type' => $category->menu_type,
                                                                                            'category' => $category->id
                                                                                        ]) }}">

                                                                                            View Products

                                                                                        </a>

                                                                                    </li>

                                                                                @endforelse

                                                                            </ul>

                                                                        </div>

                                                                    @endforeach

                                                                </div>

                                                            </div>

                                                        @empty

                                                            <div class="col-12">

                                                                <div class="link-section">

                                                                    <div class="menu-title">

                                                                        <h5>
                                                                            No Categories Available
                                                                        </h5>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        @endforelse

                                                    </div>


                                                    {{-- Multikart original bottom banner --}}

                                                    <div class="row">

                                                        <div class="col-12">

                                                            <img src="{{ asset('assets/images/menu-banner.jpg') }}"
                                                                alt=""
                                                                class="img-fluid mega-img d-xl-block d-none">

                                                        </div>

                                                    </div>

                                                </div>

                                            </li>

                                        </ul>

                                    </li>

                                    <li><a href="#!">pages</a>
                                        <ul>
                                            <li>
                                                <a href="#!">vendor</a>
                                                <ul>
                                                    <li><a href="{{ route('vendor.dashboard') }}">vendor dashboard</a>
                                                    </li>
                                                    <li><a href="{{ route('vendor.profile') }}">vendor profile</a></li>
                                                    <li><a href="become-vendor.html">become vendor</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#!">account</a>
                                                <ul>
                                                    <li><a href="{{ route('wishlist.index') }}">wishlist</a></li>
                                                    <li><a href="{{ route('cart.index') }}">cart</a></li>
                                                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                                    <li><a href="{{ route('login') }}">login</a></li>
                                                    <li><a href="{{ route('register') }}">register</a></li>
                                                    <li><a href="{{ route('contact.index') }}">contact</a></li>
                                                    <li><a href="{{ route('password.request') }}">forget password</a></li>
                                                    <li><a href="{{ route('admin.account.setting') }}">profile</a></li>
                                                    <li><a href="{{ route('checkout.index') }}">checkout</a></li>
                                                        @if (isset($order) && $order)
                                                    <li>
                                                        <a href="{{ route('order.success', $order->id) }}">
                                                            order success
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('order.tracking', $order->id) }}">
                                                            order tracking
                                                            <span class="new-tag">new</span>
                                                        </a>
                                                    </li>
                                                @endif
                                                </ul>
                                            </li>
                                            <li><a href="about-page.html">about us</a></li>
                                            <li><a href="{{ route('search') }}">search</a></li>
                                            <li><a href="review.html">review</a>
                                            </li>
                                            <li>
                                                <a href="#!">compare</a>
                                                <ul>
                                                    <li><a href="{{ route('compare.index') }}">compare</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div>
                            <div class="icon-nav">
                                <ul>
                                    <li class="onhover-div mobile-search">
                                        <div data-bs-toggle="modal" data-bs-target="#searchModal">
                                            <i class="ri-search-line"></i>
                                        </div>
                                    </li>

                                    {{-- **Language** --}}
                                    {{-- <li class="onhover-div mobile-setting">
                                        <div><i class="ri-equalizer-2-line"></i></div>
                                        <div class="show-div setting">
                                            <h6>language</h6>
                                            <ul>
                                                <li><a href="#!">english</a></li>
                                                <li><a href="#!">french</a></li>
                                            </ul>
                                            <h6>currency</h6>
                                            <ul class="list-inline">
                                                <li><a href="#!">euro</a></li>
                                                <li><a href="#!">rupees</a></li>
                                                <li><a href="#!">pound</a></li>
                                                <li><a href="#!">dollar</a></li>
                                            </ul>
                                        </div>
                                    </li> --}}
                                        <li class="onhover-div mobile-cart">

                                            <div
                                                style="cursor:pointer"
                                                data-bs-toggle="offcanvas"
                                                data-bs-target="#cartOffcanvas">

                                                <i class="ri-shopping-cart-line"></i>

                                                @if($cartCount)
                                                    <span class="cart_qty_cls">
                                                        {{ $cartCount }}
                                                    </span>
                                                @endif

                                            </div>

                                        </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
