@extends('layouts.backendmaster.master')

@section('content')
<div class="page-body">
    <div class="container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Create Page
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
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item active">Create Page</li>
                    </ol>
                </div>
            </div>
        </div>

    </div>

    <div class="container-fluid">

        <div class="card tab2-card">

            <div class="card-body">

                {{-- FORM START --}}
                <form class="needs-validation"
                      method="POST"
                      action="{{ route('admin.pages.store') }}">

                    @csrf

                    <ul class="nav nav-tabs tab-coupon" id="myTab" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active show"
                               id="general-tab"
                               data-bs-toggle="tab"
                               href="#general">
                                General
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                               id="seo-tabs"
                               data-bs-toggle="tab"
                               href="#seo">
                                SEO
                            </a>
                        </li>

                    </ul>

                    <div class="tab-content" id="myTabContent">

                        {{-- GENERAL TAB --}}
                        <div class="tab-pane fade active show"
                             id="general">

                            <h4>General</h4>

                            {{-- NAME --}}
                            <div class="form-group row">
                                <label class="col-xl-3 col-md-4">
                                    <span>*</span> Name
                                </label>

                                <div class="col-xl-8 col-md-7">
                                    <input class="form-control"
                                           name="name"
                                           type="text"
                                           required>
                                </div>
                            </div>

                            {{-- DESCRIPTION --}}
                            <div class="form-group row editor-label">
                                <label class="col-xl-3 col-md-4">
                                    <span>*</span> Description
                                </label>

                                <div class="col-xl-8 col-md-7">
                                    <div class="editor-space">
                                        <textarea id="editor1"
                                                  name="description"
                                                  cols="30"
                                                  rows="10"></textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- STATUS --}}
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

                        {{-- SEO TAB --}}
                        <div class="tab-pane fade"
                             id="seo">

                            <h4>SEO</h4>

                            {{-- META TITLE --}}
                            <div class="form-group row">
                                <label class="col-xl-3 col-md-4">
                                    Meta Title
                                </label>

                                <div class="col-xl-8 col-md-7">
                                    <input class="form-control"
                                           name="meta_title"
                                           type="text">
                                </div>
                            </div>

                            {{-- META DESCRIPTION --}}
                            <div class="form-group row editor-label">
                                <label class="col-xl-3 col-md-4">
                                    Meta Description
                                </label>

                                <div class="col-xl-8 col-md-7">
                                    <textarea rows="4" id="editor2"
                                              class="form-control"
                                              name="meta_description"></textarea>
                                </div>
                            </div>

                        </div>

                    </div>

                    {{-- SAVE BUTTON --}}
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>

                </form>
                {{-- FORM END --}}

            </div>

        </div>

    </div>

</div>
@endsection

@section('script')
{{-- TINYMCE --}}
<script>
tinymce.init({
    selector: '#editor1'
});
tinymce.init({
    selector: '#editor2'
});
</script>
@endsection
