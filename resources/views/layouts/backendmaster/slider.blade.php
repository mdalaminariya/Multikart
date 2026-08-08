 @php
    $latestOrder = \App\Models\Order::latest()->first();
@endphp
 <div class="page-sidebar">
                <div class="main-header-left d-none d-lg-block">
                    <div class="logo-wrapper">
                        <a href="{{ route('home') }}">
                            <img class="d-none d-lg-block blur-up lazyloaded"
                                src="{{ asset('backend') }}/assets/images/dashboard/multikart-logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="sidebar custom-scrollbar">
                    <a href="javascript:void(0)" class="sidebar-back d-lg-none d-block"><i class="fa fa-times"
                            aria-hidden="true"></i></a>
                    <ul class="sidebar-menu">
                        <li>
                            <a class="sidebar-header" href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manager')

                        <li>
                                <a class="sidebar-header" href="javascript:void(0)">
                                    <i data-feather="box"></i>
                                    <span>Products</span>
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>

                                <ul class="sidebar-submenu">
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="fa fa-circle"></i>
                                            <span>Physical</span>
                                            <i class="fa fa-angle-right pull-right"></i>
                                        </a>

                                        <ul class="sidebar-submenu">
                                            <li>
                                                <a href="{{ route('admin.category.index') }}">
                                                    <i class="fa fa-circle"></i>Category
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route('admin.subcategory.index') }}">
                                                    <i class="fa fa-circle"></i>Sub Category</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('admin.product.view') }}">
                                                    <i class="fa fa-circle"></i>Product List</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('admin.product.index') }}">
                                                    <i class="fa fa-circle"></i>Add Product
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="fa fa-circle"></i>
                                            <span>Digital</span>
                                            <i class="fa fa-angle-right pull-right"></i>
                                        </a>

                                        <ul class="sidebar-submenu">
                                            <li>
                                                <a href="{{ route('admin.digital.category.index') }}">
                                                    <i class="fa fa-circle"></i>Category
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route('admin.digital.subcategory.index') }}">
                                                    <i class="fa fa-circle"></i>Sub Category
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route('admin.digital.product.view') }}">
                                                    <i class="fa fa-circle"></i>Product List
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route('admin.digital.product.index') }}">
                                                    <i class="fa fa-circle"></i>Add Product
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="product-review.html">
                                            <i class="fa fa-circle"></i>
                                            <span>product Review</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        @endif

                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="archive"></i>
                                <span>Orders</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>

                            <ul class="sidebar-submenu">
                             @if (auth()->user()->role == 'admin'||auth()->user()->role == 'manager')
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
                                    <li>
                                        @if($latestOrder)
                                            <a href="{{ route('admin.orders.details', $latestOrder->id) }}">
                                                <i class="fa fa-circle"></i>
                                                <span>Order Details</span>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)">
                                                <i class="fa fa-circle"></i>
                                                <span>Order Details</span>
                                            </a>
                                        @endif
                                    </li>
                                    @endif
                            </ul>
                        </li>

                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="dollar-sign"></i>
                                <span>Sales</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="order.html">
                                        <i class="fa fa-circle"></i>Orders
                                    </a>
                                </li>
                                <li>
                                    <a href="transactions.html">
                                        <i class="fa fa-circle"></i>Transactions
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="tag"></i>
                                <span>Coupons</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="{{ route('admin.coupons.index') }}">
                                        <i class="fa fa-circle"></i>List Coupons
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.coupons.create') }}">
                                        <i class="fa fa-circle"></i>Create Coupons
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="clipboard"></i>
                                <span>Pages</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="{{ route('admin.pages.index') }}">
                                        <i class="fa fa-circle"></i>List Page
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.pages.create') }}">
                                        <i class="fa fa-circle"></i>Create Page
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a class="sidebar-header" href="{{ route('admin.media.index') }}">
                                <i data-feather="camera"></i>
                                <span>Media</span>
                            </a>
                        </li>

                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="align-left"></i>
                                <span>Menus</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="{{ route('admin.menu.index') }}">
                                        <i class="fa fa-circle"></i>Menu Lists
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.menu.create') }}">
                                        <i class="fa fa-circle"></i>Create Menu
                                    </a>
                                </li>
                            </ul>
                        </li>

                  @if (auth()->user()->role == 'admin'||auth()->user()->role == 'manager')
                          <li>
                              <a class="sidebar-header" href="javascript:void(0)">
                                  <i data-feather="user-plus"></i>
                                  <span>Users</span>
                                  <i class="fa fa-angle-right pull-right"></i>
                              </a>
                              <ul class="sidebar-submenu">
                                  <li>
                                      <a href="{{ route('admin.users.list') }}">
                                          <i class="fa fa-circle"></i>User List
                                      </a>
                                  </li>
                                  <li>
                                      <a href="{{ route('admin.users.view') }}">
                                          <i class="fa fa-circle"></i>Create User
                                      </a>
                                  </li>
                              </ul>
                          </li>
                  @endif

                        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manager')
                            <li>
                                <a class="sidebar-header" href="javascript:void(0)">
                                    <i data-feather="users"></i>
                                    <span>Vendors</span>
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                                <ul class="sidebar-submenu">
                                    <li>
                                        <a href="{{ route('admin.vendors.list') }}">
                                            <i class="fa fa-circle"></i>Vendor List
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.vendors.create') }}">
                                            <i class="fa fa-circle"></i>Create Vendor
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="chrome"></i>
                                <span>Localization</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="translations.html"><i class="fa fa-circle"></i>Translations
                                    </a>
                                </li>
                                <li>
                                    <a href="currency-rates.html"><i class="fa fa-circle"></i>Currency Rates
                                    </a>
                                </li>
                                <li>
                                    <a href="taxes.html"><i class="fa fa-circle"></i>Taxes
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a class="sidebar-header" href="support-ticket.html"><i
                                    data-feather="phone"></i><span>Support Ticket</span>
                            </a>
                        </li>

                        <li>
                            <a class="sidebar-header" href="{{ route('admin.reports.index') }}"><i
                                    data-feather="bar-chart"></i><span>Reports</span>
                            </a>
                        </li>

                        <li>
                            <a class="sidebar-header" href="javascript:void(0)"><i
                                    data-feather="settings"></i><span>Settings</span><i
                                    class="fa fa-angle-right pull-right"></i></a>
                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="{{ route('admin.account.setting') }}"><i class="fa fa-circle"></i>Profile
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a class="sidebar-header" href="invoice.html"><i
                                    data-feather="archive"></i><span>Invoice</span></a>
                        </li>

                        <li>
                            <a class="sidebar-header" href="{{ route('password.request') }}">
                                <i data-feather="key"></i>
                                <span>Forgot Password</span>
                            </a>
                        </li>

                         <li>
                            <a class="sidebar-header" href="{{ route('dashboard') }}">
                                <i data-feather="log-in"></i>
                                <span>Login</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
