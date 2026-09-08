@extends('layouts.backendmaster.master')

@section('content')
    <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Create User
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
                                    <li class="breadcrumb-item">Users </li>
                                    <li class="breadcrumb-item active">Create User </li>
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
                            <div class="card tab2-card">
                                <div class="card-body">
                                    <ul class="nav nav-tabs tab-coupon" id="myTab" role="tablist">
                                        <li class="nav-item"><a class="nav-link active show" id="account-tab"
                                                data-bs-toggle="tab" href="#account" role="tab" aria-controls="account"
                                                aria-selected="true" data-original-title="" title="">Create Account</a></li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade active show" id="account" role="tabpanel"
                                            aria-labelledby="account-tab">
                                            <form class="needs-validation user-add" action="{{ route('admin.vendors.store') }}" method="post" novalidate="">
                                                @csrf
                                                <h4>Account Details</h4>
                                                <div class="form-group row">
                                                    <label for="validationCustom0"
                                                        class="col-xl-3 col-md-4"><span>*</span> First Name</label>
                                                    <div class="col-xl-8 col-md-7">
                                                        <input name="fname" class="form-control @error('fname')
                                                            is-invalid
                                                        @enderror" id="validationCustom0" type="text">
                                                    </div>
                                                    <div class="text-danger d-block mt-1" style="margin-left: 30%">
                                                        @error('fname')
                                                            <small> {{ $message }} </small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="validationCustom1"
                                                        class="col-xl-3 col-md-4"><span>*</span> Last Name</label>
                                                    <div class="col-xl-8 col-md-7">
                                                        <input name="lname" class="form-control @error('lname')
                                                            is-invalid
                                                        @enderror" id="validationCustom1" type="text">
                                                    </div>
                                                    <div class="text-danger d-block mt-1" style="margin-left: 30%">
                                                        @error('lname')
                                                            <small> {{ $message }} </small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="validationCustom2"
                                                        class="col-xl-3 col-md-4"><span>*</span> Email</label>
                                                    <div class="col-xl-8 col-md-7">
                                                        <input name="email" class="form-control @error('email')
                                                        is-invalid
                                                        @enderror" id="validationCustom2" type="text">
                                                    </div>
                                                    <div class="text-danger d-block mt-1" style="margin-left: 30%">
                                                        @error('email')
                                                            <small> {{ $message }} </small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="validationCustom3"
                                                        class="col-xl-3 col-md-4"><span>*</span> Password</label>
                                                    <div class="col-xl-8 col-md-7">
                                                        <input name="password" class="form-control @error('password')
                                                        is-invalid
                                                        @enderror" id="validationCustom3" type="password">
                                                    </div>
                                                    <div class="text-danger d-block mt-1" style="margin-left: 30%">
                                                        @error('password')
                                                            <small> {{ $message }} </small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="validationCustom3"
                                                        class="col-xl-3 col-md-4"><span>*</span> role</label>
                                                    <div class="col-xl-8 col-md-7">
                                                       <select class="form-select @error('role')
                                                        is-invalid
                                                       @enderror" name="role">
                                                            <option value="">Select Roles</option>
                                                            <option value="vendor">Vendor</option>
                                                       </select>
                                                    </div>
                                                     <div class="text-danger d-block mt-1" style="margin-left: 30%">
                                                        @error('role')
                                                            <small> {{ $message }} </small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="pull-right">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>

@endsection
