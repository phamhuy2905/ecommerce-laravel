
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta charset="utf-8" />
    <title>Easy Shop Online Store </title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />

    <title>Dashboard analytics - Vuexy - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors.min.css') }}">
     <link href="{{ asset('css/datatable/datatables.min.css') }}"  rel="stylesheet" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/tether-theme-arrows.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/tether.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shepherd-theme-default.css') }}">
    <!-- END: Vendor CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/datatable/jquery.dataTables.css') }}"> --}}

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard-analytics.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/card-analytics.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/tour.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/horizontal-menu.css') }}">
    <!-- END: Page CSS-->

    {{-- //toast  --}}
    <link href="{{ asset('css/toastr.css') }}"  rel="stylesheet" >
    <link href="{{ asset('css/toastr1.css') }}"  rel="stylesheet" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    @stack('css')
    <!-- END: Custom CSS-->
    {{-- toast  --}}
    <link rel="stylesheet" href="{{ asset('css/toastify.min.css') }}">

    <style>
        .toastify {
            color: white !important;
        }
        .header-navbar {
            margin-top: 0 !important;
        }
    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">

    <!-- BEGIN: Header-->
    @include('vendor.header')
    <!-- END: Header-->

    <!-- BEGIN: Sidebar-->
    @include('vendor.sidebar')
    <!-- END: Sidebar-->

    <!-- BEGIN: Content-->
    
    <div class="app-content content">
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include('vendor.footer')
    <!-- END: Footer-->
    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('js/vendors.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    {{-- <script src="{{ asset('js/apexcharts.min.js') }}"></script> --}}
    <script src="{{ asset('js/tether.min.js') }}"></script>
    {{-- <script src="{{ asset('js/shepherd.min.js') }}"></script> --}}
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('js/app-menu.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/components.js') }}"></script>

    {{-- toast   --}}
    <script src="{{ asset('js/toastify-js.js') }}"></script>
    <script src="{{ asset('js/validate.js') }}"></script>

    <script src="{{ asset('js/toastr.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"> </script>

    @stack('js')
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    {{-- <script src="{{ asset('js/dashboard-analytics.js') }}"></script> --}}
    <!-- END: Page JS-->
</body>
<!-- END: Body-->

</html>