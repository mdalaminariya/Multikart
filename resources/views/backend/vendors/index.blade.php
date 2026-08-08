@extends('layouts.backendmaster.master')

@section('content')
<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">

                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Vendor List
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

                        <li class="breadcrumb-item">Vendors</li>
                        <li class="breadcrumb-item active">Vendor List</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->



    <!-- Container-fluid starts-->
    <div class="container-fluid">

        <div class="card">

            <div class="card-header">

                <form class="form-inline search-form search-box">
                    <div class="form-group">
                        <input class="form-control-plaintext"
                            type="search"
                            placeholder="Search..">

                        <span class="d-sm-none mobile-search">
                            <i data-feather="search"></i>
                        </span>
                    </div>
                </form>

                <a href="{{ route('admin.vendors.create') }}"
                    class="btn btn-primary mt-md-0 mt-2">
                    Create Vendor's
                </a>

            </div>


            <div class="card-body vendor-table">

                <table class="display" id="basic-1">

                    <thead>
                        <tr>
                            <th>Vendor</th>
                            <th>Products</th>
                            <th>Store Name</th>
                            <th>Create Date</th>
                            <th>Wallet Balance</th>
                            <th>Revenue</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse ($vendors as $vendor)

                            <tr>

                                <td>
                                    <div class="d-flex vendor-list">
                                        @if (auth()->user()->image == 'default.png')
                                        <img
                                            src="{{ asset('uploads/profile/default/default.png') }}"
                                            alt=""
                                            class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                        @else
                                        <img
                                            src="{{ asset('uploads/profile/' . auth()->user()->image) }}"
                                            alt=""
                                            class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                        @endif

                                        <span>{{ $vendor->name }}</span>

                                    </div>
                                </td>


                                <!--  PRODUCT COUNT -->
                                <td>
                                    Physical:  {{ $vendor->physical_products_count + $vendor->digital_products_count }}
                                    <br>
                                    Digital: {{ $vendor->physical_products_count + $vendor->digital_products_count }}

                                </td>


                                <td>
                                    {{ $vendor->store_name }}
                                </td>


                                <td>
                                    {{ $vendor->created_at->format('d/m/Y') }}
                                </td>


                                <td>
                                    ${{ number_format($vendor->wallet_balance ?? 0, 2) }}
                                </td>


                                <td>
                                    ${{ number_format($vendor->revenue ?? 0, 2) }}
                                </td>


                                <td>

                                    <div class="d-flex align-items-center gap-2 fs-6">
                                        <div style="margin-left: 15px">
                                        <a href="{{ route('admin.vendors.edit', $vendor->id) }}">
                                            <i class="fa fa-edit me-2 font-success"></i>
                                        </a>
                                        </div>
                                        <div>
                                        <a href="{{ route('admin.vendors.delete', $vendor->id) }}"
                                            onclick="return confirm('Are you sure you want to delete this vendor?')">
                                                <i class="fa fa-trash font-danger"></i>
                                        </a>
                                        </div>
                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center">
                                    No Vendor Found
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
    <!-- Container-fluid Ends-->

</div>
@endsection

@section('script')
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
