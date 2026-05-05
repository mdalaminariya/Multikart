@extends('layouts.frontendmaster.master')

@section('content')
     <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <h2>Create account</h2>
            <nav class="theme-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Create account</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--section start-->
    <section class="login-page section-b-space">
        <div class="container">
            <h3>create account</h3>
            <div class="theme-card">
                <form class="theme-form" action="{{ route('register.submit') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-box">
                                <label for="email" class="form-label">First Name</label>
                                <input name="fname" type="text" class="form-control @error('fname') is-invalid @enderror" id="fname" placeholder="First Name">
                                @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-box">
                                <label for="review" class="form-label">Last Name</label>
                                <input name="lname" type="text" class="form-control @error('lname') is-invalid @enderror" id="lname" placeholder="Last Name">
                                @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-box">
                                <label for="email" class="form-label">email</label>
                                <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-box">
                                <label for="password" class="form-label">Password</label>
                                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                placeholder="Enter your password" >
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                     <div class="col-12 d-flex flex-column flex-md-row align-items-md-center justify-content-evenly gap-3">

                        <button type="submit" class="btn btn-solid w-auto"> Create Account</button>

                        {{-- reCAPTCHA --}}
                        <div class="form-group mt-2 mt-md-0">
                            <div class="g-recaptcha"
                                data-sitekey="6LfeKc8sAAAAAEqZpL28nQ-pfYuL8d3kgPZpY6Np"></div>

                            @error('g-recaptcha-response')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--Section ends-->
@endsection
