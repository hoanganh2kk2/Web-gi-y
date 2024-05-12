@extends('layouts.frontend')


@section('CSS')
    <link rel="stylesheet" href="{{asset('commerce/assets/css/responsive.css')}}" />
    <link rel="stylesheet" href="{{asset('commerce/assets/css/style.css')}}" />
@endsection


@section('content')
<!-- Ec Shop page -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="ec-shop-rightside col-lg-9 col-md-12 margin-b-30">
                <!-- Shop Top Start -->
                <div class="ec-pro-list-top d-flex">
                    <div class="col-md-6 ec-grid-list">
                        <div class="ec-gl-btn">
                            <button class="btn btn-grid"><i class="fi-rr-apps"></i></button>
                            <button class="btn btn-list active"><i class="fi-rr-list"></i></button>
                        </div>
                    </div>
                </div>
                <!-- Shop Top End -->

                <!-- Shop content Start -->
                <div class="shop-pro-content">
                    <div class="shop-pro-inner list-view">
                        <div class="row">
                            @if(!empty($products) && !$products->isEmpty())
                                @foreach($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content width-100">
                                <div class="ec-product-inner">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image ec-pro-image-1">
                                            <a href="{{get_link_product($product['slug'])}}" class="image">
                                                <img class="main-image"
                                                     src="{{show_img($product['avatar'])}}" alt="{{$product['name']}}" />
                                                <img class="hover-image"
                                                     src="{{show_img($product['avatar'])}}" alt="{{$product['name']}}" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ec-pro-content">
                                        <h5 class="ec-pro-title" style="padding: 0"><a href="{{get_link_product($product['slug'])}}">{{$product['name']}}</a></h5>
                                        <p class="sp-line-1">Tác giả: {{$product['writen_by']}}</p>
                                        <div class="ec-pro-list-desc"><span class="sp-line-4">{!! $product['description'] !!}</span></div>
                                        <span class="ec-price">
                                                <span class="old-price">{{show_money($product['price'])}}</span>
                                                <span class="new-price">{{show_money($product['sell_price'])}}</span>
                                         </span>
                                    </div>
                                </div>
                            </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <!-- Ec Pagination Start -->
                        @if(!empty($products) && !$products->isEmpty())
                            {!! $products->links() !!}
                        @endif
                    <!-- Ec Pagination End -->
                </div>
                <!--Shop content End -->
            </div>
            <!-- Sidebar Area Start -->
           @include('frontend.sidebar')
        </div>
    </div>
</section>
<!-- End Shop page -->
@endsection


@push('JS')
    <script src="{{asset('commerce/assets/js/vendor/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('commerce/assets/js/main.js')}}"></script>
    <script>
        function directional(link) {
           return  location.replace(link);
        }
        $(function() {
            $('.tv-video').each(function() {
                let image = $(this).attr('data-video');
                $(this).html('<img alt="image" src="https://i.ytimg.com/vi/'+ image +'/hq720.jpg" />');
            });
            $('.tv-video').click(function() {
                $(this).addClass('show');
                let video = $(this).attr('data-video');
                $(this).html('<iframe width="560" height="315" src="https://www.youtube.com/embed/'+ video +'?autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
            });
        });
    </script>
@endpush