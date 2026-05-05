@extends('layouts.backendmaster.master')

@section('content')
<div class="page-body">

    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Profile
                            <small>Multikart Admin panel</small>
                        </h3>
                    </div>
                </div>

                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="index.html"><i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <!-- LEFT SIDE -->
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
                            <div class="social mt-2">
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
                            </div>

                        </div>

                        <hr>

                         @if (auth()->user()->role == 'admin' || auth()->user()->role == 'admin')
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
                                    Profile
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#top-contact">
                                    Contact
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <!-- PROFILE TAB -->
                            <div class="tab-pane fade show active" id="top-profile">

                                <h5 class="f-w-600">Profile</h5>

                                <div class="table-responsive profile-table">
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
                                            <td>Mobile Number:</td>
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
                            </div>

                            <!-- CONTACT TAB-->
                            <div class="tab-pane fade" id="top-contact">

                                <div class="account-setting">
                                    <h5 class="f-w-600">Notifications</h5>
                                    <div class="row">
                                        <div class="col">

                                            <label class="d-block">
                                                <input type="checkbox" class="checkbox_animated"
                                                       {{ $setting->allow_notifications ? 'checked' : '' }}>
                                                Allow Desktop Notifications
                                            </label>

                                            <label class="d-block">
                                                <input type="checkbox" class="checkbox_animated"
                                                       {{ $setting->enable_notifications ? 'checked' : '' }}>
                                                Enable Notifications
                                            </label>

                                            <label class="d-block">
                                                <input type="checkbox" class="checkbox_animated"
                                                       {{ $setting->own_activity_notification ? 'checked' : '' }}>
                                                Get notification for my own activity
                                            </label>

                                            <label class="d-block">
                                                <input type="checkbox" class="checkbox_animated"
                                                       {{ $setting->dnd ? 'checked' : '' }}>
                                                DND
                                            </label>

                                        </div>
                                    </div>
                                </div>

                                <div class="account-setting deactivate-account">
                                    <h5 class="f-w-600">Deactivate Account</h5>
                                    <button type="button" class="btn btn-primary">
                                        Deactivate Account
                                    </button>
                                </div>

                                <div class="account-setting deactivate-account">
                                    <h5 class="f-w-600">Delete Account</h5>
                                    <button type="button" class="btn btn-primary">
                                        Delete Account
                                    </button>
                                </div>

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
