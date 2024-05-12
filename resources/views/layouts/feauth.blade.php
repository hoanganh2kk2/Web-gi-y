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
    {!! \SEO::generate(true) !!}
    <meta http-equiv="refresh" content="1800">
    <link rel="stylesheet" href="{{asset('commerce/assets/css/vendor/ecicons.min.css')}}" />

    <!-- css All Plugins Files -->
    <link rel="stylesheet" href="{{asset('commerce/assets/css/plugins/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('commerce/assets/css/plugins/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" href="{{asset('commerce/assets/css/plugins/jquery-ui.min.css')}}" />
    <link rel="stylesheet" href="{{asset('commerce/assets/css/plugins/countdownTimer.css')}}" />
    <link rel="stylesheet" href="{{asset('commerce/assets/css/plugins/slick.min.css')}}" />
    <link rel="stylesheet" href="{{asset('commerce/assets/css/plugins/bootstrap.css')}}" />
    <link href="{{url('assets/css/dropify.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    <!-- Main Style -->
    <link rel="stylesheet" href="{{asset('commerce/assets/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('commerce/assets/css/responsive.css')}}" />

    <!-- Background css -->
    <link rel="stylesheet" id="bg-switcher-css" href="{{asset('commerce/assets/css/backgrounds/bg-4.css')}}">
    <link href="{{url('core/io.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    @if(isset($schema) && !empty($schema))
        <script type="application/ld+json">{!! json_encode($schema) !!}</script>
    @endif
<!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GJXZ03EYEP"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-GJXZ03EYEP');
    </script>
</head>
    <body>

{{--    @include('frontend.load')--}}
{{--    @include('frontend.load')--}}

@include('frontend.header')

@include('frontend.cart')

@include('frontend.breadcrumb')

@yield('content')

    @php use Jenssegers\Agent\Agent; $agent = new Agent(); @endphp

    <!-- Footer Start -->
    <footer class="ec-footer section-space-mt mt-3">
        <div class="footer-container">
            <div class="footer-offer">
                <div class="container">
                    <div class="row">
                        <div class="text-center footer-off-msg">
                            @if($agent->isDesktop())
                            <span class="f-cursive">Cảm ơn bạn đã quan tâm. Chúc bạn thật nhiều sức khoẻ.</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->

 @if(!$agent->isDesktop())
@include('frontend.footernavigation')
    @endif

@include('frontend.recent')

<script src="{{asset('commerce/assets/js/vendor/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('commerce/assets/js/vendor/popper.min.js')}}"></script>
<script src="{{asset('commerce/assets/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('commerce/assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
<script src="{{asset('commerce/assets/js/vendor/modernizr-3.11.2.min.js')}}"></script>

    <!--Plugins JS-->
<script src="{{asset('commerce/assets/js/plugins/swiper-bundle.min.js')}}"></script>
<script src="{{asset('commerce/assets/js/plugins/countdownTimer.min.js')}}"></script>
<script src="{{asset('commerce/assets/js/plugins/scrollup.js')}}"></script>
<script src="{{asset('commerce/assets/js/plugins/jquery.zoom.min.js')}}"></script>
<script src="{{asset('commerce/assets/js/plugins/slick.min.js')}}"></script>
<script src="{{asset('commerce/assets/js/plugins/infiniteslidev2.js')}}"></script>
<script src="{{asset('commerce/assets/js/vendor/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('commerce/assets/js/plugins/jquery.sticky-sidebar.js')}}"></script>
    <!-- Google translate Js -->
<script src="{{asset('commerce/assets/js/vendor/google-translate.js')}}"></script>
    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
        }
        {{--$('#ec-news-btn').click(function () {--}}
        {{--    return _POST_FORM('#ec-newsletter-form', '{{route('fe.subscriber', ['cmd' => 'ajax_save'])}}')--}}
        {{--})--}}
        $('.auth-customer').click(function () {
            return  location.replace('{{route('fe.customer')}}');
        })
    </script>
    <!-- Main Js -->
<script src="{{asset('commerce/assets/js/vendor/index.js')}}"></script>
<script src="{{asset('commerce/assets/js/main.js')}}"></script>
<script src="{{url('assets/js/sweetalert2.js')}}"></script>
<script src="{{url('assets/js/select2.min.js')}}"></script>
<script src="{{url('assets/js/notify.js')}}"></script>
<script src="{{url('assets/js/bootstrap-notify.min.js')}}"></script>
<script src="{{url('core/security.js')}}"></script>
<script src="{{url('core/io.js')}}"></script>
@yield('JS')
</body>
</html>