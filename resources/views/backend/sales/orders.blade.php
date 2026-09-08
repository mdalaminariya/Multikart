@extends('layouts.backendmaster.master')

@section('content')
            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Orders
                                        <small>Multikart Admin panel</small>
                                    </h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Sales</li>
                                    <li class="breadcrumb-item active">Orders</li>
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
                                <div class="card-body order-datatable">
    <table class="display" id="basic-1">

        <thead>
            <tr>
                <th>Order Id</th>
                <th>Product</th>
                <th>Payment Status</th>
                <th>Payment Method</th>
                <th>Order Status</th>
                <th>Date</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($salesOrders as $order)

                <tr>

                    <td>
                        #{{ $order->id }}
                    </td>

                    <td>
                        <div class="d-flex align-items-center">

                            @foreach ($order->items as $item)

                                @if ($item->product_type === 'physical')

                                    @if (optional($item->product)->image)
                                        <img
                                            src="{{ asset('uploads/physical/products/' . $item->product->image) }}"
                                            alt="{{ $item->product_name }}"
                                            class="img-fluid img-30 me-2 blur-up lazyloaded">
                                    @endif

                                @elseif ($item->product_type === 'digital')

                                    @if (optional($item->product)->image)
                                        <img
                                            src="{{ asset('uploads/digital/products/' . $item->product->image) }}"
                                            alt="{{ $item->product_name }}"
                                            class="img-fluid img-30 me-2 blur-up lazyloaded">
                                    @endif

                                @endif

                            @endforeach

                        </div>
                    </td>

                    <td>
                        @if ($order->payment_status === 'paid')
                            <span class="badge badge-success">Paid</span>

                        @elseif ($order->payment_status === 'pending')
                            <span class="badge badge-secondary">Pending</span>

                        @elseif ($order->payment_status === 'failed')
                            <span class="badge badge-danger">Failed</span>

                        @else
                            <span class="badge badge-secondary">
                                {{ ucfirst($order->payment_status ?? 'Pending') }}
                            </span>
                        @endif
                    </td>

                    <td>
                        {{ $order->payment_method ?? 'Cash On Delivery' }}
                    </td>

                    <td>
                        @if ($order->status === 'pending')
                            <span class="badge badge-warning">Pending</span>

                        @elseif ($order->status === 'processing')
                            <span class="badge badge-info">Processing</span>

                        @elseif ($order->status === 'shipped')
                            <span class="badge badge-primary">Shipped</span>

                        @elseif ($order->status === 'completed')
                            <span class="badge badge-success">Delivered</span>

                        @elseif ($order->status === 'cancelled')
                            <span class="badge badge-danger">Cancelled</span>

                        @else
                            <span class="badge badge-secondary">
                                {{ ucfirst($order->status ?? 'Pending') }}
                            </span>
                        @endif
                    </td>

                    <td>
                        {{ $order->created_at->format('M d, Y') }}
                    </td>

                    <td>
                        ${{ number_format($order->total, 2) }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" class="text-center">
                        No orders found.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>
</div>
@endsection

@section('script')

<script>
    $(document).ready(function () {

        $('#basic-1').DataTable({
            pageLength: 10,
            ordering: true,
            searching: true,
            lengthChange: true,
            autoWidth: false
        });

    });
</script>

@endsection
