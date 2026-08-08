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
                            Create Menu
                            <small>Multikart Admin panel</small>
                        </h3>
                    </div>
                </div>

                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">

                        <li class="breadcrumb-item">
                            <a href="#">
                                <i data-feather="home"></i>
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            Menus
                        </li>

                        <li class="breadcrumb-item active">
                            Create Menu
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

                    <div class="card-body">

                        <form action="{{ route('admin.menu.store') }}"
                              method="POST">

                            @csrf

                            {{-- Menu Name --}}
                            <div class="form-group row">

                                <label class="col-xl-3 col-md-4">
                                    <span>*</span>
                                    Menu Name
                                </label>

                                <div class="col-md-8">

                                    <input
                                        class="form-control @error('name') is-invalid @enderror"
                                        type="text"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="Enter Menu Name">

                                    @error('name')

                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>

                            </div>



                            {{-- Menu URL --}}
                            <div class="form-group row">

                                <label class="col-xl-3 col-md-4">
                                    URL
                                </label>

                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="url" value="{{ old('url') }}" placeholder="/dashboard">
                                </div>

                            </div>



                            {{-- Menu Icon --}}
                            <div class="form-group row">

                                <label class="col-xl-3 col-md-4">
                                    Icon
                                </label>

                                <div class="col-md-8">

                                    <input
                                        class="form-control"
                                        type="text"
                                        name="icon"
                                        value="{{ old('icon') }}"
                                        placeholder="fa fa-home">

                                </div>

                            </div>



                            {{-- Status --}}
                            <div class="form-group row">

                                <label class="col-xl-3 col-md-4">
                                    Status
                                </label>

                                <div class="col-md-8">

                                    <select name="status" class="form-control">

                                        <option value="waiting">
                                            Waiting
                                        </option>

                                        <option value="pending">
                                            Pending
                                        </option>

                                        <option value="success">
                                            Success
                                        </option>

                                    </select>

                                </div>

                            </div>



                            {{-- Submit --}}
                            <div class="form-group row">

                                <div class="col-md-8 offset-md-3">

                                    <button type="submit"
                                            class="btn btn-primary">

                                        Save Menu

                                    </button>

                                    <a href="{{ route('admin.menu.index') }}"
                                       class="btn btn-secondary">

                                        Back

                                    </a>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- Container-fluid Ends-->

</div>

@endsection
