@extends('layouts.frontendmaster.master')

@section('content')
    <!--  dashboard section start -->
    <section class="dashboard-section section-b-space user-dashboard-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="dashboard-sidebar">
                        <button class="btn back-btn">
                            <i class="ri-close-line"></i><span>Close</span>
                        </button>
                        <div class="profile-top">
                            <div class="profile-top-box">
                                <div class="profile-image">
                                    <div class="position-relative">
                                        <div class="user-round">
                                            <h4>{{ substr(auth()->user()->fname, 0, 1) }}</h4>
                                        </div>
                                        <div class="user-icon"><input type="file" accept="image/*"><i
                                                class="ri-image-edit-line d-lg-block d-none"></i><i
                                                class="ri-pencil-fill edit-icon d-lg-none"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-detail">
                                <h5>{{ auth()->user()->fname }} {{ auth()->user()->lname }}</h5>
                                <h6>{{ auth()->user()->email }}</h6>
                            </div>
                        </div>
                        <div class="faq-tab">
                            <ul id="pills-tab" role="tablist" class="nav nav-tabs">
                                <li role="presentation" class="nav-item">
                                    <button class="nav-link active" id="info-tab" data-bs-toggle="tab"
                                        data-bs-target="#info-tab-pane" type="button" role="tab">
                                        <i class="ri-home-line"></i>Own dashboard
                                    </button>
                                </li>
                                <li role="presentation" class="nav-item">
                                    <button class="nav-link" id="notification-tab" data-bs-toggle="tab"
                                        data-bs-target="#notification-tab-pane" type="button" role="tab">
                                        <i class="ri-notification-line"></i>
                                        Notifications
                                    </button>
                                </li>
                                <li role="presentation" class="nav-item">
                                    <button class="nav-link" id="bank-details-tab" data-bs-toggle="tab"
                                        data-bs-target="#bank-details-tab-pane" type="button" role="tab">
                                        <i class="ri-bank-line"></i> Bank Details
                                    </button>
                                </li>
                                <li role="presentation" class="nav-item">
                                    <button class="nav-link" id="wallet-tab" data-bs-toggle="tab"
                                        data-bs-target="#wallet-tab-pane" type="button" role="tab">
                                        <i class="ri-wallet-line"></i> My Wallet
                                    </button>
                                </li>
                                <li role="presentation" class="nav-item">
                                    <button class="nav-link" id="earning" data-bs-toggle="tab"
                                        data-bs-target="#earning-tab-pane" type="button" role="tab">
                                        <i class="ri-coin-line"></i> Earning Points
                                    </button>
                                </li>
                                <li role="presentation" class="nav-item">
                                    <button class="nav-link" id="order-tab" data-bs-toggle="tab"
                                        data-bs-target="#order-tab-pane" type="button" role="tab">
                                        <i class="ri-file-text-line"></i>My Orders
                                    </button>
                                </li>

                                <li role="presentation" class="nav-item">
                                    <button class="nav-link" id="refund-tab" data-bs-toggle="tab"
                                        data-bs-target="#refund-tab-pane" type="button" role="tab">
                                        <i class="ri-money-dollar-circle-line"></i> Refund History </button>
                                </li>
                                <li role="presentation" class="nav-item">
                                    <button class="nav-link" id="address" data-bs-toggle="tab"
                                        data-bs-target="#address-tab-pane" type="button" role="tab">
                                        <i class="ri-map-pin-line"></i> Saved Address
                                    </button>
                                </li>
                                <li role="presentation" class="nav-item logout-cls">
                                    <a href="#logout" data-bs-toggle="modal" class="btn loagout-btn">
                                        <i class="ri-logout-box-r-line"></i> Logout
                                    </a>
                                </li>
                                <li role="presentation" class="nav-item logout-cls">
                                    <a href="{{ route('admin.dashboard') }}" class="btn loagout-btn">
                                        <i class="ri-logout-box-r-line"></i> Return
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <button class="show-btn btn d-lg-none d-block">Show Menu</button>
                    <div class="faq-content tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="info-tab-pane" role="tabpanel">
                            <div class="counter-section">
                                <div class="welcome-msg">
                                    <h4>Hello, {{ auth()->user()->fname }} {{ auth()->user()->lname }} !</h4>
                                    <p>From your My Account Dashboard you have the ability to view a snapshot of your
                                        recent account activity and update your account information. Select a link below
                                        to view or edit information.</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="counter-box">
                                            <img src="../assets/images/dashboard/balance.png" alt="" class="img-fluid">
                                            <div>
                                                <h3>$12.46</h3>
                                                <h5>Total Order</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="counter-box">
                                            <img src="../assets/images/dashboard/points.png" alt="" class="img-fluid">
                                            <div>
                                                <h3>2530</h3>
                                                <h5>Total Points</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="counter-box">
                                            <img src="../assets/images/dashboard/order.png" alt="" class="img-fluid">
                                            <div>
                                                <h3>15</h3>
                                                <h5>Total Orders</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-account box-info">
                                    <div class="box-head">
                                        <h4>Account Information</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="box">
                                            @foreach ($user->addresses as $users)
                                                    <ul class="box-content">
                                                        <li class="w-100">
                                                            <h6>Full Name: {{ auth()->user()->fname }} {{ auth()->user()->lname }}</h6>
                                                        </li>
                                                        <li class="w-100">
                                                            <h6>Phone: {{ $users->phone }}</h6>
                                                        </li>
                                                        <li class="w-100">
                                                            <h6>Address: {{ $users->address }}</h6>
                                                        </li>
                                                    </ul>
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box mt-3">
                                        <div class="box-head">
                                            <h4>Login Details</h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h6>Email : {{ auth()->user()->email }}</h6><a href="#edit-profile"
                                                    data-bs-toggle="modal">Edit</a>
                                            </div>
                                            <div class="col-sm-6">
                                                <h6>Password : ●●●●●●</h6><a href="#edit-password"
                                                    data-bs-toggle="modal">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="notification-tab-pane" role="tabpanel">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card mb-0 mt-0 mb-0">
                                        <div class="card-body">
                                            <div class="top-sec">
                                                <h3>Notifications</h3>
                                            </div>
                                            <ul class="notification-list">
                                                <li>
                                                    <h4>Your order has been successfully placed. Order ID:
                                                        #1013. Thank you for
                                                        choosing us.</h4>
                                                    <h5><i class="ri-time-line"></i> 24 Jun 2024
                                                        02:29:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Your Refund request status has been rejected</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        05:42:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Your order has been successfully placed. Order ID:
                                                        #1012. Thank you for
                                                        choosing us.</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        05:18:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Your order has been successfully placed. Order ID:
                                                        #1011. Thank you for
                                                        choosing us.</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        05:18:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Your order has been successfully placed. Order ID:
                                                        #1010. Thank you for
                                                        choosing us.</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        04:29:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Your order has been successfully placed. Order ID:
                                                        #1009. Thank you for
                                                        choosing us.</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        03:57:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Order Update: Your order #1008 has been updated and
                                                        current order
                                                        status is in delivered. Thank you for your patience!</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        03:49:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Order Update: Your order #1008 has been updated and
                                                        current order
                                                        status is in pending. Thank you for your patience!</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        03:49:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Order Update: Your order #1007 has been updated and
                                                        current order
                                                        status is in delivered. Thank you for your patience!</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        03:49:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Your order has been successfully placed. Order ID:
                                                        #1006. Thank you for
                                                        choosing us.</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        03:48:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Your order has been successfully placed. Order ID:
                                                        #1005. Thank you for
                                                        choosing us.</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        03:45:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Order Update: Your order #1000 has been updated and
                                                        current order
                                                        status is in delivered. Thank you for your patience!</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        03:34:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Order Update: Your order #1003 has been updated and
                                                        current order
                                                        status is in cancelled. Thank you for your patience!</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        03:34:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Order Update: Your order #1004 has been updated and
                                                        current order
                                                        status is in delivered. Thank you for your patience!</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        03:34:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Order Update: Your order #1004 has been updated and
                                                        current order
                                                        status is in out_for_delivery. Thank you for your patience!</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        03:34:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Order Update: Your order #1004 has been updated and
                                                        current order
                                                        status is in shipped. Thank you for your patience!</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        03:34:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Order Update: Your order #1004 has been updated and
                                                        current order
                                                        status is in processing. Thank you for your patience!</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        03:34:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Your order has been successfully placed. Order ID:
                                                        #1004. Thank you for
                                                        choosing us.</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        03:14:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Your order has been successfully placed. Order ID:
                                                        #1003. Thank you for
                                                        choosing us.</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        03:10:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Your order has been successfully placed. Order ID:
                                                        #1002. Thank you for
                                                        choosing us.</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        03:07:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Your order has been successfully placed. Order ID:
                                                        #1001. Thank you for
                                                        choosing us.</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        03:02:PM</h5>
                                                </li>
                                                <li>
                                                    <h4>Your order has been successfully placed. Order ID:
                                                        #1000. Thank you for
                                                        choosing us.</h4>
                                                    <h5><i class="ri-time-line"></i> 21 Jun 2024
                                                        03:00:PM</h5>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="bank-details-tab-pane" role="tabpanel">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card mb-0 mt-0">
                                        <div class="card-body">
                                            <div class="top-sec">
                                                <h3>Bank Details</h3>
                                            </div>
                                            <form class="themeform-auth">
                                                <div class="row mb-3 align-items-center">
                                                    <label for="bank_account_no"
                                                        class="form-label col-xxl-2 col-lg-12 col-md-3">Bank Account
                                                        Number</label>
                                                    <div class="col-xxl-10 col-lg-12 col-md-9">
                                                        <input type="text" id="bank_account_no" class="form-control"
                                                            placeholder="Enter Bank Account Number">
                                                    </div>
                                                </div>
                                                <div class="row mb-3 align-items-center">
                                                    <label for="bank_name"
                                                        class="form-label col-xxl-2 col-lg-12 col-md-3">Bank
                                                        Name</label>
                                                    <div class="col-xxl-10 col-lg-12 col-md-9"><input type="text"
                                                            id="bank_name" class="form-control"
                                                            placeholder="Enter Bank Name">
                                                    </div>
                                                </div>
                                                <div class="row mb-3 align-items-center">
                                                    <label for="bank_holder_name"
                                                        class="form-label col-xxl-2 col-lg-12 col-md-3">Holder
                                                        Name</label>
                                                    <div class="col-xxl-10 col-lg-12 col-md-9"><input type="text"
                                                            id="bank_holder_name" class="form-control"
                                                            placeholder="Enter Bank Holder Name">
                                                    </div>
                                                </div>
                                                <div class="row mb-3 align-items-center">
                                                    <label for="swift"
                                                        class="form-label col-xxl-2 col-lg-12 col-md-3">Swift</label>
                                                    <div class="col-xxl-10 col-lg-12 col-md-9">
                                                        <input type="text" id="swift" class="form-control"
                                                            placeholder="Enter Swift Code">
                                                    </div>
                                                </div>
                                                <div class="row mb-3 align-items-center">
                                                    <label for="ifsc"
                                                        class="form-label col-xxl-2 col-lg-12 col-md-3">IFSC</label>
                                                    <div class="col-xxl-10 col-lg-12 col-md-9">
                                                        <input type="text" id="ifsc" class="form-control"
                                                            placeholder="Enter IFSC Code">
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="mb-3 top-sec top-sec-2">
                                                <h3>Payment Details</h3>
                                            </div>
                                            <form class="themeform-auth">
                                                <div class="row mb-3 align-items-center">
                                                    <label for="paypal_email"
                                                        class="form-label col-xxl-2 col-lg-12 col-md-3">Paypal
                                                        Email</label>
                                                    <div class="col-xxl-10 col-lg-12 col-md-9">
                                                        <input type="email" id="paypal_email" class="form-control "
                                                            placeholder="Enter Paypal Email">
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <button class="btn btn-solid" id="payout_btn" type="submit"> Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="wallet-tab-pane" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="total-contain wallet-bg">
                                        <div class="wallet-point-box">
                                            <div class="total-image">
                                                <img src="../assets/images/dashboard/balance.png" alt=""
                                                    class="img-fluid">
                                            </div>
                                            <div class="total-detail">
                                                <div class="total-box">
                                                    <h5>Wallet Balance</h5>
                                                    <h3>$8.46</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card mb-0 dashboard-table mt-0">
                                        <div class="card-body">
                                            <div class="total-box mt-0">
                                                <div class="wallet-table">
                                                    <div class="table-responsive">
                                                        <table class="table cart-table order-table">
                                                            <thead>
                                                                <tr class="table-head">
                                                                    <th>Date</th>
                                                                    <th>Amount</th>
                                                                    <th>Remark</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>06 Jul 2024
                                                                        03:15:PM</td>
                                                                    <td>$39.40</td>
                                                                    <td>Wallet amount
                                                                        successfully debited for Order #1017</td>
                                                                    <td>
                                                                        <div
                                                                            class="badge bg-debit custom-badge rounded-0">
                                                                            <span>Debit</span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>25 Jun 2024
                                                                        06:34:PM</td>
                                                                    <td>$375.00</td>
                                                                    <td>Wallet amount
                                                                        successfully debited for Order #1015</td>
                                                                    <td>
                                                                        <div
                                                                            class="badge bg-debit custom-badge rounded-0">
                                                                            <span>Debit</span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>24 Jun 2024
                                                                        02:29:PM</td>
                                                                    <td>$34.44</td>
                                                                    <td>Wallet amount
                                                                        successfully debited for Order #1013</td>
                                                                    <td>
                                                                        <div
                                                                            class="badge bg-debit custom-badge rounded-0">
                                                                            <span>Debit</span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>21 Jun 2024
                                                                        04:29:PM</td>
                                                                    <td>$75.21</td>
                                                                    <td>Wallet amount
                                                                        successfully debited for Order #1010</td>
                                                                    <td>
                                                                        <div
                                                                            class="badge bg-debit custom-badge rounded-0">
                                                                            <span>Debit</span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>21 Jun 2024
                                                                        03:57:PM</td>
                                                                    <td>$30.52</td>
                                                                    <td>Wallet amount
                                                                        successfully debited for Order #1009</td>
                                                                    <td>
                                                                        <div
                                                                            class="badge bg-debit custom-badge rounded-0">
                                                                            <span>Debit</span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>21 Jun 2024
                                                                        03:48:PM</td>
                                                                    <td>$109.97</td>
                                                                    <td>Wallet amount
                                                                        successfully debited for Order #1006</td>
                                                                    <td>
                                                                        <div
                                                                            class="badge bg-debit custom-badge rounded-0">
                                                                            <span>Debit</span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>21 Jun 2024
                                                                        03:42:PM</td>
                                                                    <td>$323.00</td>
                                                                    <td>Admin has credited
                                                                        the balance.</td>
                                                                    <td>
                                                                        <div
                                                                            class="badge bg-credit custom-badge rounded-0">
                                                                            <span>Credit</span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>21 Jun 2024
                                                                        03:41:PM</td>
                                                                    <td>$250.00</td>
                                                                    <td>Admin has debited
                                                                        the balance.</td>
                                                                    <td>
                                                                        <div
                                                                            class="badge bg-debit custom-badge rounded-0">
                                                                            <span>Debit</span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>21 Jun 2024
                                                                        03:41:PM</td>
                                                                    <td>$500.00</td>
                                                                    <td>Admin has credited
                                                                        the balance.</td>
                                                                    <td>
                                                                        <div
                                                                            class="badge bg-credit custom-badge rounded-0">
                                                                            <span>Credit</span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>21 Jun 2024
                                                                        03:41:PM</td>
                                                                    <td>$100.00</td>
                                                                    <td>Admin has credited
                                                                        the balance.</td>
                                                                    <td>
                                                                        <div
                                                                            class="badge bg-credit custom-badge rounded-0">
                                                                            <span>Credit</span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="product-pagination">
                                                    <div class="theme-paggination-block">
                                                        <nav>
                                                            <ul class="pagination">
                                                                <li class="page-item">
                                                                    <a class="page-link" href="#!"
                                                                        aria-label="Previous">
                                                                        <span>
                                                                            <i class="ri-arrow-left-s-line"></i>
                                                                        </span>
                                                                        <span class="sr-only">Previous</span>
                                                                    </a>
                                                                </li>
                                                                <li class="page-item active">
                                                                    <a class="page-link" href="#!">1</a>
                                                                </li>
                                                                <li class="page-item">
                                                                    <a class="page-link" href="#!">2</a>
                                                                </li>
                                                                <li class="page-item">
                                                                    <a class="page-link" href="#!">3</a>
                                                                </li>
                                                                <li class="page-item">
                                                                    <a class="page-link" href="#!" aria-label="Next">
                                                                        <span>
                                                                            <i class="ri-arrow-right-s-line"></i>
                                                                        </span>
                                                                        <span class="sr-only">Next</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="earning-tab-pane" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="total-contain wallet-bg">
                                        <div class="wallet-point-box">
                                            <div class="total-image">
                                                <img src="../assets/images/dashboard/points.png" alt=""
                                                    class="img-fluid">
                                            </div>
                                            <div class="total-detail">
                                                <div class="total-box">
                                                    <h5>Total Points</h5>
                                                    <h3>1970</h3>
                                                </div>
                                                <div class="point-ratio">
                                                    <h3 class="counter"><i class="ri-information-line"></i>
                                                        1 Points =
                                                        $0.03 Balance </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="dashboard-table">
                                        <div class="wallet-table">
                                            <div class="table-responsive">
                                                <table class="table cart-table order-table">
                                                    <thead>
                                                        <tr class="table-head">
                                                            <th>Date</th>
                                                            <th>Points</th>
                                                            <th>Remark</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="">
                                                            <td>06 Jul 2024 03:15:PM</td>
                                                            <td>$39.40</td>
                                                            <td>Wallet amount successfully debited for Order #1017</td>
                                                            <td>
                                                                <div class="badge bg-debit custom-badge rounded-0">
                                                                    <span>Debit</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>25 Jun 2024 06:34:PM</td>
                                                            <td>$375.00</td>
                                                            <td>Wallet amount successfully debited for Order #1015</td>
                                                            <td>
                                                                <div class="badge bg-debit custom-badge rounded-0">
                                                                    <span>Debit</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>24 Jun 2024 02:29:PM</td>
                                                            <td>$34.44</td>
                                                            <td>Wallet amount successfully debited for Order #1013</td>
                                                            <td>
                                                                <div class="badge bg-debit custom-badge rounded-0">
                                                                    <span>Debit</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>21 Jun 2024 04:29:PM</td>
                                                            <td>$75.21</td>
                                                            <td>Wallet amount successfully debited for Order #1010</td>
                                                            <td>
                                                                <div class="badge bg-debit custom-badge rounded-0">
                                                                    <span>Debit</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>21 Jun 2024 03:57:PM</td>
                                                            <td>$30.52</td>
                                                            <td>Wallet amount successfully debited for Order #1009</td>
                                                            <td>
                                                                <div class="badge bg-debit custom-badge rounded-0">
                                                                    <span>Debit</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>21 Jun 2024 03:41:PM</td>
                                                            <td>$500.00</td>
                                                            <td>Admin has credited the balance.</td>
                                                            <td>
                                                                <div class="badge bg-credit custom-badge rounded-0">
                                                                    <span>Credit</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-pagination">
                                        <div class="theme-paggination-block">
                                            <nav>
                                                <ul class="pagination">
                                                    <li class="page-item">
                                                        <a class="page-link" href="#!" aria-label="Previous">
                                                            <span>
                                                                <i class="ri-arrow-left-s-line"></i>
                                                            </span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                    </li>
                                                    <li class="page-item active">
                                                        <a class="page-link" href="#!">1</a>
                                                    </li>

                                                    <li class="page-item">
                                                        <a class="page-link" href="#!" aria-label="Next">
                                                            <span>
                                                                <i class="ri-arrow-right-s-line"></i>
                                                            </span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="order-tab-pane" role="tabpanel">
                            <div class="row">
                                <div class="card mb-0 dashboard-table mt-0">
                                    <div class="card-body">
                                        <div class="top-sec">
                                            <h3>My Orders</h3>
                                        </div>
                                        <div class="total-box mt-0">
                                            <div class="wallet-table mt-0">
                                                <div class="table-responsive">
                                                    <table class="table cart-table order-table">
                                                        <thead>
                                                            <tr class="table-head">
                                                                <th>Order Number</th>
                                                                <th>Date</th>
                                                                <th>Amount</th>
                                                                <th>Payment Status</th>
                                                                <th>Payment Method</th>
                                                                <th>Option</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><span class="fw-bolder">#1020</span></td>
                                                                <td>06 Jul 2024 03:51:PM
                                                                </td>
                                                                <td>$61.73</td>
                                                                <td>
                                                                    <div
                                                                        class="badge bg-pending custom-badge rounded-0">
                                                                        <span>Pending</span>
                                                                    </div>
                                                                </td>
                                                                <td>COD</td>
                                                                <td><a href="#!"><i class="ri-eye-line"></i></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td><span class="fw-bolder">#1017</span></td>
                                                                <td>06 Jul 2024 03:15:PM
                                                                </td>
                                                                <td>$1.97</td>
                                                                <td>
                                                                    <div
                                                                        class="badge bg-pending custom-badge rounded-0">
                                                                        <span>Pending</span>
                                                                    </div>
                                                                </td>
                                                                <td>COD</td>
                                                                <td><a href="#!"><i class="ri-eye-line"></i></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td><span class="fw-bolder">#1016</span></td>
                                                                <td>26 Jun 2024 10:23:AM
                                                                </td>
                                                                <td>$46.14</td>
                                                                <td>
                                                                    <div
                                                                        class="badge bg-pending custom-badge rounded-0">
                                                                        <span>Pending</span>
                                                                    </div>
                                                                </td>
                                                                <td>COD</td>
                                                                <td><a href="#!"><i class="ri-eye-line"></i></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td><span class="fw-bolder">#1015</span></td>
                                                                <td>25 Jun 2024 06:34:PM
                                                                </td>
                                                                <td>$18.75</td>
                                                                <td>
                                                                    <div
                                                                        class="badge bg-pending custom-badge rounded-0">
                                                                        <span>Pending</span>
                                                                    </div>
                                                                </td>
                                                                <td>COD</td>
                                                                <td><a href="#!"><i class="ri-eye-line"></i></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td><span class="fw-bolder">#1013</span></td>
                                                                <td>24 Jun 2024 02:29:PM
                                                                </td>
                                                                <td>$1.72</td>
                                                                <td>
                                                                    <div
                                                                        class="badge bg-pending custom-badge rounded-0">
                                                                        <span>Pending</span>
                                                                    </div>
                                                                </td>
                                                                <td>COD</td>
                                                                <td><a href="#!"><i class="ri-eye-line"></i></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td><span class="fw-bolder">#1012</span></td>
                                                                <td>21 Jun 2024 05:18:PM
                                                                </td>
                                                                <td>$6.23</td>
                                                                <td>
                                                                    <div
                                                                        class="badge bg-pending custom-badge rounded-0">
                                                                        <span>Pending</span>
                                                                    </div>
                                                                </td>
                                                                <td>COD</td>
                                                                <td><a href="#!"><i class="ri-eye-line"></i></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td><span class="fw-bolder">#1011</span></td>
                                                                <td>21 Jun 2024 05:18:PM
                                                                </td>
                                                                <td>$39.72</td>
                                                                <td>
                                                                    <div
                                                                        class="badge bg-pending custom-badge rounded-0">
                                                                        <span>Pending</span>
                                                                    </div>
                                                                </td>
                                                                <td>COD</td>
                                                                <td><a href="#!"><i class="ri-eye-line"></i></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td><span class="fw-bolder">#1010</span></td>
                                                                <td>21 Jun 2024 04:29:PM
                                                                </td>
                                                                <td>$3.76</td>
                                                                <td>
                                                                    <div
                                                                        class="badge bg-pending custom-badge rounded-0">
                                                                        <span>Pending</span>
                                                                    </div>
                                                                </td>
                                                                <td>COD</td>
                                                                <td><a href="#!"><i class="ri-eye-line"></i></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td><span class="fw-bolder">#1009</span></td>
                                                                <td>21 Jun 2024 03:57:PM
                                                                </td>
                                                                <td>$1.52</td>
                                                                <td>
                                                                    <div
                                                                        class="badge bg-pending custom-badge rounded-0">
                                                                        <span>Pending</span>
                                                                    </div>
                                                                </td>
                                                                <td>COD</td>
                                                                <td><a href="#!"><i class="ri-eye-line"></i></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td><span class="fw-bolder">#1006</span></td>
                                                                <td>21 Jun 2024 03:48:PM
                                                                </td>
                                                                <td>$5.49</td>
                                                                <td>
                                                                    <div
                                                                        class="badge bg-pending custom-badge rounded-0">
                                                                        <span>Pending</span>
                                                                    </div>
                                                                </td>
                                                                <td>COD</td>
                                                                <td><a href="#!"><i class="ri-eye-line"></i></a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="product-pagination">
                                                <div class="theme-paggination-block">
                                                    <nav>
                                                        <ul class="pagination">
                                                            <li class="page-item">
                                                                <a class="page-link" href="#!" aria-label="Previous">
                                                                    <span>
                                                                        <i class="ri-arrow-left-s-line"></i>
                                                                    </span>
                                                                    <span class="sr-only">Previous</span>
                                                                </a>
                                                            </li>
                                                            <li class="page-item active">
                                                                <a class="page-link" href="#!">1</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a class="page-link" href="#!">2</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a class="page-link" href="#!">3</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a class="page-link" href="#!" aria-label="Next">
                                                                    <span>
                                                                        <i class="ri-arrow-right-s-line"></i>
                                                                    </span>
                                                                    <span class="sr-only">Next</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="refund-tab-pane" role="tabpanel">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card mb-0 dashboard-table mt-0">
                                        <div class="card-body">
                                            <div class="top-sec">
                                                <h3>Refund</h3>
                                            </div>
                                            <div class="total-box mt-0">
                                                <div class="wallet-table mt-0">
                                                    <div class="table-responsive">
                                                        <table class="table cart-table order-table">
                                                            <thead>
                                                                <tr class="table-head">
                                                                    <th>Order</th>
                                                                    <th>Status</th>
                                                                    <th class="reason-table">Reason</th>
                                                                    <th>Created At</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><span class="fw-bolder">#1000</span></td>
                                                                    <td>
                                                                        <div class="status-rejected">
                                                                            <span>Rejected</span>
                                                                        </div>
                                                                    </td>
                                                                    <td class="reason-table">Item was damaged . also
                                                                        fabric was not
                                                                        good as expected</td>
                                                                    <td>21 Jun 2024</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="product-pagination">
                                                    <div class="theme-paggination-block">
                                                        <nav>
                                                            <ul class="pagination">
                                                                <li class="page-item">
                                                                    <a class="page-link" href="#!"
                                                                        aria-label="Previous">
                                                                        <span>
                                                                            <i class="ri-arrow-left-s-line"></i>
                                                                        </span>
                                                                        <span class="sr-only">Previous</span>
                                                                    </a>
                                                                </li>
                                                                <li class="page-item active">
                                                                    <a class="page-link" href="#!">1</a>
                                                                </li>
                                                                <li class="page-item">
                                                                    <a class="page-link" href="#!">2</a>
                                                                </li>
                                                                <li class="page-item">
                                                                    <a class="page-link" href="#!">3</a>
                                                                </li>
                                                                <li class="page-item">
                                                                    <a class="page-link" href="#!" aria-label="Next">
                                                                        <span>
                                                                            <i class="ri-arrow-right-s-line"></i>
                                                                        </span>
                                                                        <span class="sr-only">Next</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="address-tab-pane" role="tabpanel">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card mb-0 mt-0">
                                        <div class="card-body">
                                            <div class="top-sec">
                                                <h3>Address Book</h3><a href="#add-address" data-bs-toggle="modal" data-bs-target="#add-address"
                                                    class="btn btn-sm btn-solid">+ Add New</a>
                                            </div>
                                            <div class="address-book-section">
                                                <div class="row g-4">
                                                    @forelse($user->addresses as $address)
                                                        <div class="col-xl-4 col-md-6">
                                                            <div class="select-box active address-box">

                                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                                    <h5 class="mb-0 fw-bold">
                                                                        {{ $user->fname }} {{ $user->lname }}
                                                                    </h5>

                                                                    <span class="btn btn-solid btn-sm">
                                                                        {{ $address->address_type }}
                                                                    </span>
                                                                </div>

                                                                <div class="address mb-3">
                                                                    <p class="mb-1">{{ $address->address }}</p>
                                                                    <p class="mb-1">{{ $address->city }}, {{ $address->state }}</p>
                                                                    <p class="mb-1">{{ $address->country }}</p>
                                                                    <p class="mb-1">{{ $address->zip_code }}</p>
                                                                </div>

                                                                <div class="number mb-3">
                                                                    <p class="mb-0">
                                                                        Phone: {{ $address->phone }}
                                                                    </p>
                                                                </div>

                                                                <hr>

                                                                <div class="d-flex gap-2">
                                                                    <a href="#address/{{ $address->id }}/edit"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit-address"
                                                                    class="btn btn-light w-50">
                                                                        Edit
                                                                    </a>

                                                                    <form action="{{ route('dashboard.address.delete', $address->id) }}"
                                                                        method="POST"
                                                                        class="w-50">
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <button type="submit"
                                                                                class="btn btn-light w-100">
                                                                            Remove
                                                                        </button>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="col-12">
                                                            <p>No address found</p>
                                                        </div>
                                                    @endforelse
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
    </section>
    <!--  dashboard section end -->
