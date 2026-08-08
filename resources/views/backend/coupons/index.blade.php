@extends('layouts.backendmaster.master')

@section('content')

<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">

                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            List Coupons
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

                        <li class="breadcrumb-item">
                            Coupons
                        </li>

                        <li class="breadcrumb-item active">
                            List Coupons
                        </li>
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

                    {{-- Card Header --}}
                    <div class="card-header d-flex justify-content-between align-items-center">

                        {{-- Search Form --}}
                        <form action="{{ route('admin.coupons.index') }}"
                              method="GET"
                              class="form-inline search-form search-box">

                            <div class="form-group">
                                <input class="form-control-plaintext"
                                       type="search"
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Search..">
                            </div>

                        </form>

                        {{-- Add Button --}}
                        <a href="{{ route('admin.coupons.create') }}"
                           class="btn btn-primary mt-md-0 mt-2">

                            Add New Coupon

                        </a>

                    </div>

                        <div>

                            <div class="table-responsive table-desi">

                                <table class="all-package coupon-table table table-striped">

                                    <thead>

                                        <tr>

                                            <th width="80">
                                                <button type="button"
                                                        class="btn btn-primary add-row delete_all"
                                                        onclick="deleteSelected()">

                                                    Delete

                                                </button>
                                            </th>

                                            <th>
                                                Title
                                            </th>

                                            <th>
                                                Code
                                            </th>

                                            <th>
                                                Discount
                                            </th>

                                            <th>
                                                Quantity
                                            </th>

                                            <th>
                                                Status
                                            </th>

                                        </tr>

                                    </thead>



                                    <tbody>

                                        @forelse($coupons as $coupon)

                                            <tr data-row-id="{{ $coupon->id }}">

                                                {{-- Checkbox --}}
                                                <td>

                                                    <input class="checkbox_animated check-it"
                                                           type="checkbox"
                                                              value="{{ $coupon->id }}"
                                                           name="coupon_ids[]">

                                                </td>



                                                {{-- Title --}}
                                                <td>

                                                    {{ $coupon->title }}

                                                </td>



                                                {{-- Code --}}
                                                <td>

                                                    {{ $coupon->code }}

                                                </td>



                                                {{-- Discount --}}
                                                <td>

                                                    @if($coupon->discount_type == 'percent')

                                                        {{ $coupon->discount }}%

                                                    @else

                                                        {{ $coupon->discount }}

                                                    @endif

                                                </td>



                                                {{-- Quantity --}}
                                                <td>

                                                    {{ $coupon->quantity ?? 0 }}

                                                </td>



                                                {{-- Status --}}
<td>

                                                                @if($coupon->status == 'waiting')

                                                                    <span class="badge badge-warning">
                                                                        Waiting
                                                                    </span>

                                                                @elseif($coupon->status == 'pending')

                                                                    <span class="badge badge-secondary">
                                                                        Pending
                                                                    </span>

                                                                @elseif($coupon->status == 'success')

                                                                    <span class="badge badge-success">
                                                                        Success
                                                                    </span>

                                                                @endif

                                                            </td>

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>

                                                <td colspan="7" class="text-center">

                                                    No Coupons Found

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

    </div>
    <!-- Container-fluid Ends-->
</div>

            {{-- delete --}}
<form id="deleteForm" method="POST" style="display:none;">

    @csrf
    @method('DELETE')

</form>

<script>

    function deleteSelected()
    {
        let checked = document.querySelector('input[name="coupon_ids[]"]:checked');

        if(!checked)
        {
            alert('Please select coupon');
            return;
        }

        if(confirm('Are you sure want to delete this coupon?'))
        {
            window.location.href =
                "{{ url('/admin/coupons/delete') }}/" + checked.value;
        }
    }

</script>

@endsection

@section('script')
<script>
    // Tostify Notifications
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
