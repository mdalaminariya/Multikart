@extends('layouts.backendmaster.master')

@section('content')
        <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Product List
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
                                    <li class="breadcrumb-item">Digital</li>
                                    <li class="breadcrumb-item active">Product List</li>
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

                                    <a href="{{ route('admin.digital.product.index') }}" class="btn btn-primary mt-md-0 mt-2">
                                        Add New Product
                                    </a>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive table-desi">
                                        <table class="table list-digital all-package table-category "
                                            id="editableTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Product Image</th>
                                                    <th>Product Title</th>
                                                    <th>Price</th>
                                                    <th>status</th>
                                                    <th>Quantity</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            @forelse($products as $product)
                                                <tr>
                                                    <td>{{ $product->id }}</td>

                                                    <td>
                                                        <img src="{{ asset('uploads/digital/products/' . $product->images) }}" width="80">
                                                    </td>

                                                    <td data-field="name">{{ $product->title }}</td>

                                                    <td data-field="price">{{ $product->price }}</td>

                                                    <td>{{ ucfirst($product->status) }}</td>
                                                    <td data-field="name">
                                                        {{ $product->quantity ?? 'N/A' }}
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('admin.digital.product.edit', $product->id) }}">
                                                            <i class="fa fa-edit" title="Edit"></i>
                                                        </a>

                                                        <a href="{{ route('admin.digital.product.delete', $product->id) }}"
                                                        onclick="return confirm('Are you sure?')">
                                                            <i class="fa fa-trash" title="Delete"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No products found</td>
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