<!-- Edit Profile Modal -->
<div class="modal fade" id="edit-profile" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('dashboard.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h3 class="fw-semibold">Edit Profile</h3>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-12">
                            <label class="form-label">First Name</label>
                            <input type="text"
                                   name="fname"
                                   class="form-control"
                                   value="{{ auth()->user()->fname }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Last Name</label>
                            <input type="text"
                                   name="lname"
                                   class="form-control"
                                   value="{{ auth()->user()->lname }}">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ auth()->user()->email }}">
                        </div>

                        @foreach ($user->addresses as $address)
                                                    <div class="col-12">
                                                        <label class="form-label">Phone Number</label>
                                                        <input type="text"
                                                            name="phone"
                                                            class="form-control"
                                                            value="{{ $address->phone }}">
                                                    </div>
                        @endforeach

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit"
                            class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                            class="btn btn-solid"
                            data-bs-dismiss="modal">
                        Submit
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Add Address Modal -->
<div class="modal fade" id="add-address" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <form action="{{ route('dashboard.address.store') }}" method="POST">
        @csrf
        @method('POST')
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="fw-semibold">Add Address</h3>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>

            <div class="modal-body">
                <div class="row g-3">

                    <div class="col-xxl-12">
                        <div class="form-box">
                            <label class="form-label">Address Type</label>
                            <input type="text"
                                    name="address_type"
                                   value="Home"
                                   class="form-control"
                                   placeholder="Enter Address Type">
                        </div>
                    </div>

                    <div class="col-xxl-12">
                        <div class="form-box">
                            <label class="form-label">Address</label>
                            <input type="text"
                                    name="address"
                                   value="26, Starts Hollow Colony"
                                   class="form-control"
                                   placeholder="Enter Address">
                        </div>
                    </div>

                    <div class="col-xxl-12">
                        <div class="form-box">
                            <label class="form-label">Phone Number</label>
                            <input type="tel"
                                   name="phone"
                                   class="form-control"
                                   placeholder="Enter Phone Number">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-box">
                            <label class="form-label">City</label>
                            <input type="text"
                                   name="city"
                                   value="Dhaka"
                                   class="form-control"
                                   placeholder="Enter City">
                        </div>
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-end gap-2">
                    <button type="button"
                            class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                            class="btn btn-solid"
                            data-bs-dismiss="modal">
                        Submit
                    </button>
                </div>
            </div>

        </div>
    </form>
    </div>
