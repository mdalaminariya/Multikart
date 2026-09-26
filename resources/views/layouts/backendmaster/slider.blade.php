@php
    $latestOrder = \App\Models\Order::latest()->first();
    $userRole = auth()->user()->role;
@endphp

<div class="page-sidebar">

    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper">
            <a href="{{ route('home') }}">
                <img class="d-none d-lg-block blur-up lazyloaded"
                    src="{{ asset('backend') }}/assets/images/dashboard/multikart-logo.png"
                    alt="">
            </a>
        </div>
    </div>

    <div class="sidebar custom-scrollbar">

        <a href="javascript:void(0)" class="sidebar-back d-lg-none d-block">
            <i class="fa fa-times" aria-hidden="true"></i>
        </a>

        <ul class="sidebar-menu">

            {{-- Dashboard --}}
            <li>
                <a class="sidebar-header" href="{{ route('admin.dashboard') }}">
                    <i data-feather="home"></i>
                    <span>Dashboard</span>
                </a>
            </li>


            {{-- ========================================================= --}}
            {{-- PRODUCTS --}}
            {{-- Admin + Manager + Vendor --}}
            {{-- ========================================================= --}}
            @if (in_array($userRole, ['admin', 'manager', 'vendor']))

                <li>
                    <a class="sidebar-header" href="javascript:void(0)">
                        <i data-feather="box"></i>
                        <span>Products</span>
                        <i class="fa fa-angle-right pull-right"></i>
                    </a>

                    <ul class="sidebar-submenu">

                        {{-- Physical --}}
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fa fa-circle"></i>
                                <span>Physical</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>

                            <ul class="sidebar-submenu">

                                <li>
                                    <a href="{{ route('admin.category.index') }}">
                                        <i class="fa fa-circle"></i>
                                        Category
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('admin.subcategory.index') }}">
                                        <i class="fa fa-circle"></i>
                                        Sub Category
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('admin.product.view') }}">
                                        <i class="fa fa-circle"></i>
                                        Product List
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('admin.product.index') }}">
                                        <i class="fa fa-circle"></i>
                                        Add Product
                                    </a>
                                </li>

                            </ul>
                        </li>


                        {{-- Digital --}}
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fa fa-circle"></i>
                                <span>Digital</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>

                            <ul class="sidebar-submenu">

                                <li>
                                    <a href="{{ route('admin.digital.category.index') }}">
                                        <i class="fa fa-circle"></i>
                                        Category
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('admin.digital.subcategory.index') }}">
                                        <i class="fa fa-circle"></i>
                                        Sub Category
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('admin.digital.productlist.view') }}">
                                        <i class="fa fa-circle"></i>
                                        Product List
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('admin.digital.product.index') }}">
                                        <i class="fa fa-circle"></i>
                                        Add Product
                                    </a>
                                </li>

                            </ul>
                        </li>


                        {{-- Product Review --}}
                        <li>
                            <a href="product-review.html">
                                <i class="fa fa-circle"></i>
                                <span>Product Review</span>
                            </a>
                        </li>

                    </ul>
                </li>

            @endif


            {{-- ========================================================= --}}
            {{-- ORDERS --}}
            {{-- Admin + Manager only --}}
            {{-- ========================================================= --}}
            @if (in_array($userRole, ['admin', 'manager']))

                <li>
                    <a class="sidebar-header" href="javascript:void(0)">
                        <i data-feather="archive"></i>
                        <span>Orders</span>
                        <i class="fa fa-angle-right pull-right"></i>
                    </a>

                    <ul class="sidebar-submenu">

                        <li>
                            <a href="{{ route('admin.orders.list') }}">
                                <i class="fa fa-circle"></i>
                                <span>Order List</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.orders.tracking.list') }}">
                                <i class="fa fa-circle"></i>
                                <span>Order Tracking</span>
                            </a>
                        </li>

                        @if ($latestOrder)
                            <li>
                                <a href="{{ route('admin.orders.details', $latestOrder->id) }}">
                                    <i class="fa fa-circle"></i>
                                    <span>Order Details</span>
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>

            @endif


            {{-- ========================================================= --}}
            {{-- SALES --}}
            {{-- Admin + Manager only --}}
            {{-- ========================================================= --}}
            @if (in_array($userRole, ['admin', 'manager']))

                <li>
                    <a class="sidebar-header" href="javascript:void(0)">
                        <i data-feather="dollar-sign"></i>
                        <span>Sales</span>
                        <i class="fa fa-angle-right pull-right"></i>
                    </a>

                    <ul class="sidebar-submenu">

                        <li>
                            <a href="{{ route('admin.sales.orders') }}">
                                <i class="fa fa-circle"></i>
                                Orders
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.sales.transaction') }}">
                                <i class="fa fa-circle"></i>
                                Transactions
                            </a>
                        </li>

                    </ul>
                </li>

            @endif


            {{-- ========================================================= --}}
            {{-- COUPONS --}}
            {{-- Admin + Manager only --}}
            {{-- ========================================================= --}}
            @if (in_array($userRole, ['admin', 'manager']))

                <li>
                    <a class="sidebar-header" href="javascript:void(0)">
                        <i data-feather="tag"></i>
                        <span>Coupons</span>
                        <i class="fa fa-angle-right pull-right"></i>
                    </a>

                    <ul class="sidebar-submenu">

                        <li>
                            <a href="{{ route('admin.coupons.index') }}">
                                <i class="fa fa-circle"></i>
                                List Coupons
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.coupons.create') }}">
                                <i class="fa fa-circle"></i>
                                Create Coupons
                            </a>
                        </li>

                    </ul>
                </li>

            @endif



            {{-- ========================================================= --}}
            {{-- USERS --}}
            {{-- Admin + Manager --}}
            {{-- ========================================================= --}}
            @if (in_array($userRole, ['admin', 'manager']))

                <li>
                    <a class="sidebar-header" href="javascript:void(0)">
                        <i data-feather="user-plus"></i>
                        <span>Users</span>
                        <i class="fa fa-angle-right pull-right"></i>
                    </a>

                    <ul class="sidebar-submenu">

                        <li>
                            <a href="{{ route('admin.users.list') }}">
                                <i class="fa fa-circle"></i>
                                User List
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.users.view') }}">
                                <i class="fa fa-circle"></i>
                                Create User
                            </a>
                        </li>

                    </ul>
                </li>

            @endif


            {{-- ========================================================= --}}
            {{-- VENDORS --}}
            {{-- Admin + Manager --}}
            {{-- ========================================================= --}}
            @if (in_array($userRole, ['admin', 'manager']))

                <li>
                    <a class="sidebar-header" href="javascript:void(0)">
                        <i data-feather="users"></i>
                        <span>Vendors</span>
                        <i class="fa fa-angle-right pull-right"></i>
                    </a>

                    <ul class="sidebar-submenu">

                        <li>
                            <a href="{{ route('admin.vendors.list') }}">
                                <i class="fa fa-circle"></i>
                                Vendor List
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.vendors.create') }}">
                                <i class="fa fa-circle"></i>
                                Create Vendor
                            </a>
                        </li>

                    </ul>
                </li>

            @endif


            {{-- ========================================================= --}}
            {{-- VENDOR PROFILE --}}
            {{-- Vendor only --}}
            {{-- ========================================================= --}}
            {{-- @if ($userRole === 'vendor')

                <li>
                    <a class="sidebar-header" href="{{ route('vendor.profile') }}">
                        <i data-feather="user"></i>
                        <span>Store Profile</span>
                    </a>
                </li>

            @endif --}}

            {{-- Reports --}}
            @if (in_array($userRole, ['admin', 'manager']))

                <li>
                    <a class="sidebar-header" href="{{ route('admin.reports.index') }}">
                        <i data-feather="bar-chart"></i>
                        <span>Reports</span>
                    </a>
                </li>

            @endif


            {{-- ========================================================= --}}
            {{-- SETTINGS --}}
            {{-- Admin + Manager --}}
            {{-- ========================================================= --}}
            @if (in_array($userRole, ['admin', 'manager']))

                <li>
                    <a class="sidebar-header" href="javascript:void(0)">
                        <i data-feather="settings"></i>
                        <span>Settings</span>
                        <i class="fa fa-angle-right pull-right"></i>
                    </a>

                    <ul class="sidebar-submenu">

                        <li>
                            <a href="{{ route('admin.account.setting') }}">
                                <i class="fa fa-circle"></i>
                                Profile
                            </a>
                        </li>

                    </ul>
                </li>

            @endif


            {{-- Forgot Password --}}
            <li>
                <a class="sidebar-header" href="{{ route('password.request') }}">
                    <i data-feather="key"></i>
                    <span>Forgot Password</span>
                </a>
            </li>


            {{-- Login --}}
            @if(auth()->user()->role == 'user')
                <li>
                    <a class="sidebar-header" href="{{ route('dashboard') }}">
                        <i data-feather="log-in"></i>
                        <span>Login</span>
                    </a>
                </li>
                @elseif (auth()->user()->role == 'vendor')
                <li>
                    <a class="sidebar-header" href="{{ route('vendor.dashboard') }}">
                        <i data-feather="log-in"></i>
                        <span>Vendor Login</span>
                    </a>
                </li>
                @endif

        </ul>
    </div>
</div>
