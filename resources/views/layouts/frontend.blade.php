<!DOCTYPE html>
<html lang="vi">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta name="robots" content=”noodp,index,follow” />
    <meta name="revisit-after" content="1 days" />
    <meta http-equiv="content-language" content=”vi” />
    <meta http-equiv="Content-Type" content=”text/html; charset=utf-8″ />
    <meta name="google" content=”nositelinkssearchbox” />
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#ffffff" />
    <meta name="generator" content="xuongquatanginlogo.com">
    <meta http-equiv="refresh" content="1800">
    {!! \SEO::generate(true) !!}
    <meta name="author" content="cinvTeam">
    <meta name="msapplication-TileImage" content="{{asset('assets/images/logo-xuong-qua-tang.png')}}" />
    <!-- site Favicon -->
    <link rel="icon" href="{{asset('assets/images/logo-xuong-qua-tang.png')}}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{asset('assets/images/logo-xuong-qua-tang.png')}}" />
    <!-- css Icon Font -->
    <link rel="stylesheet" href="{{asset('commerce/assets/css/vendor/ecicons.min.css')}}" />
    <link rel="sitemap" type="application/xml" href="{{url('sitemap.xml')}}" />

    <!-- css All Plugins Files -->
    <link rel="stylesheet" href="{{asset('commerce/assets/css/plugins/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('commerce/assets/css/plugins/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" href="{{asset('commerce/assets/css/plugins/jquery-ui.min.css')}}" />
    <link rel="stylesheet" href="{{asset('commerce/assets/css/plugins/countdownTimer.css')}}" />
    <link rel="stylesheet" href="{{asset('commerce/assets/css/plugins/nouislider.css')}}" />
    <link rel="stylesheet" href="{{asset('commerce/assets/css/plugins/slick.min.css')}}" />
    <link rel="stylesheet" href="{{asset('commerce/assets/css/plugins/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('commerce/assets/css/plugins/owl.theme.default.min.css')}}" />
    <link rel="stylesheet" href="{{asset('commerce/assets/css/plugins/bootstrap.css')}}" />
    <link href="{{asset('assets/css/jquery.fancybox.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Main Style -->
    <link rel="stylesheet" href="{{asset('ekka-html/assets/css/demo9.css')}}" />
{{--    <link href="{{asset('core/io.css')}}" id="app-style" rel="stylesheet" type="text/css" />--}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GJXZ03EYEP"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-GJXZ03EYEP');
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8961764925035120"
            crossorigin="anonymous"></script>
    @yield('CSS')
</head>

<body style='font-family: Times New Roman, Times, serif !important '>

{{--@include('frontend.load')--}}

@include('frontend.header')

@include('frontend.cart')



@yield('content')

<div class="face-p">
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>
</div>

@include('frontend.footer')

@stack('content')

@include('frontend.footernavigation')



@if($agent->isDesktop())
@include('frontend.recent')
@endif


<!-- Vendor JS -->
<script src="{{asset('commerce/assets/js/vendor/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('commerce/assets/js/vendor/popper.min.js')}}"></script>
<script src="{{asset('commerce/assets/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('commerce/assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
<script src="{{asset('commerce/assets/js/vendor/modernizr-3.11.2.min.js')}}"></script>

<!--Plugins JS-->

<script src="{{asset('commerce/assets/js/plugins/jquery.sticky-sidebar.js')}}"></script>
<script src="{{asset('commerce/assets/js/plugins/swiper-bundle.min.js')}}"></script>
<script src="{{asset('commerce/assets/js/plugins/countdownTimer.min.js')}}"></script>
<script src="{{asset('commerce/assets/js/plugins/nouislider.js')}}"></script>
<script src="{{asset('commerce/assets/js/plugins/scrollup.js')}}"></script>
<script src="{{asset('commerce/assets/js/plugins/jquery.zoom.min.js')}}"></script>
<script src="{{asset('commerce/assets/js/plugins/slick.min.js')}}"></script>
<script src="{{asset('commerce/assets/js/plugins/owl.carousel.min.js')}}"></script>
<script src="{{asset('commerce/assets/js/plugins/infiniteslidev2.js')}}"></script>
<script src="{{asset('commerce/assets/js/plugins/click-to-call.js')}}"></script>


<!-- Main Js -->
<script src="{{asset('commerce/assets/js/vendor/index.js')}}"></script>
<script src="{{asset('commerce/assets/js/demo-7.js')}}"></script>
<script src="{{asset('assets/js/sweetalert2.js')}}"></script>
<script src="{{asset('assets/js/select2.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('core/security.js')}}"></script>
<script src="{{asset('assets/js/jquery.fancybox.min.js')}}"></script>



<script>
    let chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "105724695707343");
    chatbox.setAttribute("attribution", "biz_inbox");
    window.fbAsyncInit = function() {
        FB.init({
            xfbml            : true,
            version          : 'v16.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    $('.auth-customer').click(function () {
        return  location.replace('{{route('fe.customer')}}');
    })
</script>


@yield('JS')

@stack('JS')
<script src="{{asset('core/io.js')}}"></script>
</body>

</html>