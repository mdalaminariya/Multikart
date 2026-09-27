 <div class="page-main-header">
            <div class="main-header-right row">
                <div class="main-header-left d-lg-none w-auto">
                    <div class="logo-wrapper">
                        <a href="index.html">
                            <img class="blur-up lazyloaded d-block d-lg-none"
                                src="{{ asset('backend') }}/assets/images/dashboard/multikart-logo-black.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="mobile-sidebar w-auto">
                    <div class="media-body text-end switch-sm">
                        <label class="switch">
                            <a href="javascript:void(0)">
                                <i id="sidebar-toggle" data-feather="align-left"></i>
                            </a>
                        </label>
                    </div>
                </div>
                <div class="nav-right col">
                    <ul class="nav-menus">
                        <li>
                            <form class="form-inline search-form" action="{{ route('search') }}" method="GET">
                                <div class="form-group">
                                    <input
                                        class="form-control-plaintext"
                                        type="search"
                                        name="search"
                                        value="{{ request('search') }}"
                                        placeholder="Search.."
                                        autocomplete="off">

                                    <span class="d-sm-none mobile-search">
                                        <i data-feather="search"></i>
                                    </span>
                                </div>
                            </form>
                        </li>
                        <li>
                            <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                                <i data-feather="maximize-2"></i>
                            </a>
                        </li>

                        {{-- **Language** --}}

                        {{-- <li class="onhover-dropdown">
                            <a class="txt-dark" href="javascript:void(0)">
                                <h6>EN</h6>
                            </a>
                            <ul class="language-dropdown onhover-show-div p-20">
                                <li>
                                    <a href="javascript:void(0)" data-lng="en">
                                        <i class="flag-icon flag-icon-is"></i>English</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" data-lng="es">
                                        <i class="flag-icon flag-icon-um"></i>Spanish</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" data-lng="pt">
                                        <i class="flag-icon flag-icon-uy"></i>Portuguese</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" data-lng="fr">
                                        <i class="flag-icon flag-icon-nz"></i>French</a>
                                </li>
                            </ul>
                        </li> --}}

                        {{-- Notifications --}}


                        <li class="onhover-dropdown">

                            <i data-feather="bell"></i>

                            <span class="badge badge-pill badge-primary pull-right notification-badge">
                                {{ $notificationCount }}
                            </span>

                            @if($notificationCount > 0)
                                <span class="dot"></span>
                            @endif

                            <ul class="notification-dropdown onhover-show-div p-0">

                                <li>
                                    Notification

                                    <span class="badge badge-pill badge-primary pull-right">
                                        {{ $notificationCount }}
                                    </span>
                                </li>


                                @forelse($notifications as $notification)

                                    <li>

                                        <a href="{{ route('admin.orders.details', $notification['order_id']) }}"
                                        class="text-decoration-none">

                                            <div class="media">

                                                <div class="media-body">

                                                    <h6 class="mt-0">

                                                        <span>
                                                            <i
                                                                class="{{ $notification['color'] }}"
                                                                data-feather="{{ $notification['icon'] }}">
                                                            </i>
                                                        </span>

                                                        {{ $notification['title'] }}

                                                    </h6>

                                                    <p class="mb-0">
                                                        {{ $notification['message'] }}
                                                    </p>

                                                    <small class="text-muted">
                                                        {{ $notification['date']->diffForHumans() }}
                                                    </small>

                                                </div>

                                            </div>

                                        </a>

                                    </li>

                                @empty

                                    <li>
                                        <div class="media">
                                            <div class="media-body text-center">
                                                <h6 class="mt-0">
                                                    <i data-feather="bell-off"></i>
                                                    No notifications
                                                </h6>

                                                <p class="mb-0">
                                                    You don't have any orders yet.
                                                </p>
                                            </div>
                                        </div>
                                    </li>

                                @endforelse


                                <li class="txt-dark">
                                    <a href="{{ route('admin.orders.list') }}">
                                        All
                                    </a>
                                    notification
                                </li>

                            </ul>

                        </li>

                        {{-- Message --}}

                            <li>
                                <a href="javascript:void(0)">
                                    <i class="right_side_toggle" data-feather="message-square"></i>

                                    @if(isset($notificationCount) && $notificationCount > 0)
                                        <span class="dot"></span>
                                    @endif
                                </a>
                            </li>

                            {{-- Profile --}}
                        <li class="onhover-dropdown">
                            <div class="media align-items-center">
                                @if (auth()->user()->image == 'default.png')
                                    <img class="align-self-center pull-right img-50 blur-up lazyloaded"
                                        src="{{ asset('uploads/profile/default/default.png') }}" alt="header-user">
                                @else
                                    <img class="align-self-center pull-right img-50 blur-up lazyloaded"
                                        src="{{ asset('uploads/profile/'. auth()->user()->image) }}" alt="header-user">
                                @endif
                                <div class="dotted-animation">
                                    <span class="animate-circle"></span>
                                    <span class="main-circle"></span>
                                </div>
                            </div>

                            <ul class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover">
                                <li>
                                    <a href="{{ route('admin.account.settings.edit') }}">
                                        <i data-feather="user"></i>Edit Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <i data-feather="mail"></i>Inbox
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <i data-feather="lock"></i>Lock Screen
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.account.setting') }}">
                                        <i data-feather="settings"></i>Settings
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}">
                                        <i data-feather="log-out"></i>Logout
                                    </a>

                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="d-lg-none mobile-toggle pull-right">
                        <i data-feather="more-horizontal"></i>
                    </div>
                </div>
            </div>
        </div>
