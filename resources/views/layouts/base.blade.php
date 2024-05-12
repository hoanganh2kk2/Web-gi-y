<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content=”noodp,index,follow” />
    <meta name="revisit-after" content="1 days" />
    <meta http-equiv="content-language" content=”vi” />
    <meta http-equiv="Content-Type" content=”text/html; charset=utf-8″ />
    <meta name="google" content=”nositelinkssearchbox” />
    {!! \SEO::generate(true) !!}
    <link rel="shortcut icon" href="{{url('assets/images/logo-xuong-qua-tang.png')}}">

    <!-- Animate Css-->
    <link href="{{url('assets/css/animate.min.css')}}" id="app-style" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap Css -->
    <link href="{{url('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{url('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{url('assets/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{url('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    <link href="{{url('assets/css/dropify.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />


    <link href="{{url('core/io.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    @yield('CSS')

</head>

<body>
<div id="layout-wrapper">
    @include('backend.header')
    <!-- ========== Left Sidebar Start ========== -->
    @include('backend.menu')
    <!-- Left Sidebar End -->

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                 @include('backend.breadcrumb')
                <!-- end page title -->
                @yield('content')

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        @include('backend.footer')
    </div>
</div>

<!-- JAVASCRIPT -->
<script src="{{url('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{url('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('assets/js/sweetalert2.js')}}"></script>
<script src="{{url('assets/js/select2.min.js')}}"></script>
<script src="{{url('assets/js/notify.js')}}"></script>
<script src="{{url('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{url('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{url('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{url('assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{url('assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>

<script src="{{url('assets/js/pages/form-advanced.init.js')}}"></script>
<script src="{{url('assets/js/tinymce.min.js')}}"></script>


<!-- apexcharts -->
<script src="{{url('assets/js/dropify.min.js')}}"></script>

<script src="{{url('assets/js/pages/dashboard.init.js')}}"></script>
<script src="{{url('assets/js/bootstrap-notify.min.js')}}"></script>


<!-- App js -->
<script src="{{url('assets/js/app.js')}}"></script>
<script src="{{url('core/security.js')}}"></script>
<script src="{{url('core/io.js')}}"></script>


@yield('JS')

@stack('JS')

</body>

</html>
