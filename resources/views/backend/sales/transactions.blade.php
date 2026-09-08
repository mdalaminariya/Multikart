@extends('layouts.backendmaster.master')

@section('content')
<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Transactions
                                        <small>Multikart Admin panel</small>
                                    </h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Localization</li>
                                    <li class="breadcrumb-item active">Transactions</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <form class="form-inline search-form search-box">
                                        <div class="form-group">
                                            <input class="form-control-plaintext" type="search" placeholder="Search..">
                                        </div>
                                    </form>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive table-desi">
                                        <table class="table trans-table all-package">
                                            <thead>
                                                <tr>
                                                    <th>Order Id</th>
                                                    <th>Transaction Id</th>
                                                    <th>Date</th>
                                                    <th>Payment Method</th>
                                                    <th>Delivery Status</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            @forelse ($orders as $order)

                                                <tbody>
                                                    <tr>
                                                        <td>3{{ $order->id }}</td>

                                                        <td>#{{$order->transaction_id}}</td>

                                                        <td>{{ $order->created_at->format('M j, Y') }}</td>

                                                        <td>{{ $order->payment_method ?? 'Cash On Delivery' }}</td>

                                                        <td>{{ ucfirst($order->delivery_status ?? 'Pending') }}</td>

                                                        <td>${{ number_format($order->amount, 2) }}/-</td>
                                                    </tr>
                                                </tbody>
                                            @empty

                                            @endforelse
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>

@endsection
