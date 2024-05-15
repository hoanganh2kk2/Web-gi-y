@extends('layouts.frontend')


@section('content')
@if($agent->isDesktop())
    <div class="ec-main-slider section section-space-pb-30 mt-3">
        <div class="container">
            <div class="ec-slider swiper-container main-slider-nav main-slider-dot">
                <!-- Main slider -->
                <div class="swiper-wrapper">
                @if(@$banners)
                    @php $i = 1 @endphp
                    @foreach($banners as $k => $banner)
                            <div class="ec-slide-item swiper-slide d-flex slide-{{$i+$k}}" style="background-image: url('{{show_img($banner['avatar'])}}')">
                    @endforeach
                @endif
                </div>
                <div class="swiper-pagination swiper-pagination-white"></div>
                <div class="swiper-buttons">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
@endif
        @include('frontend.banner')

        @include('frontend.about')
    <!-- Main Slider End -->

    <!-- Product tab Area Start -->
        <style>
            .ec-pro-image-1 {
                width: fit-content; /* Đặt kích thước khung cố định cho ảnh */
                height: 300px;
                display: flex;
                justify-content: center;
                align-items: center;
                overflow: hidden; /* Ẩn phần ảnh vượt quá kích thước khung */
            }

            .ec-pro-image-1 img {
                max-width: 100%; /* Đảm bảo ảnh không vượt quá kích thước khung */
                max-height: 100%;
                object-fit: contain; /* Đảm bảo hiển thị toàn bộ ảnh */
            }
        </style>
    <section class="section ec-product-tab section-space-p">
        <div class="container">
            <div class="row">

                <!-- Sidebar area start -->
                <div class="ec-side-cat-overlay"></div>
                <div class="col-lg-3 sidebar-dis-991">
                    <div class="cat-sidebar">
                        <div class="cat-sidebar-box">
                            <div class="ec-sidebar-wrap">
                                <!-- Sidebar Category Block -->
                                <div class="ec-sidebar-block">
                                    <div class="ec-sb-title">
                                        <h3 class="ec-sidebar-title f-sans-serif">Danh mục<button class="ec-close">×</button></h3>
                                    </div>
                                    @if(!empty($groupCate) && !$groupCate->isEmpty())
                                        @foreach($groupCate as $k => $cate)
                                            @if(!$k)
                                                @foreach($cate as $item)
                                    <div class="ec-sb-block-content">
                                        <ul>
                                            <li>
                                                <div class="ec-sidebar-block-item"><a class="f-sans-serif sp-line-1"
                                                            href="{{get_link_cate(@$item['slug'])}}">{{$item['name']}}</a></div>
                                                @if(isset($groupCate[$item['id']]))
                                                <ul style="display: block;">
                                                    @foreach($groupCate[$item['id']] as $val)
                                                    <li>
                                                        <div class="ec-sidebar-sub-item "><a class="sp-line-1 f-sans-serif" href="{{get_link_cate(@$val['slug'])}}">{{$val['name']}} </a>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="ec-sidebar-slider">
                            <div class="ec-sb-slider-title f-sans-serif">Sản phẩm bán chạy nhất</div>
                            <div class="ec-sb-pro-sl">
                                @if(!empty($bestSale) && !$bestSale->isEmpty())
                                @foreach($bestSale as $sale)
                                <div>
                                    <div class="ec-sb-pro-sl-item">
                                        <a href="{{get_link_product($sale['slug'])}}" class="sidekka_pro_img"><img
                                                    src="{{show_img($sale['avatar'])}}" alt="{{$sale['name']}}" /></a>
                                        <div class="ec-pro-content">
                                            <h5 class="ec-pro-title"><a href="{{get_link_product($sale['slug'])}}">{{$sale['name']}}</a></h5>
                                            <p class="sp-line-1">Tác giả: {{$sale['writen_by']}}</p>

                                            <span class="ec-price">
                                                <span class="old-price">{{show_money($sale['price'])}}</span>
                                                <span class="new-price">{{show_money($sale['sell_price'])}}</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product area start -->
                <div class="col-lg-9 col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2 class="ec-title f-sans-serif">Sản phẩm mới nhất</h2>
                            </div>
                        </div>

                        <!-- Tab Start -->
                        @if(!empty($catenew) && !$catenew->isEmpty())
                        <div class="col-md-12 ec-pro-tab">
                            <ul class="ec-pro-tab-nav nav justify-content-end">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                                        href="#all">All</a></li>
                                @foreach($catenew as $cate)
                                <li class="nav-item"><a class="nav-link f-sans-serif" data-bs-toggle="tab" href="#{{$cate['slug']}}">{{$cate['name']}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <!-- Tab End -->
                    </div>
                    <div class="row margin-minus-b-15">
                        <div class="col">
                            <div class="tab-content">
                                <!-- 1st Product tab start -->
                                <div class="tab-pane fade show active" id="all">
                                    @if(!empty($newProduct) && !$newProduct->isEmpty())
                                    <div class="row">
                                        @foreach($newProduct as $k => $item)
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-6 ec-product-content">
                                            <div class="ec-product-inner">
                                                <div class="ec-pro-image-outer">
                                                    <div class="ec-pro-image ec-pro-image-1">
                                                        <a href="{{get_link_product($item['slug'])}}" class="image">
                                                            <span class="label veg">
                                                                <span class="dot"></span>
                                                            </span>
                                                            <img class="main-image"
                                                                 src="{{show_img($item['avatar'])}}" alt="{{$item['name']}}" />
                                                            <img class="hover-image"
                                                                 src="{{show_img($item['avatar'])}}" alt="{{$item['name']}} hover" />
                                                        </a>
                                                        <span class="flags">
                                                            @if($k%2 == 0)
                                                            <span class="new">New</span>
                                                            @else
                                                             <span class="sale">Sale</span>
                                                            @endif
                                                        </span>
                                                        <div class="ec-pro-actions">
                                                            <a class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a>
                                                            <a href="javascript:void(0)" class="ec-btn-group quickview" onclick="_SHOW_FORM_REMOTE('{{route('fe.product', ['cmd' => 'ajax_load_detail', 'id' => $item['id']])}}')" data-link-action="quickview" title="Quick view"
                                                               data-bs-toggle="modal" data-bs-target="#ec_quickview_modal"><i class="fi-rr-eye"></i></a>
                                                            <a href="javascript:void(0)" onclick="addToCart('{{$item['id']}}')"  title="Add To Cart" class="ec-btn-group add-to-cart"><i class="fi-rr-shopping-basket"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ec-pro-content">
                                                    <h5 class="ec-pro-title f-sans-serif sp-line-1"><a href="{{get_link_product($item['slug'])}}">{{$item['name']}}</a></h5>

                                                    <div class="ec-pro-rat-price">
                                                        <div class="ec-pro-rating">
                                                            <i class="ecicon eci-star fill"></i>
                                                            <i class="ecicon eci-star fill"></i>
                                                            <i class="ecicon eci-star fill"></i>
                                                            <i class="ecicon eci-star fill"></i>
                                                            <i class="ecicon eci-star"></i>
                                                        </div>
                                                        <span class="ec-price">
                                                            <span class="new-price">{{show_money($item['sell_price'])}}</span>
                                                            <span class="old-price">{{show_money($item['price'])}}</span>
                                                        </span>
{{--                                                        <div class="ec-pro-color">--}}
{{--                                                            <span class="ec-pro-opt-label">Color</span>--}}
{{--                                                            <ul class="ec-opt-swatch ec-change-img">--}}
{{--                                                                <li class="active"><a href="#" class="ec-opt-clr-img"--}}
{{--                                                                                      data-src="assets/images/product-image/6_1.jpg"--}}
{{--                                                                                      data-src-hover="assets/images/product-image/6_1.jpg"--}}
{{--                                                                                      data-tooltip="Gray"><span--}}
{{--                                                                                style="background-color:#e8c2ff;"></span></a></li>--}}
{{--                                                                <li><a href="#" class="ec-opt-clr-img"--}}
{{--                                                                       data-src="assets/images/product-image/6_2.jpg"--}}
{{--                                                                       data-src-hover="assets/images/product-image/6_2.jpg"--}}
{{--                                                                       data-tooltip="Orange"><span--}}
{{--                                                                                style="background-color:#9cfdd5;"></span></a></li>--}}
{{--                                                            </ul>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="ec-pro-size">--}}
{{--                                                            <span class="ec-pro-opt-label">Size</span>--}}
{{--                                                            <ul class="ec-opt-size">--}}
{{--                                                                <li class="active"><a href="#" class="ec-opt-sz"--}}
{{--                                                                                      data-old="$25.00" data-new="$20.00"--}}
{{--                                                                                      data-tooltip="Small">S</a></li>--}}
{{--                                                                <li><a href="#" class="ec-opt-sz" data-old="$27.00"--}}
{{--                                                                       data-new="$22.00" data-tooltip="Medium">M</a></li>--}}
{{--                                                                <li><a href="#" class="ec-opt-sz" data-old="$30.00"--}}
{{--                                                                       data-new="$25.00" data-tooltip="Large">X</a></li>--}}
{{--                                                                <li><a href="#" class="ec-opt-sz" data-old="$35.00"--}}
{{--                                                                       data-new="$30.00" data-tooltip="Extra Large">XL</a></li>--}}
{{--                                                            </ul>--}}
{{--                                                        </div>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                                <!-- ec 1st Product tab end -->
                                <!-- ec 2nd Product tab start -->
                                @if(isset($productn))
                                    @if(!empty($catenew) && !$catenew->isEmpty())
                                    @foreach($catenew as $k => $cate)
                                    <div class="tab-pane fade" id="{{$cate['slug']}}">
                                    <div class="row">
                                        @if(isset($productn[$k][$cate['id']]))
                                            @if(!empty($productn[$k][$cate['id']]))
                                                @foreach($productn[$k][$cate['id']] as $k => $item)
                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                                        <div class="ec-product-inner">
                                                            <div class="ec-pro-image-outer">
                                                                <div class="ec-pro-image ec-pro-image-1">
                                                                    <a href="{{get_link_product($item['slug'])}}" class="image">
                                                            <span class="label veg">
                                                                <span class="dot"></span>
                                                            </span>
                                                                        <img class="main-image"
                                                                             src="{{show_img($item['avatar'])}}" alt="{{$item['name']}}" />
                                                                        <img class="hover-image"
                                                                             src="{{show_img($item['avatar'])}}" alt="{{$item['name']}} hover" />
                                                                    </a>
                                                                    <span class="flags">
                                                            @if($k%2 == 0)
                                                                            <span class="new">New</span>
                                                                        @else
                                                                            <span class="sale">Sale</span>
                                                                        @endif
                                                        </span>
                                                                    <div class="ec-pro-actions">
                                                                        <a class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a>
                                                                        <a href="#" class="ec-btn-group quickview" data-link-action="quickview" title="Quick view"
                                                                           data-bs-toggle="modal" data-bs-target="#ec_quickview_modal"><i class="fi-rr-eye"></i></a>
                                                                        <a href="javascript:void(0)"  title="Add To Cart" class="ec-btn-group add-to-cart"><i class="fi-rr-shopping-basket"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @php $cateProductNew = json_decode($item['category_id']) @endphp
                                                            <div class="ec-pro-content">
                                                                <a href="{{get_link_cate(@$categories[$cateProductNew[0]]['slug'])}}"><h6 class="ec-pro-stitle f-sans-serif">{{@$categories[$cateProductNew[0]]['name']}}</h6></a>
                                                                <h5 class="ec-pro-title f-sans-serif sp-line-1"><a href="{{get_link_product($item['slug'])}}">{{$item['name']}}</a></h5>
                                                                <div class="ec-pro-rat-price">
                                                                    <p class="sp-line-1">Tác giả: {{$item['writen_by']}}</p>
                                                                    <span class="ec-price">
                                                            <span class="new-price">{{show_money($item['price'])}}</span>
                                                            <span class="old-price">{{show_money($item['sell_price'])}}</span>
                                                        </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                    @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row space-t-50">
                        <!-- ec New Arrivals -->
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-6 ec-all-product-content ec-new-product-content margin-b-30" data-animation="fadeIn">
                            <div class="col-md-12">
                                <div class="section-title">
                                    <h2 class="ec-title f-sans-serif">Sản phẩm mới</h2>
                                </div>
                            </div>
                            <div class="ec-new-slider">
                                @if(!empty($newProduct1) && !$newProduct1->isEmpty())
                                    @foreach($newProduct1 as $product)
                                        <div class="col-sm-12 ec-all-product-block">
                                            <div class="ec-all-product-inner">
                                                <div class="ec-pro-image-outer">
                                                    <div class="ec-pro-image">
                                                        <a href="{{get_link_product($product['slug'])}}" class="image">
                                                            <img class="main-image" src="{{show_img($product['avatar'])}}"
                                                                 alt="{{$product['name']}}" />
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="ec-pro-content">
                                                    @php $cateProductNew = json_decode($product['category_id']) @endphp
                                                    <a href="{{get_link_cate(@$categories[$cateProductNew[0]]['slug'])}}"><h5 class="ec-pro-stitle f-sans-serif">{{@$categories[$cateProductNew[0]]['name']}}</h5></a>
                                                    <h6 class="ec-pro-stitle"><a href="{{get_link_product($product['slug'])}}">{{$product['name']}}</a></h6>
                                                    <div class="ec-pro-rat-price">
                                                        <div class="ec-pro-rat-pri-inner">
                                                    <span class="ec-price">
                                                    <span class="old-price">{{show_money($product['price'])}}</span>
                                                    <span class="new-price">{{show_money($product['sell_price'])}}</span>
                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="label veg" title="Veg">
                                            <span class="dot"></span>
                                        </span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <!-- ec Top Selling -->
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-6 ec-all-product-content ec-new-product-content margin-b-30" data-animation="fadeIn">
                            <div class="col-md-12">
                                <div class="section-title">
                                    <h2 class="ec-title f-sans-serif">Bán chạy</h2>
                                </div>
                            </div>
                            <div class="ec-new-slider">
                                @if(!empty($bestSale) && !$bestSale->isEmpty())
                                    @foreach($bestSale as $sale)
                                <div class="col-sm-12 ec-all-product-block">
                                    <div class="ec-all-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="{{get_link_product($sale['slug'])}}" class="image">
                                                    <img class="main-image" src="{{show_img($sale['avatar'])}}"
                                                         alt="{{$sale['name']}}" />
                                                </a>
                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            @php $cateProductNew = json_decode($sale['category_id']) @endphp
                                            <a href="{{get_link_cate(@$categories[$cateProductNew[0]]['slug'])}}"><h5 class="ec-pro-stitle f-sans-serif">{{@$categories[$cateProductNew[0]]['name']}}</h5></a>
                                            <h6 class="ec-pro-stitle"><a href="{{get_link_product($sale['slug'])}}">{{$sale['name']}}</a></h6>
                                            <div class="ec-pro-rat-price">
                                                <div class="ec-pro-rat-pri-inner">
                                                    <span class="ec-price">
                                                    <span class="old-price">{{show_money($sale['price'])}}</span>
                                                    <span class="new-price">{{show_money($sale['sell_price'])}}</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="label veg" title="Veg">
                                            <span class="dot"></span>
                                        </span>
                                    </div>
                                </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <!-- ec Top Rated -->
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-6 ec-all-product-content ec-new-product-content m-auto" data-animation="fadeIn">
                            <div class="col-md-12">
                                <div class="section-title">
                                    <h2 class="ec-title f-sans-serif">Yêu thích</h2>
                                </div>
                            </div>
                            <div class="ec-new-slider">
                                @if(!empty($bestlike) && !$bestlike->isEmpty())
                                    @foreach($bestlike as $like)
                                        <div class="col-sm-12 ec-all-product-block">
                                            <div class="ec-all-product-inner">
                                                <div class="ec-pro-image-outer">
                                                    <div class="ec-pro-image">
                                                        <a href="{{get_link_product($like['slug'])}}" class="image">
                                                            <img class="main-image" src="{{show_img($like['avatar'])}}"
                                                                 alt="{{$like['name']}}" />
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="ec-pro-content">
                                                    @php $cateProductNew = json_decode($like['category_id']) @endphp
                                                    <a href="{{get_link_cate(@$categories[$cateProductNew[0]]['slug'])}}"><h5 class="ec-pro-stitle f-sans-serif">{{@$categories[$cateProductNew[0]]['name']}}</h5></a>
                                                    <h6 class="ec-pro-stitle"><a href="{{get_link_product($like['slug'])}}">{{$like['name']}}</a></h6>
                                                    <div class="ec-pro-rat-price">
                                                        <div class="ec-pro-rat-pri-inner">
                                                    <span class="ec-price">
                                                    <span class="old-price">{{show_money($like['price'])}}</span>
                                                    <span class="new-price">{{show_money($like['sell_price'])}}</span>
                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="label veg" title="Veg">
                                            <span class="dot"></span>
                                        </span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row space-t-50" data-animation="fadeIn">
                        <!--  Special Section Start -->
                        <div class="ec-spe-section col-lg-12 col-md-12 col-sm-12 sectopn-spc-mb">
                            <div class="col-md-12">
                                <div class="section-title">
                                    <h2 class="ec-title f-sans-serif">Sản phẩm bán trong ngày</h2>
                                </div>
                            </div>
                            @if(!empty($newProduct) && !$newProduct->isEmpty())
                                @php $prodctsDay = $newProduct->take(2) @endphp

                             <div class="ec-spe-products">
                                 @foreach($prodctsDay as $k => $day)
                                <div class="ec-spe-product">
                                    <div class="ec-spe-pro-inner">
                                        <div class="ec-spe-pro-image-outer col-md-6 col-sm-12">
                                            <div class="ec-spe-pro-image">
                                                <img class="img-responsive" src="{{show_img($day['avatar'])}}" alt="{{$day['name']}}">
                                            </div>
                                        </div>
                                        <div class="ec-spe-pro-content col-md-6 col-sm-12">
                                            <div class="ec-spe-pro-rating">

                                            </div>
                                            <h5 class="ec-spe-pro-title f-sans-serif"><a href="{{get_link_product($day['slug'])}}">{{$day['name']}}</a></h5>
                                            <div class="ec-spe-pro-desc f-sans-serif sp-line-3">{!! $day['description'] !!}</div>
                                            <div class="ec-spe-price">
                                                <span class="new-price ">{{show_money($day['sell_price'])}}</span>
                                                <span class="old-price">{{show_money($day['price'])}}</span>
                                            </div>
                                            <div class="ec-spe-pro-btn">
                                                <a href="#" class="btn btn-lg btn-primary f-sans-serif">Thêm vào giỏ hàng</a>
                                            </div>
                                            <div class="ec-spe-pro-progress">
                                                <span class="ec-spe-pro-progress-desc"><span>Already Sold:
                                                        <b>{{$k * 17}}</b></span><span>Available: <b>200</b></span></span>
                                                <span class="ec-spe-pro-progressbar"></span>
                                            </div>
                                            <div class="countdowntimer">
                                                <span class="ec-spe-count-desc f-sans-serif"> Ưu đãi sẽ kết thúc sau:</span>
                                                <span id="ec-spe-count-1"></span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                 @endforeach
                             </div>
                            @endif
                        </div>
                        <!--  Special Section End -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ec Product tab Area End -->
@endsection


@push('content')
    <!-- Click To Call -->
    <!-- Click To Call end -->

    <!-- Newsletter Modal Start -->
    <!-- Newsletter Modal end -->
@endpush

@push('JS')
    <script>
        {{--$('#ec-popnews-btn').click(function () {--}}
        {{--    return _POST_FORM('#ec-popnews-form', '{{route('fe.subscriber_phone', ['cmd' => 'ajax_save'])}}')--}}
        {{--})--}}
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

        function addToCart(id){
            @if(!auth()->check())
                return location.replace('{{route('login')}}')
            @endif
            if(id) {
                let url = '{{route('fe.cart', ['cmd' => 'ajax_add_to_cart'])}}'
                url = setUrlParametersHref(url, 'id', id)
                url = setUrlParametersHref(url, 'quantity', 1)
                return _POST_FORM('', url, {callback: function (res){
                        if(res.status === 200) {
                            let val = res.result;
                            let count = val.count
                            let cartItem = val.cartItem
                            let html = ''
                            let value = ''
                            $('.remove-to-cart').remove()
                            $.map(cartItem, function (val){
                                value = val.value
                                html += `<li class="remove-to-cart remove-to-cart-${val.id}">
                    <a href="${get_link_product(val.product_slug)}" class="sidecart_pro_img"><img
                                src="${show_img(val['product_avatar'])}" alt="cart-${val.id}"></a>
                    <div class="ec-pro-content">
                        <a href="${get_link_product(val.product_slug)}" class="cart_pro_title f-sans-serif">${val.product_name}</a>
                        <span class="cart-price"><span class="cart-value-${val.id}">${val.value}</span> x ${val.quantity}</span>
                        <div class="qty-plus-minus">
                            <div onclick="SubtractQuantityCart('${val.id}')" class="dec ec_qtybtn ec_qtybtn_dec">-</div>
                            <input class="qty-input qty-input-cart-value qty-input-{${val.id}" type="text" value="${val.quantity}" name="ec_qtybtn">
                            <div onclick="AddAmountCart('${val.id}')" class="inc ec_qtybtn">+</div>
                        </div>
                        <a href="javascript:void(0)" onclick="clearCartItem('${val.id}')" class="remove">×</a>
                    </div>
                </li>`
                            })
                            $('.appent-to-cart').append(html)
                            $('.cart-count').text(count);
                            let cartTotal = $('.all-cart-total').text()
                            value = parseInt(value);
                            cartTotal = convertMoneyToNumber(cartTotal);
                            cartTotal = cartTotal + value
                            cartTotal = formatMoney(cartTotal)
                            $('.all-cart-total').text(cartTotal)
                            show_alert_success(res.msg)
                        }
                    }})
            }
        }

    </script>
@endpush

