@extends('layouts.frontendmaster.master')

@section('content')
     <!-- breadcrumb start -->
     <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <h2>Customer's login</h2>
            <nav class="theme-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Customer's login</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--section start-->
    <section class="login-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Login</h3>
                    <div class="theme-card">
                        <form class="theme-form" action="{{ route('login.submit') }}" method="POST">
                            @csrf
                            <div class="form-box">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="text" class="form-control  @error('email') is-invalid @enderror" id="email" placeholder="Email">

                                @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-box">
                                <label for="password" class="form-label">Password</label>
                                <input name="password" type="password" class="form-control  @error('password') is-invalid @enderror" id="password"
                                    placeholder="Enter your password">

                                    @error('password')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between align-items-center">

                                    <button type="submit" class="btn btn-solid">
                                        Login
                                    </button>

                                    <a href="{{ route('password.request') }}" class="btn btn-link">
                                        Forgot Password?
                                    </a>

                                </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 right-login">
                    <h3>New Customer</h3>
                    <div class="theme-card authentication-right">
                        <h6 class="title-font">Create A Account</h6>
                        <p>Sign up for a free account at our store. Registration is quick and easy. It allows you to be
                            able to order from our shop. To start shopping click register.</p>
                        <a href="{{ route('register') }}" class="btn btn-solid">Create an Account</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->
@endsection

{{-- Toastify Script --}}
@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {

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
