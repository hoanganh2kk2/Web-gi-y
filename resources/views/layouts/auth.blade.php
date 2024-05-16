<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Themesbrand" name="author"/>
    <meta name="_token" content="{{ csrf_token() }}">
    {!! \SEO::generate(true) !!}
    <link rel="canonical" href="https://xuongquatanginlogo.com/" />
    <link rel="sitemap" type="application/xml" href="{{url('sitemap.xml')}}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{url('assets/images/cinv_logo.png')}}">
    <!-- Animate Css-->
    <link href="{{url('assets/css/animate.min.css')}}" id="app-style" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap Css -->
    <link href="{{url('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{url('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{url('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css"/>

    @yield('CSS')
</head>

<body class="authentication-bg">
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row align-items-center justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            @php
                 $route = \Request::route()->getName();
            @endphp
            <div class="card">
                <div class="card-body p-4">
                    <div class="text-center mt-2">
                        <img src="{{url('assets/images/cinv_logo.png')}}" alt="" height="60" class="logo">
                    </div>

                    <div class="text-center mt-2">
                        <h5 class="text-primary">@if($route == 'login') Welcome Back ! @else Register Account @endif </h5>
                        <p class="text-muted">@if($route == 'login')  @else Get your free Minible account now. @endif  </p>
                    </div>
                    <div class="p-2 mt-4">
                        @yield('content')
                    </div>
                </div>
            </div>
{{--            <div class="mt-5 text-center">--}}
{{--                <p>© <script>document.write(new Date().getFullYear())</script> cininh. Crafted with <i class="mdi mdi-heart text-danger"></i> by cinv</p>--}}
{{--            </div>--}}
        </div>
        </div>
    </div>
</div>

<script src="{{url('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{url('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{url('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{url('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{url('assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{url('assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
<script src="{{url('assets/js/bootstrap-notify.min.js')}}"></script>
<!-- App js -->
<script src="{{url('assets/js/app.js')}}"></script>
<script src="{{url('core/security.js')}}"></script>
<script src="{{url('core/io.js')}}"></script>

@yield('JS')

@stack('JS')

</body>
</html>
