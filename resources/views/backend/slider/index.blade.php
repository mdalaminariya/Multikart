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
                            Sliders
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
                            Menus
                        </li>

                        <li class="breadcrumb-item active">
                            Sliders
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

                    <!-- Card Header -->
                    <div class="card-header">

                        <div class="row align-items-center">

                            <div class="col-md-6">
                                <h5>Home Sliders</h5>
                            </div>

                            <div class="col-md-6"
                                 style="display: flex; justify-content: flex-end;">

                                <a href="{{ route('admin.sliders.create') }}"
                                   class="btn btn-primary">

                                    <i data-feather="plus"></i>
                                    Add Slider

                                </a>

                            </div>

                        </div>

                    </div>


                    <!-- Card Body -->
                    <div class="card-body">

                        <div class="table-responsive table-desi">

                            <table class="table all-package">

                                <thead>

                                    <tr>

                                        <th>#</th>

                                        <th>Slider Image</th>

                                        <th>Title</th>

                                        <th>Link</th>

                                        <th>Option</th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse ($sliders as $key => $slider)

                                        <tr>

                                            <!-- Number -->
                                            <td>
                                                {{ $key + 1 }}
                                            </td>


                                            <!-- Image -->
                                            <td>

                                                <img
                                                    src="{{ asset('uploads/sliders/' . $slider->image) }}"
                                                    width="120"
                                                    height="60"
                                                    class="img-fluid"
                                                    style="object-fit: cover;"
                                                    alt="{{ $slider->title ?? 'Slider' }}">

                                            </td>


                                            <!-- Title -->
                                            <td>

                                                {{ $slider->title ?? 'No Title' }}

                                            </td>


                                            <!-- Link -->
                                            <td>

                                                {{ $slider->link ?? 'Default Shop' }}

                                            </td>


                                            <!-- Options -->
                                            <td>

                                                <!-- Edit -->
                                                <a href="{{ route('admin.sliders.edit', $slider->id) }}"
                                                   title="Edit">

                                                    <i class="fa fa-edit"></i>

                                                </a>


                                                <!-- Delete -->
                                                <a href="{{ route('admin.sliders.delete', $slider->id) }}"
                                                   title="Delete"
                                                   onclick="return confirm('Are you sure you want to delete this slider?')">

                                                    <i class="fa fa-trash"></i>

                                                </a>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="7"
                                                class="text-center">

                                                No sliders found.

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


        if (typeof feather !== 'undefined') {
            feather.replace();
        }

    });

</script>

@endsection

