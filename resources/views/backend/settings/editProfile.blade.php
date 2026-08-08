@extends('layouts.backendmaster.master')

@section('content')

<div class="page-body">

    <div class="container-fluid">
        <div class="row">

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">

                        <div class="profile-details text-center">

                           @if (auth()->user()->image == 'default.png')
                            <img src="{{ asset('uploads/profile/default/default.png') }}" class="img-fluid img-90 blur-up lazyloaded">
                            @else
                            <img src="{{ asset('uploads/profile/'. auth()->user()->image) }}" class="img-fluid img-90 blur-up lazyloaded">
                            @endif

                            <h5 class="f-w-600 mb-0">
                                {{ $user->fname }} {{ $user->lname }}
                            </h5>

                            <span>{{ $user->email }}</span>

                            <!-- SOCIAL LINKS (DB) -->
                            {{-- <div class="social mt-2">
                                <div class="form-group btn-showcase">

                                    <a href="{{ url('/auth/facebook') }}"
                                    class="btn social-btn btn-fb d-inline-block">
                                        <i class="fa fa-facebook"></i>
                                    </a>

                                    <a href="{{ url('/auth/google') }}"
                                    class="btn social-btn btn-twitter d-inline-block">
                                        <i class="fa fa-google"></i>
                                    </a>

                                    <a href="{{ url('/auth/twitter') }}"
                                    class="btn social-btn btn-google d-inline-block me-0">
                                        <i class="fa fa-twitter"></i>
                                    </a>

                                </div>
                            </div> --}}

                        </div>

                        <hr>

                        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'admin')
                        <!-- EMPLOYEE STATUS (DB) -->
                        <div class="project-status">

                            <h5 class="f-w-600">Employee Status</h5>

                            <div class="media">
                                <div class="media-body">
                                    <h6>
                                        Performance
                                        <span class="pull-right">{{ $setting->performance ?? 0 }}%</span>
                                    </h6>

                                    <div class="progress sm-progress-bar">
                                        <div class="progress-bar bg-primary"
                                             style="width: {{ $setting->performance ?? 0 }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="media">
                                <div class="media-body">
                                    <h6>
                                        Overtime
                                        <span class="pull-right">{{ $setting->overtime ?? 0 }}%</span>
                                    </h6>

                                    <div class="progress sm-progress-bar">
                                        <div class="progress-bar bg-secondary"
                                             style="width: {{ $setting->overtime ?? 0 }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="media">
                                <div class="media-body">
                                    <h6>
                                        Leaves taken
                                        <span class="pull-right">{{ $setting->leaves_taken ?? 0 }}%</span>
                                    </h6>

                                    <div class="progress sm-progress-bar">
                                        <div class="progress-bar bg-danger"
                                             style="width: {{ $setting->leaves_taken ?? 0 }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endif

                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div class="col-xl-8">
                <div class="card tab2-card">
                    <div class="card-body">

                        <!-- TABS -->
                        <ul class="nav nav-tabs nav-material" id="top-tab">

                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#top-profile">
                                    View
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#top-edit">
                                    Edit
                                </a>
                            </li>

                        </ul>

                        <div class="tab-content">

                            <!-- VIEW TAB -->
                            <div class="tab-pane fade show active" id="top-profile">

                                <h5 class="f-w-600">Profile</h5>

                                <table class="table table-borderless">

                                    <tr>
                                        <td>First Name:</td>
                                        <td>{{ $user->fname }}</td>
                                    </tr>

                                    <tr>
                                        <td>Last Name:</td>
                                        <td>{{ $user->lname }}</td>
                                    </tr>

                                    <tr>
                                        <td>Email:</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>

                                    <tr>
                                        <td>Gender:</td>
                                        <td>{{ $setting->gender ?? '' }}</td>
                                    </tr>

                                    <tr>
                                        <td>Phone:</td>
                                        <td>{{ $setting->phone ?? '' }}</td>
                                    </tr>

                                    <tr>
                                        <td>DOB:</td>
                                        <td>{{ $setting->dob ?? '' }}</td>
                                    </tr>

                                    <tr>
                                        <td>Location:</td>
                                        <td>{{ $setting->location ?? '' }}</td>
                                    </tr>

                                </table>

                            </div>

                            <!-- EDIT TAB -->
                            <div class="tab-pane fade" id="top-edit">

                                <h5 class="f-w-600">Edit Profile</h5>

                                <form action="{{ route('admin.account.setting.update') }}"
                                      method="POST"
                                      enctype="multipart/form-data">

                                    @csrf

                                    <table class="table table-borderless">

                                        <tr>
                                            <td>First Name:</td>
                                            <td>
                                                <input type="text" name="fname"
                                                       value="{{ $user->fname }}"
                                                       class="form-control">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Last Name:</td>
                                            <td>
                                                <input type="text" name="lname"
                                                       value="{{ $user->lname }}"
                                                       class="form-control">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Email:</td>
                                            <td>
                                                <input type="email" name="email"
                                                       value="{{ $user->email }}"
                                                       class="form-control">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Gender:</td>
                                            <td>
                                                <label>
                                                    <input type="radio" name="gender" value="Male"
                                                        {{ ($setting->gender ?? '') == 'Male' ? 'checked' : '' }}>
                                                    Male
                                                </label>

                                                <label>
                                                    <input type="radio" name="gender" value="Female"
                                                        {{ ($setting->gender ?? '') == 'Female' ? 'checked' : '' }}>
                                                    Female
                                                </label>

                                                <label>
                                                    <input type="radio" name="gender" value="Other"
                                                        {{ ($setting->gender ?? '') == 'Other' ? 'checked' : '' }}>
                                                    Other
                                                </label>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Phone:</td>
                                            <td>
                                                <input type="text" name="phone"
                                                       value="{{ $setting->phone ?? '' }}"
                                                       class="form-control">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>DOB:</td>
                                            <td>
                                                <input type="date" name="dob"
                                                       value="{{ $setting->dob ?? '' }}"
                                                       class="form-control">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Location:</td>
                                            <td>
                                                <input type="text" name="location"
                                                       value="{{ $setting->location ?? '' }}"
                                                       class="form-control">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <div>
                                                    <div class="d-flex justify-content-center mb-2">
                                                        <img id="preview-image"
                                                            src="{{ !empty($user?->image)
                                                                    ? asset('uploads/profile/'.$user->image)
                                                                    : asset('uploads/profile/default/default.png') }}"
                                                            class="img-fluid img-90">
                                                    </div>

                                                    <div class="mb-2 d-flex align-items-center gap-3">

                                                        <label class="mb-0" style="min-width:80px;">
                                                            Image:
                                                        </label>

                                                        <input type="file" name="image" class="form-control" onchange="previewProfileImage(event)">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    </table>

                                    <button class="btn btn-primary">
                                        Save Changes
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
<script>
function previewProfileImage(event) {

    let reader = new FileReader();

    reader.onload = function () {

        let img = document.getElementById('preview-image');
        if (img) {
            img.src = reader.result;
        }
    }

    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
