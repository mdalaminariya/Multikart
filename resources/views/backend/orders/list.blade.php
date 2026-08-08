@extends('layouts.backendmaster.master')

@section('content')

<div class="page-body">

    <!-- Container-fluid starts -->
    <div class="container-fluid">

        <div class="page-header">

            <div class="row">

                <div class="col-lg-6">

                    <div class="page-header-left">

                        <h3>
                            Order List
                            <small>Multikart Admin panel</small>
                        </h3>

                    </div>

                </div>

                <div class="col-lg-6">

                    <ol class="breadcrumb pull-right">

                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                <i data-feather="home"></i>
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            Menus
                        </li>

                        <li class="breadcrumb-item active">
                            Order List
                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </div>
    <!-- Container-fluid Ends -->


    <!-- Container-fluid starts -->
    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12">

                <div class="card">

                    <div class="card-header">

                        <form class="form-inline search-form search-box">

                            <div class="form-group">

                                <input
                                    class="form-control-plaintext"
                                    type="search"
                                    placeholder="Search..">

                            </div>

                        </form>

                    </div>


                    <div class="card-body">

                        <div class="table-responsive table-desi">

                            <table
                                class="table all-package order-list-table"
                                id="editableTable">

                                <thead>

                                    <tr>

                                        <th>Order Image</th>

                                        <th>Order Code</th>

                                        <th>Date</th>

                                        <th>Payment Method</th>

                                        <th>Delivery Status</th>

                                        <th>Amount</th>

                                        <th>Option</th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse ($orders as $order)

                                        @php
                                            $orderItem = $order->items->first();
                                        @endphp

                                        <tr>

                                            <!-- Order Image -->
                                            <td>

                                                @if($orderItem && $orderItem->product)

                                                    @if($orderItem->product_type == 'physical')

                                                        <img
                                                            src="{{ asset('uploads/physical/products/'.$orderItem->product->image) }}"
                                                            width="70"
                                                            class="img-fluid"
                                                            alt="{{ $orderItem->product->title }}">

                                                    @else

                                                        <img
                                                            src="{{ asset('uploads/digital/products/'.$orderItem->product->images) }}"
                                                            width="70"
                                                            class="img-fluid"
                                                            alt="{{ $orderItem->product->title }}">

                                                    @endif

                                                @else

                                                    <span>
                                                        No Product
                                                    </span>

                                                @endif

                                            </td>


                                            <!-- Order Number -->
                                            <td data-field="number">

                                                {{ $order->order_number }}

                                            </td>


                                            <!-- Date -->
                                            <td data-field="date">

                                                {{ $order->created_at->format('Y-m-d') }}

                                            </td>


                                            <!-- Payment Method -->
                                            <td data-field="text">

                                                {{ $order->payment_method ?? 'N/A' }}

                                            </td>


                                            <!-- Delivery Status -->
                                        <td class="order-status">

                                            @if($order->status == 'pending')
                                                <span class="status-badge status-pending">Pending</span>

                                            @elseif($order->status == 'processing')
                                                <span class="status-badge status-processing">Processing</span>

                                            @elseif($order->status == 'completed')
                                                <span class="status-badge status-completed">Completed</span>

                                            @elseif($order->status == 'cancelled')
                                                <span class="status-badge status-cancelled">Cancelled</span>

                                            @endif

                                        </td>


                                            <!-- Amount -->
                                            <td data-field="number">

                                                ${{ number_format($order->total, 2) }}

                                            </td>


                                            <!-- Options -->
                                            <td>

                                                <!-- Edit -->
                                                <a href="javascript:void(0)"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#exampleModal{{ $order->id }}">

                                                    <i
                                                        class="fa fa-edit"
                                                        title="Edit">
                                                    </i>

                                                </a>


                                                <!-- Delete -->
                                                <a href="{{ route('admin.orders.delete', $order->id) }}">

                                                    <i
                                                        class="fa fa-trash"
                                                        title="Delete">
                                                    </i>

                                                </a>

                                            </td>

                                        </tr>


                                        <!-- ========================= -->
                                        <!-- UPDATE ORDER MODAL -->
                                        <!-- ========================= -->

                                        <div
                                            class="modal fade"
                                            id="exampleModal{{ $order->id }}"
                                            tabindex="-1"
                                            role="dialog"
                                            aria-labelledby="exampleModalLabel{{ $order->id }}"
                                            aria-hidden="true">

                                            <div
                                                class="modal-dialog"
                                                role="document">

                                                <div class="modal-content">


                                                    <!-- Modal Header -->
                                                    <div class="modal-header">

                                                        <h5
                                                            class="modal-title f-w-600"
                                                            id="exampleModalLabel{{ $order->id }}">

                                                            Update Order

                                                        </h5>


                                                        <button
                                                            class="btn-close"
                                                            type="button"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close">

                                                            <span aria-hidden="true">
                                                                ×
                                                            </span>

                                                        </button>

                                                    </div>


                                                    <!-- Form -->
                                                    <form
                                                        action="{{ route('admin.orders.status.update', $order->id) }}"
                                                        method="POST">

                                                        @csrf

                                                        @method('PUT')


                                                        <!-- Modal Body -->
                                                        <div class="modal-body">

                                                            <div class="form">

                                                                <div class="form-group">

                                                                    <label
                                                                        for="status{{ $order->id }}"
                                                                        class="mb-1">

                                                                        Delivery Status :

                                                                    </label>


                                                                    <select
                                                                        class="form-control"
                                                                        id="status{{ $order->id }}"
                                                                        name="status"
                                                                        required>

                                                                        <option
                                                                            value="pending"
                                                                            {{ $order->status == 'pending' ? 'selected' : '' }}>

                                                                            Pending

                                                                        </option>


                                                                        <option
                                                                            value="processing"
                                                                            {{ $order->status == 'processing' ? 'selected' : '' }}>

                                                                            Processing

                                                                        </option>


                                                                        <option
                                                                            value="completed"
                                                                            {{ $order->status == 'completed' ? 'selected' : '' }}>

                                                                            Completed

                                                                        </option>


                                                                        <option
                                                                            value="cancelled"
                                                                            {{ $order->status == 'cancelled' ? 'selected' : '' }}>

                                                                            Cancelled

                                                                        </option>

                                                                    </select>

                                                                </div>

                                                            </div>

                                                        </div>


                                                        <!-- Modal Footer -->
                                                        <div class="modal-footer">

                                                            <button
                                                                class="btn btn-primary"
                                                                type="submit">

                                                                Save

                                                            </button>


                                                            <button
                                                                class="btn btn-secondary"
                                                                type="button"
                                                                data-bs-dismiss="modal">

                                                                Close

                                                            </button>

                                                        </div>

                                                    </form>

                                                </div>

                                            </div>

                                        </div>

                                    @empty

                                        <tr>

                                            <td
                                                colspan="7"
                                                class="text-center">

                                                No orders found.

                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- Container-fluid Ends -->

</div>

@endsection

@section('script')
<script>
function previewProfileImage(event) {
    let reader = new FileReader();

    reader.onload = function () {
        document.getElementById('preview-image').src = reader.result;
    }

    reader.readAsDataURL(event.target.files[0]);
}
</script>

{{-- Notification message --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        @if ($errors->any())
            Toastify({
                text: "{{ $errors->first() }}",
                duration: 4000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "linear-gradient(to right, #FF0112, #D21302)",
            }).showToast();
        @endif

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
