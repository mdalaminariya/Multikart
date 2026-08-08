@extends('layouts.backendmaster.master')

@section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Create Coupon
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
                        <li class="breadcrumb-item">Coupons</li>
                        <li class="breadcrumb-item active">Create Coupon</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="card tab2-card">
            <div class="card-body">

                <form action="{{ route('admin.coupons.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <ul class="nav nav-tabs tab-coupon" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show"
                               id="general-tab"
                               data-bs-toggle="tab"
                               href="#general"
                               role="tab">
                                General
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                               id="restriction-tabs"
                               data-bs-toggle="tab"
                               href="#restriction"
                               role="tab">
                                Restriction
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                               id="usage-tab"
                               data-bs-toggle="tab"
                               href="#usage"
                               role="tab">
                                Usage
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">

                        {{-- ================= GENERAL ================= --}}
                        <div class="tab-pane fade active show"
                             id="general"
                             role="tabpanel">

                            <h4 class="mt-4">General</h4>

                            <div class="row">
                                <div class="col-sm-12">

                                    {{-- Coupon Title --}}
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-md-4">
                                            <span>*</span> Coupon Title
                                        </label>

                                        <div class="col-md-7">
                                            <input type="text"
                                                   name="title"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   value="{{ old('title') }}"
                                                   required>

                                            @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Coupon Code --}}
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-md-4">
                                            <span>*</span> Coupon Code
                                        </label>

                                        <div class="col-md-7">
                                            <input type="text"
                                                   name="code"
                                                   class="form-control @error('code') is-invalid @enderror"
                                                   value="{{ old('code') }}"
                                                   required>

                                            @error('code')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Start Date --}}
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-md-4">
                                            Start Date
                                        </label>

                                        <div class="col-md-7">
                                            <input type="date"
                                                   name="start_date"
                                                   class="form-control"
                                                   value="{{ old('start_date') }}">
                                        </div>
                                    </div>

                                    {{-- End Date --}}
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-md-4">
                                            End Date
                                        </label>

                                        <div class="col-md-7">
                                            <input type="date"
                                                   name="end_date"
                                                   class="form-control"
                                                   value="{{ old('end_date') }}">
                                        </div>
                                    </div>

                                    {{-- Free Shipping --}}
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-md-4">
                                            Free Shipping
                                        </label>

                                        <div class="col-md-7">
                                            <div class="checkbox checkbox-primary">
                                                <input id="free_shipping"
                                                       type="checkbox"
                                                       name="free_shipping"
                                                       value="1"
                                                       {{ old('free_shipping') ? 'checked' : '' }}>

                                                <label for="free_shipping">
                                                    Allow Free Shipping
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Quantity --}}
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-md-4">
                                            Quantity
                                        </label>

                                        <div class="col-md-7">
                                            <input type="number"
                                                   name="quantity"
                                                   class="form-control"
                                                   value="{{ old('quantity') }}">
                                        </div>
                                    </div>

                                    {{-- Discount Type --}}
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-md-4">
                                            Discount Type
                                        </label>

                                        <div class="col-md-7">
                                            <select name="discount_type"
                                                    class="custom-select w-100 form-control">

                                                <option value="">--Select--</option>

                                                <option value="percent"
                                                    {{ old('discount_type') == 'percent' ? 'selected' : '' }}>
                                                    Percent
                                                </option>

                                                <option value="fixed"
                                                    {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>
                                                    Fixed
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Discount Amount --}}
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-md-4">
                                            Discount Amount
                                        </label>

                                        <div class="col-md-7">
                                            <input type="number"
                                                   step="0.01"
                                                   name="discount"
                                                   class="form-control"
                                                   value="{{ old('discount') }}">
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

                                </div>
                            </div>
                        </div>

                        {{-- ================= RESTRICTION ================= --}}
                        <div class="tab-pane fade"
                             id="restriction"
                             role="tabpanel">

                            <h4 class="mt-4">Restriction</h4>

                            {{-- Products --}}
                            <div class="form-group row">
                                <label class="col-xl-3 col-md-4">
                                    Products
                                </label>

                                <div class="col-md-7">
                                    <input type="text"
                                           name="products"
                                           class="form-control"
                                           value="{{ old('products') }}">
                                </div>
                            </div>

                            {{-- Category --}}
                            <div class="form-group row">
                                <label class="col-xl-3 col-md-4">
                                    Category
                                </label>

                                <div class="col-md-7">

                                    <select name="category_id"
                                            class="custom-select w-100 form-control">

                                        <option value="">--Select--</option>

                                        {{-- Physical Categories --}}
                                        <optgroup label="Physical Categories">

                                            @forelse($categories as $category)

                                                <option value="{{ $category->id }}">

                                                    {{ $category->name }}

                                                </option>

                                            @empty

                                                <option disabled>
                                                    No Physical Categories
                                                </option>

                                            @endforelse

                                        </optgroup>



                                        {{-- Digital Categories --}}
                                        <optgroup label="Digital Categories">

                                            @forelse($digitalCategories as $digital)

                                                <option value="{{ $digital->id }}">

                                                    {{ $digital->name }}

                                                </option>

                                            @empty

                                                <option disabled>
                                                    No Digital Categories
                                                </option>

                                            @endforelse

                                        </optgroup>

                                    </select>

                                </div>

                            </div>

                            {{-- Minimum Spend --}}
                            <div class="form-group row">
                                <label class="col-xl-3 col-md-4">
                                    Minimum Spend
                                </label>

                                <div class="col-md-7">
                                    <input type="number"
                                           step="0.01"
                                           name="min_spend"
                                           class="form-control"
                                           value="{{ old('min_spend') }}">
                                </div>
                            </div>

                            {{-- Maximum Spend --}}
                            <div class="form-group row">
                                <label class="col-xl-3 col-md-4">
                                    Maximum Spend
                                </label>

                                <div class="col-md-7">
                                    <input type="number"
                                           step="0.01"
                                           name="max_spend"
                                           class="form-control"
                                           value="{{ old('max_spend') }}">
                                </div>
                            </div>

                        </div>

                        {{-- ================= USAGE ================= --}}
                        <div class="tab-pane fade"
                             id="usage"
                             role="tabpanel">

                            <h4 class="mt-4">Usage Limits</h4>

                            {{-- Per Limit --}}
                            <div class="form-group row">
                                <label class="col-xl-3 col-md-4">
                                    Per Limit
                                </label>

                                <div class="col-md-7">
                                    <input type="number"
                                           name="per_limit"
                                           class="form-control"
                                           value="{{ old('per_limit') }}">
                                </div>
                            </div>

                            {{-- Per Customer --}}
                            <div class="form-group row">
                                <label class="col-xl-3 col-md-4">
                                    Per Customer
                                </label>

                                <div class="col-md-7">
                                    <input type="number"
                                           name="per_customer"
                                           class="form-control"
                                           value="{{ old('per_customer') }}">
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary">
                            Save Coupon
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection

@section('script')
<script>
    $('select[name="category_id"]').on('change', function () {

        let selected = $(this).find(':selected').parent('optgroup').attr('label');

        if(selected === 'Physical Categories'){
            $('#category_type').val('physical');
        } else {
            $('#category_type').val('digital');
        }
    });
</script>
@endsection
