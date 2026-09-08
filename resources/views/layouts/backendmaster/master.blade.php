<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="Multikart admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Multikart admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('backend') }}/assets/images/dashboard/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('backend') }}/assets/images/dashboard/favicon.png" type="image/x-icon">

        {{-- TinyMCE Editor CDN link --}}
    <script src="https://cdn.tiny.cloud/1/9fok538z63ejkbg4f2ghvqy5xlh9261qil4x73sn89bkq5w8/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>

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
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/vendors/flag-icon.css">

       <!-- Datatables css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/vendors/datatables.css">

    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/vendors/icofont.css">

    <!-- Prism css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/vendors/prism.css">

    <!-- Chartist css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/vendors/chartist.css">

  <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/vendors/owlcarousel.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/vendors/rating.css">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/vendors/bootstrap.css">
<!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/style.css">
    <style>
.zoom-box {
    width: 450px; /* Let the container width be responsive */
    max-width: 736px; /* Set a max width */
    height: auto; /* Allow height to adjust based on the aspect ratio */
    overflow: hidden;
    border-radius: 8px;
    position: relative;
}

.zoom-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
    cursor: zoom-in;
}

.zoom-box:hover img {
    transform: scale(1.3);
}
.product-upload-box{
    position: relative;
    border: 2px dashed hsl(28, 94%, 50%);
    width: 100%;
    height: 420px; /* FIXED HEIGHT */
    border-radius: 10px;
    padding: 20px;
    color: rgb(244, 124, 19);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;

    cursor: pointer;
    overflow: hidden;
    transition: 0.3s;
}
/*  variant color */
.form-control-color{
    padding: 3px;
    height: 38px;
    border-radius: 6px;
}
/* for media */
.custom-dropzone{

        border: 2px dashed #ff7a45;

        border-radius: 8px;

        background: #f8f8f8;

        min-height: 330px;

        display: flex;

        flex-direction: column;

        align-items: center;

        justify-content: center;

        cursor: pointer;

        transition: 0.3s;

    }

    .custom-dropzone:hover{

        background: #f1f1f1;

    }

    .custom-dropzone.dragover{

        background: #ececec;

        border-color: #ff5c1a;

    }

    .upload-icon{

        font-size: 50px;

        color: #ff7a45;

        margin-bottom: 20px;

    }

    /* stats  badge */
    .status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
}

.status-pending {
    background: #fff3cd;
    color: #856404;
}

.status-processing {
    background: #cfe2ff;
    color: #084298;
}

.status-completed {
    background: #d1e7dd;
    color: #0f5132;
}

.status-cancelled {
    background: #f8d7da;
    color: #842029;
}

    </style>
</head>

<body>

    <!-- page-wrapper Start-->
    <div class="page-wrapper">

        <!-- Page Header Start-->
       @include('layouts.backendmaster.header')
        <!-- Page Header Ends -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">

            <!-- Page Sidebar Start-->
            @include('layouts.backendmaster.slider')
            <!-- Page Sidebar Ends-->

                    @yield('content')
            <!-- footer start-->
          @include('layouts.backendmaster.footer')
            <!-- footer end-->
        </div>

    </div>

    <div class="bottom-space"></div>

    <!-- latest jquery-->
    <script src="{{ asset('backend') }}/assets/js/jquery-3.3.1.min.js"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('backend') }}/assets/js/bootstrap.bundle.min.js"></script>

    <!-- feather icon js-->
    <script src="{{ asset('backend') }}/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/icons/feather-icon/feather-icon.js"></script>

    <!-- Sidebar jquery-->
    <script src="{{ asset('backend') }}/assets/js/sidebar-menu.js"></script>

    <!--chartist js-->
    <script src="{{ asset('backend') }}/assets/js/chart/chartist/chartist.js"></script>

    <!--chartjs js-->
    <script src="{{ asset('backend') }}/assets/js/chart/chartjs/chart.min.js"></script>

    <!-- lazyload js-->
    <script src="{{ asset('backend') }}/assets/js/lazysizes.min.js"></script>

    <!--copycode js-->
    <script src="{{ asset('backend') }}/assets/js/prism/prism.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/clipboard/clipboard.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/custom-card/custom-card.js"></script>

    <!--counter js-->
    <script src="{{ asset('backend') }}/assets/js/counter/jquery.waypoints.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/counter/jquery.counterup.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/counter/counter-custom.js"></script>

    <!--peity chart js-->
    <script src="{{ asset('backend') }}/assets/js/chart/peity-chart/peity.jquery.js"></script>

    <!-- Apex Chart Js -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!--sparkline chart js-->
    <script src="{{ asset('backend') }}/assets/js/chart/sparkline/sparkline.js"></script>

     <!-- Rating Js-->
    <script src="{{ asset('backend') }}/assets/js/rating/jquery.barrating.js"></script>
    <script src="{{ asset('backend') }}/assets/js/rating/rating-script.js"></script>

    <!-- Owlcarousel js-->
    <script src="{{ asset('backend') }}/assets/js/owlcarousel/owl.carousel.js"></script>
    <script src="{{ asset('backend') }}/assets/js/dashboard/product-carousel.js"></script>

    <!-- Datatable js-->
    <script src="{{ asset('backend') }}/assets/js/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/datatables/custom-basic.js"></script>

    <!--Customizer admin-->
    <script src="{{ asset('backend') }}/assets/js/admin-customizer.js"></script>

    <!--dashboard custom js-->
    <script src="{{ asset('backend') }}/assets/js/dashboard/default.js"></script>

    <!--right sidebar js-->
    <script src="{{ asset('backend') }}/assets/js/chat-menu.js"></script>

    <!--height equal js-->
    <script src="{{ asset('backend') }}/assets/js/height-equal.js"></script>


    <!-- lazyload js-->
    <script src="{{ asset('backend') }}/assets/js/lazysizes.min.js"></script>

    <!--script admin-->
    <script src="{{ asset('backend') }}/assets/js/admin-script.js"></script>

    <!-- JS Toastify -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>


    @yield('script')

</body>

</html>
