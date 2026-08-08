
<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Multikart admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Multikart admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="assets/images/dashboard/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/dashboard/favicon.png" type="image/x-icon">

    <!-- CSS Toastify -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <title>Multikart - Premium Admin Template</title>

    <!-- Google font-->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,500;1,600;1,700;1,800;1,900&display=swap">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">


    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/vendors/font-awesome.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/vendors/themify-icons.css">

    <!-- slick icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/vendors/slick-theme.css">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/vendors/bootstrap.css">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/style.css">

</head>

<body>

    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="authentication-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 p-0 card-left">
                        <div class="card bg-primary mb-0">
                            <div class="single-item">
                                <div>
                                    <div>
                                        <h3>Welcome to Multikart</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been the industry's standard dummy.</p>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <h3>Welcome to Multikart</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been the industry's standard dummy.</p>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <h3>Welcome to Multikart</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been the industry's standard dummy.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 p-0 card-right">
                        <div class="card tab2-card card-login mb-0">
                            <div class="card-body">
                                <div class="tab-content" id="top-tabContent">
                                    <div class="tab-pane fade show active" id="top-profile" role="tabpanel">
                                      <form class="form-horizontal reset-pass auth-form"
                                            method="POST">

                                            @csrf

                                            <h3 class="forgot-title">Forgot Password</h3>

                                            {{-- Email Step --}}
                                            {{-- Email Step --}}
                                            @if(!session('otp_sent') && !session('otp_verified'))

                                                <div class="form-group reset-input">
                                                    <label>
                                                        Enter your email address
                                                    </label>

                                                    <input
                                                        required
                                                        name="email"
                                                        type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        placeholder="Enter your email"
                                                        value="{{ old('email') }}"
                                                    >

                                                    @error('email')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="form-button">
                                                    <button
                                                        formaction="{{ route('forgot.otp.send') }}"
                                                        class="btn btn-primary"
                                                        type="submit">

                                                        Send OTP
                                                    </button>
                                                </div>

                                            {{-- OTP Step --}}
                                            @elseif(session('otp_sent') && !session('otp_verified'))

                                                <input
                                                    type="hidden"
                                                    name="email"
                                                    value="{{ session('email') }}"
                                                >

                                                <div class="form-group reset-input">

                                                    <label>Enter OTP</label>

                                                    <input
                                                        required
                                                        name="otp"
                                                        type="text"
                                                        class="form-control @error('otp') is-invalid @enderror"
                                                        placeholder="Enter OTP"
                                                    >

                                                    @error('otp')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror

                                                </div>

                                                <div class="form-button">
                                                    <button
                                                        formaction="{{ route('forgot.otp.verify') }}"
                                                        class="btn btn-primary"
                                                        type="submit">

                                                        Verify OTP
                                                    </button>
                                                </div>

                                            {{-- Password Step --}}
                                            @elseif(session('otp_verified'))

                                                <input
                                                    type="hidden"
                                                    name="email"
                                                    value="{{ session('email') }}"
                                                >

                                                <input
                                                    type="hidden"
                                                    name="otp"
                                                    value="{{ session('otp') }}"
                                                >

                                                <div class="form-group reset-input">

                                                    <input
                                                        required
                                                        name="password"
                                                        type="password"
                                                        class="form-control"
                                                        placeholder="New Password"
                                                    >

                                                </div>

                                                <div class="form-group reset-input">

                                                    <input
                                                        required
                                                        name="password_confirmation"
                                                        type="password"
                                                        class="form-control"
                                                        placeholder="Confirm Password"
                                                    >

                                                </div>

                                                <div class="form-button">
                                                    <button
                                                        formaction="{{ route('forgot.otp.password.reset') }}"
                                                        class="btn btn-success"
                                                        type="submit">

                                                        Reset Password
                                                    </button>
                                                </div>

                                            @endif

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="login.html" class="btn btn-primary back-btn"><i data-feather="arrow-left"></i>back</a>
            </div>
        </div>
    </div>

    <!-- latest jquery-->
    <script src="{{ asset('backend') }}/assets/js/jquery-3.3.1.min.js"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('backend') }}/assets/js/bootstrap.bundle.min.js"></script>

    <!-- feather icon js-->
    <script src="{{ asset('backend') }}/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/icons/feather-icon/feather-icon.js"></script>

    <!-- Sidebar jquery-->
    <script src="{{ asset('backend') }}/assets/js/sidebar-menu.js"></script>
    <script src="{{ asset('backend') }}/assets/js/slick.js"></script>

    <!-- lazyload js-->
    <script src="{{ asset('backend') }}/assets/js/lazysizes.min.js"></script>

    <!--right sidebar js-->
    <script src="{{ asset('backend') }}/assets/js/chat-menu.js"></script>

      <!-- JS Toastify -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!--script admin-->
    <script src="{{ asset('backend') }}/assets/js/admin-script.js"></script>
    <script>
        $('.single-item').slick({
            arrows: false,
            dots: true
        });
    </script>
    {{-- tostify --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        @if ($errors->any())
            Toastify({
                text: "{{ $errors->first() }}",
                duration: 3000,
                gravity: "top",
                position: "center",
                close: true,
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to center, #ff416c, #ff4b2b)",
                    borderRadius: "10px"
                }
            }).showToast();
        @endif


        @if (session('success'))
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                gravity: "top",
                position: "center",
                close: true,
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to center, #00b09b, #96c93d)",
                    borderRadius: "10px"
                }
            }).showToast();
        @endif


        @if (session('error'))
            Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                gravity: "top",
                position: "center",
                close: true,
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to center, #ff416c, #ff4b2b)",
                    borderRadius: "10px"
                }
            }).showToast();
        @endif

    });
</script>
</body>

</html>