</div>
<!-- password Modal -->
<div class="modal fade" id="edit-password" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <form action="{{ route('dashboard.password.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="fw-semibold">Update Password</h3>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>

            <div class="modal-body">
                <div class="row g-3">

                    <div class="col-xxl-12">
                        <div class="form-box">
                            <label class="form-label">Current Password</label>
                            <input type="password"
                                    name="current_password"
                                   class="form-control"
                                   placeholder="Enter Current Password">
                        </div>
                    </div>

                    <div class="col-xxl-12">
                        <div class="form-box">
                            <label class="form-label">New Password</label>
                            <input type="password"
                                    name="new_password"
                                   class="form-control"
                                   placeholder="Enter New Password">
                        </div>
                    </div>

                    <div class="col-xxl-12">
                        <div class="form-box">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password"
                                    name="new_password_confirmation"
                                   class="form-control"
                                   placeholder="Confirm New Password">
                        </div>
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-end gap-2">
                    <button type="button"
                            class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                            class="btn btn-solid"
                            data-bs-dismiss="modal">
                        Submit
                    </button>
                </div>
            </div>

        </div>
    </form>
    </div>
</div>

<!-- Edit Address Modal -->
<div class="modal fade" id="edit-address" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <form action="{{ route('dashboard.address.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="fw-semibold">Edit Address</h3>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>

            <div class="modal-body">
                <div class="row g-3">

                    <div class="col-xxl-12">
                        <div class="form-box">
                            <label class="form-label">Address Type</label>
                            <input type="text"
                                    name="address_type"
                                   value="Home"
                                   class="form-control"
                                   placeholder="Enter Address Type">
                        </div>
                    </div>

                    <div class="col-xxl-12">
                        <div class="form-box">
                            <label class="form-label">Address</label>
                            <input type="text"
                                    name="address"
                                   value="26, Starts Hollow Colony"
                                   class="form-control"
                                   placeholder="Enter Address">
                        </div>
                    </div>

                    <div class="col-xxl-12">
                        <div class="form-box">
                            <label class="form-label">Phone Number</label>
                            <input type="tel"
                                   name="phone"
                                   class="form-control"
                                   placeholder="Enter Phone Number">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-box">
                            <label class="form-label">City</label>
                            <input type="text"
                                   name="city"
                                   value="Dhaka"
                                   class="form-control"
                                   placeholder="Enter City">
                        </div>
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-end gap-2">
                    <button type="button"
                            class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                            class="btn btn-solid"
                            data-bs-dismiss="modal">
                        Submit
                    </button>
                </div>
            </div>

        </div>
    </form>
    </div>
</div>
@endsection


@section('script')
document.addEventListener('DOMContentLoaded', function () {
    // Toast messages
    @if (session('success'))
        Toastify({
            text: "{{ session('success') }}",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "center",
            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
        }).showToast();
    @endif

    @if (session('error'))
        Toastify({
            text: "{{ session('error') }}",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "center",
            backgroundColor: "linear-gradient(to right, #FF0112, #D21302)",
        }).showToast();
    @endif
    });
</script>
@endsection
