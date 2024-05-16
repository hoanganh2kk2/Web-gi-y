@extends('layouts.frontend')

@section('CSS')
    <link rel="stylesheet" href="{{asset('commerce/assets/css/responsive.css')}}"/>
    <link rel="stylesheet" href="{{asset('commerce/assets/css/style.css')}}"/>
@endsection

@section('content')
    <style>
        .w-in {
            width: inherit;
        }

        .rating {
            display: inline-block;
            height: 10px;
        }

        .rating input {
            display: none;
        }

        .rating label {
            float: right;
            cursor: pointer;
            color: #bbb;
        }

        .rating label:before {
            content: '\2605';
            font-size: 20px;
        }

        .rating input:checked ~ label,
        .rating input:checked ~ label ~ label {
            color: #ffca08;
        }
    </style>
    <!-- Sart Single product -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-pro-rightside ec-common-rightside col-lg-9 order-lg-last col-md-12 order-md-first">

                    <!-- Single product content Start -->
                    <div class="single-pro-block">
                        <div class="single-pro-inner">
                            <div class="row">
                                <div class="single-pro-img" @if(!$agent->isDesktop()) style="width: 100%" @endif>
                                    <div class="single-product-scroll">
                                        <div class="single-product-cover">
                                            @if(!empty($product))
                                                <div class="single-slide zoom-image-hover">
                                                    <img class="img-responsive w-in"
                                                         src="{{show_img($product['avatar'])}}"
                                                         alt="avatar">
                                                </div>
                                                @php $media = json_decode($product['media']) @endphp
                                                @if($media)
                                                    @foreach($media as $k => $item)
                                                        <div class="single-slide zoom-image-hover">
                                                            <img class="img-responsive" src="{{show_img($item)}}"
                                                                 alt="media-{{$k}}">
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </div>
                                        <div class="single-nav-thumb">
                                            @if(!empty($product))
                                                <div class="single-slide">
                                                    <img class="img-responsive" src="{{show_img($product['avatar'])}}"
                                                         alt="avatar">
                                                </div>
                                                @php $media = json_decode($product['media']) @endphp
                                                @if($media)
                                                    @foreach($media as $k => $item)
                                                        <div class="single-slide">
                                                            <img class="img-responsive" src="{{show_img($item)}}"
                                                                 alt="media-{{$k}}">
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="single-pro-desc" @if(!$agent->isDesktop()) style="width: 100%" @endif>
                                    <div class="single-pro-content">
                                        <h5 class="ec-single-title">{{@$product['name']}}</h5>
                                        <div class="ec-single-rating-wrap">
                                            <div class="ec-single-rating">
                                                @for($i = 0; $i < (int)$star; $i++)
                                                    <i class="ecicon eci-star fill"></i>
                                                @endfor
                                                @for($i = 0; $i < 5-(int)$star; $i++)
                                                    <i class="ecicon eci-star-o"></i>
                                                @endfor
                                            </div>
                                            <span class="ec-read-review"><a
                                                        href="#ec-spt-nav-review">Xem thêm sản phẩm</a></span>
                                        </div>
                                        <div class="ec-single-desc f-sans-serif-">{!! @$product['brief'] !!}</div>

                                        <div class="ec-single-price-stoke">
                                            <div class="ec-single-price">
                                                <span class="ec-single-ps-title">Giá bán</span>
                                                <span class="new-price">{{show_money($product['sell_price'])}}</span>
                                            </div>
                                        </div>

                                        <div class="ec-pro-variation">
                                            <div class="ec-pro-variation-inner ec-pro-variation-size">
                                                <span>Kích cỡ</span>
                                                <div class="ec-pro-variation-content">
                                                    <ul>
                                                        @foreach(@$product->size_id as $key => $value)
                                                            <li><span>{{$value['name']}}</span></li>

                                                        @endforeach

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="ec-pro-variation-inner ec-pro-variation-color">
                                                <span>Màu sắc</span>
                                                <div class="ec-pro-variation-content">

                                                    <ul>
                                                        @foreach(@$product->color_id as $key => $value)
                                                            {{--                                                        <li class="active"><span style="background-color:{{$value['code']}}"></span></li>--}}
                                                            <li>
                                                                <span style="background-color:{{$value['code']}}"></span>
                                                            </li>
                                                        @endforeach

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="ec-single-qty">
                                            <div class="qty-plus-minus">
                                                <div class="dec ec_qtybtn ec_qtybtn_dec">-</div>
                                                <input class="qty-input qty-input-{{$product['id']}}" type="text"
                                                       value="1" name="ec_qtybtn">
                                                <div class="inc ec_qtybtn">+</div>
                                            </div>
                                            <div class="ec-single-cart ">
                                                <button onclick="addToCart('{{$product['id']}}')"
                                                        class="btn btn-primary f-sans-serif">Thêm vào giỏ hàng
                                                </button>
                                            </div>
                                        </div>
                                        <div class="ec-single-social">
                                            <ul class="mb-0">
                                                <li class="list-inline-item facebook"><a
                                                            href="{{@$info['facebook']}}"><i
                                                                class="ecicon eci-facebook"></i></a></li>
                                                <li class="list-inline-item twitter"><a
                                                            href="mailto:{{@$info['email']}}"><i
                                                                class="fi fi-rr-envelope"></i></a></li>
                                                <li class="list-inline-item instagram"><a
                                                            href="tel:{{@$info['phone']}}"><i
                                                                class="ecicon eci-phone"></i></a></li>
                                                <li class="list-inline-item youtube-play"><a
                                                            href="{{@$info['youtobe']}}"><i
                                                                class="ecicon eci-youtube-play"></i></a></li>
                                                <li class="list-inline-item behance"><a href="{{@$info['zalo']}}"><i
                                                                class="ecicon eci-whatsapp"></i></a></li>
                                                <li class="list-inline-item plus"><i
                                                            class="ecicon eci-plus"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Single product content End -->
                    <!-- Single product tab start -->
                    <div class="ec-single-pro-tab">
                        <div class="ec-single-pro-tab-wrapper">
                            <div class="ec-single-pro-tab-nav">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab"
                                           data-bs-target="#ec-spt-nav-details" role="tablist">Mô tả sản phẩm</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-review"
                                           role="tablist">Đánh giá</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content ec-single-pro-tab-content">
                                <div id="ec-spt-nav-details" class="tab-pane fade show active">
                                    <div class="ec-single-pro-tab-desc">
                                        <div class="style__Wrapper-sc-6as7kb-0 eba-dki content">
                                            <div class="ToggleContent__Wrapper-sc-fbuwol-1 xbBes">
                                                <div class="ToggleContent__View-sc-fbuwol-0 imwRtb" style="">
                                                    {!! @$product['description'] !!}
                                                </div>
                                                {{--                                        <a class="btn-more" data-view-id="pdp_view_description_button">Thu gọn </a>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="ec-spt-nav-review" class="tab-pane fade">
                                    <div class="row">
                                        <style>
                                            .dZYmgO {
                                                user-select: none;
                                            }
                                            .dZYmgO .review-rating__heading {
                                                margin: 0px 0px 16px;
                                                font-size: 14px;
                                                line-height: 150%;
                                                font-weight: 500;
                                            }
                                            .dZYmgO .review-rating__summary {
                                                display: flex;
                                                -webkit-box-align: center;
                                                align-items: center;
                                            }
                                            .dZYmgO .review-rating__point {
                                                font-size: 32px;
                                                line-height: 40px;
                                                font-weight: 700;
                                                white-space: nowrap;
                                                margin: 0px 16px 0px 0px;
                                            }
                                            .hphKLs {
                                                position: relative;
                                                z-index: 1;
                                                display: inline-block;
                                            }
                                            .dZYmgO .review-rating__stars span:first-child {
                                                margin: 0px 2px 0px 0px;
                                            }
                                            .dZYmgO .review-rating__stars span {
                                                margin: 0px 2px;
                                            }
                                            .hphKLs span {
                                                display: inline-block;
                                                vertical-align: middle;
                                            }
                                            .hphKLs > div {
                                                white-space: nowrap;
                                                overflow: hidden;
                                                position: absolute;
                                                top: 0px;
                                                left: 0px;
                                            }
                                            .dZYmgO .review-rating__total {
                                                margin-top: 1px;
                                                font-weight: 300;
                                                font-size: 14px;
                                                line-height: 150%;
                                                color: rgb(128, 128, 137);
                                            }
                                            .dZYmgO .review-rating__detail {
                                                margin: 12px 0px 0px;
                                            }
                                            .dZYmgO .review-rating__level {
                                                display: flex;
                                                margin: 4px 0px;
                                                -webkit-box-align: center;
                                                align-items: center;
                                            }
                                            .lfisVy {
                                                width: 138px;
                                                height: 6px;
                                                background-color: rgb(245, 245, 250);
                                                position: relative;
                                                z-index: 1;
                                                margin: 0px 8px;
                                                border-radius: 99em;
                                            }
                                            .lfisVy > div {
                                                position: absolute;
                                                left: 0px;
                                                top: 0px;
                                                bottom: 0px;
                                                background-color: rgb(10, 104, 255);
                                                border-radius: 99em;
                                            }
                                            .dZYmgO .review-rating__number {
                                                font-size: 11px;
                                                line-height: 16px;
                                                color: rgb(128, 128, 137);
                                            }
                                        </style>
                                        <div class="style__StyledReviewRating-sc-1y8vww-1 dZYmgO review-rating">
                                            <div class="review-rating__inner">
                                                <div class="review-rating__summary">
                                                    <div class="review-rating__point">4.0</div>
                                                    <div class="review-rating__stars">
                                                        <div class="Stars__StyledStars-sc-12xhw5j-0 hphKLs"
                                                             style="white-space: nowrap;"><span><img alt="star-icon"
                                                                                                     src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                                                     width="24"
                                                                                                     height="24"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                        width="24" height="24"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                        width="24" height="24"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                        width="24" height="24"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/7b/fe/fc/3da9d35ef717692a4b3b345f44e55caf.png"
                                                                        width="24" height="24"></span>
                                                            <div style="width: 80%;"><span><img alt="star-icon"
                                                                                                src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                                                width="24" height="24"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="24" height="24"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="24" height="24"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="24" height="24"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="24" height="24"></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="review-rating__total">(1 đánh giá)</div>
                                                <div class="review-rating__detail">
                                                    <div class="review-rating__level">
                                                        <div class="Stars__StyledStars-sc-12xhw5j-0 hphKLs"
                                                             style="white-space: nowrap;"><span><img alt="star-icon"
                                                                                                     src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                                                     width="14"
                                                                                                     height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                        width="14" height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                        width="14" height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                        width="14" height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                        width="14" height="14"></span>
                                                            <div style="width: 100%;"><span><img alt="star-icon"
                                                                                                 src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                                                 width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span></div>
                                                        </div>
                                                        <div class="style__StyledProcessBar-sc-1y8vww-2 lfisVy">
                                                            <div style="width: 0%;"></div>
                                                        </div>
                                                        <div class="review-rating__number">0</div>
                                                    </div>
                                                    <div class="review-rating__level">
                                                        <div class="Stars__StyledStars-sc-12xhw5j-0 hphKLs"
                                                             style="white-space: nowrap;"><span><img alt="star-icon"
                                                                                                     src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                                                     width="14"
                                                                                                     height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                        width="14" height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                        width="14" height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                        width="14" height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/50/f9/af/0d540e678d0d639d4eba86c1cdd38556.png"
                                                                        width="14" height="14"></span>
                                                            <div style="width: 80%;"><span><img alt="star-icon"
                                                                                                src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                                                width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span></div>
                                                        </div>
                                                        <div class="style__StyledProcessBar-sc-1y8vww-2 lfisVy">
                                                            <div style="width: 100%;"></div>
                                                        </div>
                                                        <div class="review-rating__number">1</div>
                                                    </div>
                                                    <div class="review-rating__level">
                                                        <div class="Stars__StyledStars-sc-12xhw5j-0 hphKLs"
                                                             style="white-space: nowrap;"><span><img alt="star-icon"
                                                                                                     src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                                                     width="14"
                                                                                                     height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                        width="14" height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                        width="14" height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/50/f9/af/0d540e678d0d639d4eba86c1cdd38556.png"
                                                                        width="14" height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/50/f9/af/0d540e678d0d639d4eba86c1cdd38556.png"
                                                                        width="14" height="14"></span>
                                                            <div style="width: 60%;"><span><img alt="star-icon"
                                                                                                src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                                                width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span></div>
                                                        </div>
                                                        <div class="style__StyledProcessBar-sc-1y8vww-2 lfisVy">
                                                            <div style="width: 0%;"></div>
                                                        </div>
                                                        <div class="review-rating__number">0</div>
                                                    </div>
                                                    <div class="review-rating__level">
                                                        <div class="Stars__StyledStars-sc-12xhw5j-0 hphKLs"
                                                             style="white-space: nowrap;"><span><img alt="star-icon"
                                                                                                     src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                                                     width="14"
                                                                                                     height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                        width="14" height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/50/f9/af/0d540e678d0d639d4eba86c1cdd38556.png"
                                                                        width="14" height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/50/f9/af/0d540e678d0d639d4eba86c1cdd38556.png"
                                                                        width="14" height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/50/f9/af/0d540e678d0d639d4eba86c1cdd38556.png"
                                                                        width="14" height="14"></span>
                                                            <div style="width: 40%;"><span><img alt="star-icon"
                                                                                                src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                                                width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span></div>
                                                        </div>
                                                        <div class="style__StyledProcessBar-sc-1y8vww-2 lfisVy">
                                                            <div style="width: 0%;"></div>
                                                        </div>
                                                        <div class="review-rating__number">0</div>
                                                    </div>
                                                    <div class="review-rating__level">
                                                        <div class="Stars__StyledStars-sc-12xhw5j-0 hphKLs"
                                                             style="white-space: nowrap;"><span><img alt="star-icon"
                                                                                                     src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                                                     width="14"
                                                                                                     height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/50/f9/af/0d540e678d0d639d4eba86c1cdd38556.png"
                                                                        width="14" height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/50/f9/af/0d540e678d0d639d4eba86c1cdd38556.png"
                                                                        width="14" height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/50/f9/af/0d540e678d0d639d4eba86c1cdd38556.png"
                                                                        width="14" height="14"></span><span><img
                                                                        alt="star-icon"
                                                                        src="https://salt.tikicdn.com/ts/upload/50/f9/af/0d540e678d0d639d4eba86c1cdd38556.png"
                                                                        width="14" height="14"></span>
                                                            <div style="width: 20%;"><span><img alt="star-icon"
                                                                                                src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                                                width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span><span><img
                                                                            alt="star-icon"
                                                                            src="https://salt.tikicdn.com/ts/upload/e3/f0/86/efd76e1d41c00ad8ebb7287c66b559fd.png"
                                                                            width="14" height="14"></span></div>
                                                        </div>
                                                        <div class="style__StyledProcessBar-sc-1y8vww-2 lfisVy">
                                                            <div style="width: 0%;"></div>
                                                        </div>
                                                        <div class="review-rating__number">0</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ec-t-review-wrapper">
                                            @if(!empty($comments) && !$comments->isEmpty())
                                                @foreach($comments as $k => $comment)
                                                    <div class="ec-t-review-item">
                                                        <div class="ec-t-review-avtar">
                                                            <img width="58px" src="{{asset('assets/images/user.jpeg')}}"
                                                                 alt="comment-{{$k}}"/>
                                                        </div>
                                                        <div class="ec-t-review-content">
                                                            <div class="ec-t-review-top">
                                                                <div class="ec-t-review-name">{{$comment['name']}}</div>
                                                                <div class="ec-t-review-rating">
                                                                    @for($i = 0; $i < (int)$comment['star']; $i++)
                                                                        <i class="ecicon eci-star fill"></i>
                                                                    @endfor
                                                                    @for($i = 0; $i < 5-(int)$comment['star']; $i++)
                                                                        <i class="ecicon eci-star-o"></i>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                            <div class="ec-t-review-bottom">
                                                                <p>{{$comment['comment']}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                                                        <div class="ec-ratting-content">
                                                                            <h3 class="f-sans-serif">Đánh giá</h3>
                                                                            <div class="ec-ratting-form">
                                                                                <form id="form_comment" method="post">
                                                                                    <div class="ec-ratting-star">
                                                                                        <span></span>
                                                                                        <div class="rating clearfix mb-2">
                                                                                            <input type="radio" form="form_comment" id="star5" name="rating[]" checked value="5">
                                                                                            <label for="star5"></label>
                                                                                            <input type="radio" form="form_comment" id="star4" name="rating[]" value="4">
                                                                                            <label for="star4"></label>
                                                                                            <input type="radio" form="form_comment" id="star3" name="rating[]" value="3">
                                                                                            <label for="star3"></label>
                                                                                            <input type="radio" form="form_comment" id="star2" name="rating[]" value="2">
                                                                                            <label for="star2"></label>
                                                                                            <input type="radio" form="form_comment" id="star1" name="rating[]" value="1">
                                                                                            <label for="star1"></label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <h3 class="f-sans-serif">Bình luận</h3>
                                                                                    <div class="ec-ratting-input">
                                                                                        <input name="name" placeholder="Name" type="text" />
                                                                                    </div>
                                                                                    <div class="ec-ratting-input">
                                                                                        <input name="email" placeholder="Email*" type="email"
                                                                                               required />
                                                                                    </div>
                                                                                    <input name="product_id" value="{{$product['id']}}" type="hidden"
                                                                                           required />
                                                                                    <div class="ec-ratting-input form-submit">
                                                                                                <textarea name="comment"
                                                                                                          placeholder="Enter Your Comment"></textarea>
                                                                                        <button class="btn btn-primary f-sans-serif" type="button" id="send_form_comment"
                                                                                        >Gửi đánh giá</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details description area end -->
                </div>
                <!-- Sidebar Area Start -->
                @include('frontend.sidebar')

                <!-- Sidebar Area Start -->
            </div>
        </div>
    </section>
    <!-- End Single product -->

    <!-- Related Product Start -->
    <section class="section ec-releted-product section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Sản phẩm khác</h2>
                        <h2 class="ec-title">Sản phẩm khác</h2>
                        <p class="sub-title f-sans-serif">Các sản phẩm chất lượng khác</p>
                    </div>
                </div>
            </div>
            <div class="row margin-minus-b-30">
                <!-- Related Product Content -->
                @if(!empty($lsProduct) && !$lsProduct->isEmpty())
                    @foreach($lsProduct as $item)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                            <div class="ec-product-inner">
                                <div class="ec-pro-image-outer">
                                    <div class="ec-pro-image ec-pro-image-1">
                                        <a href="{{get_link_product($item['slug'])}}" class="image">
                                            <img class="main-image"
                                                 src="{{show_img($item['avatar'])}}" alt="{{$item['name']}}" width=""/>
                                            <img class="hover-image"
                                                 src="{{show_img($item['avatar'])}}" alt="{{$item['name']}}"/>
                                        </a>

                                        <div class="ec-pro-actions">
                                            <a href="javascript:void (0)"
                                               onclick="_SHOW_FORM_REMOTE('{{route($router_current_name, ['cmd' => 'ajax_load_detail', 'id' => $item['id']])}}')"
                                               class="quickview" data-link-action="quickview" title="Quick view"
                                               data-bs-toggle="modal" data-bs-target="#ec_quickview_modal"><i
                                                        class="fi-rr-eye"></i></a>
                                            <button title="Add To Cart" class="add-to-cart"><i
                                                        class="fi-rr-shopping-basket"></i> Add To Cart
                                            </button>
                                            <a style="bottom: 56px" class="ec-btn-group wishlist" title="Wishlist"><i
                                                        class="fi-rr-heart"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="ec-pro-content">
                                    <h5 class="ec-pro-title" style="padding: 0"><a class="f-sans-serif"
                                                                                   href="{{get_link_product($item['slug'])}}">{{$item['name']}}</a>
                                    </h5>
                                    <span class="ec-price">
                                <span class="old-price">{{show_money($item['price'])}}</span>
                                <span class="new-price">{{show_money($item['sell_price'])}}</span>
                            </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- Related Product end -->
@endsection

@push('JS')
    <script src="{{asset('commerce/assets/js/vendor/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('commerce/assets/js/main.js')}}"></script>
    <script>
        function directional(link) {
            return location.replace(link);
        }

        $(function () {
            $('.tv-video').each(function () {
                let image = $(this).attr('data-video');
                $(this).html(`<img alt="${image}" src="https://i.ytimg.com/vi/'+ image +'/hq720.jpg" />`);
            });
            $('.tv-video').click(function () {
                $(this).addClass('show');
                let video = $(this).attr('data-video');
                $(this).html('<iframe width="560" height="315" src="https://www.youtube.com/embed/' + video + '?autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
            });
        });

        $('#send_form_comment').click(function () {
            return _POST_FORM('#form_comment', '{{route($router_current_name, ['cmd' => 'ajax_save'])}}')
        })

        function addToCart(id) {
            @if(!auth()->check())
                return location.replace('{{route('login')}}')
            @endif
            if (id) {
                let url = '{{route('fe.cart', ['cmd' => 'ajax_add_to_cart'])}}'
                let quantity = $('.qty-input-' + id).val()
                quantity = parseInt(quantity)
                url = setUrlParametersHref(url, 'id', id)
                url = setUrlParametersHref(url, 'quantity', quantity)
                return _POST_FORM('', url, {
                    callback: function (res) {
                        if (res.status === 200) {
                            let val = res.result;
                            let count = val.count
                            let cartItem = val.cartItem
                            let html = ''
                            let value = ''
                            $('.remove-to-cart').remove()
                            $.map(cartItem, function (val) {
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
                            value = value * quantity;
                            cartTotal = convertMoneyToNumber(cartTotal);
                            cartTotal = cartTotal + value
                            cartTotal = formatMoney(cartTotal)
                            $('.all-cart-total').text(cartTotal)
                            show_alert_success(res.msg)
                        }
                    }
                })
            }
        }


        ratingInputs.forEach(input => {
            input.addEventListener('change', () => {
                const rating = input.value;
            });
        });
    </script>
@endpush