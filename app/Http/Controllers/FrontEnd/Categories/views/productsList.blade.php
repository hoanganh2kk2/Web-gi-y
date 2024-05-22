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
{{--                                            <a href="{{get_link_product($product['slug'])}}" class="image">--}}
                                            <a href="" class="image">
                                                <img class="main-image"
                                                     src="{{show_img($product['avatar'])}}" alt="{{$product['name']}}" />
                                                <img class="hover-image"
                                                     src="{{show_img($product['avatar'])}}" alt="{{$product['name']}}" />
                                            </a>
                                            <span class="percentage">{{round(100 - $product['sell_price'] / $product['price']*100)   }}%</span>
                                            <div class="ec-pro-actions">
{{--                                                <a class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a>--}}
{{--                                                <a href="javascript:void(0)" class="ec-btn-group quickview" onclick="_SHOW_FORM_REMOTE('{{route('fe.product', ['cmd' => 'ajax_load_detail', 'id' => $product['id']])}}')" data-link-action="quickview" title="Quick view"--}}
{{--                                                   data-bs-toggle="modal" data-bs-target="#ec_quickview_modal"><i class="fi-rr-eye"></i></a>--}}
                                                <a style="position: relative;top: -220px;" href="javascript:void(0)" onclick="addToCart1('{{$product['id']}}')"  title="Add To Cart" class="ec-btn-group"><i class="fi-rr-shopping-basket"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ec-pro-content">
                                        <h5 class="ec-pro-title" style="padding: 0"><a href="{{get_link_product($product['slug'])}}">{{$product['name']}}</a></h5>
{{--                                        <h5 class="ec-pro-title" style="padding: 0"><a href="{{get_link_product($product['slug'])}}">{{$product['name']}}</a></h5>--}}
                                        <div class="ec-pro-rating">
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star"></i>
                                        </div>
                                        <div class="ec-pro-list-desc"><span class="sp-line-4">{!! $product['brief'] !!}</span></div>
                                        <span class="ec-price">
                                                <span class="old-price">{{show_money($product['price'])}}</span>
                                                <span class="new-price">{{show_money($product['sell_price'])}}</span>
                                         </span>
                                        <div class="ec-pro-variation">
                                            <div class="ec-pro-variation-inner ec-pro-variation-color">
                                                <span>Màu sắc</span>
                                                <div class="ec-pro-color">
                                                    <ul class="color">
                                                        @foreach(@$product->color_id as $key => $value)
                                                            {{--                                                        <li class="active"><span style="background-color:{{$value['code']}}"></span></li>--}}
                                                            <li onclick="activeLi(this)" @if($loop->first) class="active" @endif>
                                                                <span style="background-color:{{$value['code']}}; border: 1px #d9c9c9 solid " data-id="{{$key}}"></span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="ec-pro-size">
                                                <span class="ec-pro-opt-label">Kích cỡ</span>
                                                <ul class="ec-opt-size size">
                                                    @foreach(@$product->size_id as $key => $value)
                                                        <li @if($loop->first) class="active" @endif>
                                                            <a class="ec-opt-sz" data-id="{{$key}}">{{$value['name']}}</a>
                                                        </li>
                                                    @endforeach

                                                    {{--                                                <li class="active"><a href="#" class="ec-opt-sz"--}}
                                                    {{--                                                                      data-old="$25.00" data-new="$20.00"--}}
                                                    {{--                                                                      data-tooltip="Small">S</a></li>--}}
                                                    {{--                                                <li><a href="#" class="ec-opt-sz" data-old="$27.00"--}}
                                                    {{--                                                       data-new="$22.00" data-tooltip="Medium">M</a></li>--}}
                                                    {{--                                                <li><a href="#" class="ec-opt-sz" data-old="$30.00"--}}
                                                    {{--                                                       data-new="$25.00" data-tooltip="Large">X</a></li>--}}
                                                    {{--                                                <li><a href="#" class="ec-opt-sz" data-old="$35.00"--}}
                                                    {{--                                                       data-new="$30.00" data-tooltip="Extra Large">XL</a></li>--}}
                                                </ul>
                                            </div>
                                        </div>


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

        function addToCart1(id) {
            @if(!auth()->check())
                return location.replace('{{route('login')}}')
            @endif
            if (id) {
                const size = document.querySelector('.ec-pro-size .size li.active a').getAttribute('data-id');
                const color = document.querySelector('.ec-pro-color .color li.active span').getAttribute('data-id');

                console.log(1212121)
                // Lặp qua mảng activeSpans để lấy giá trị của từng thẻ <span>
                let url = '{{route('fe.cart', ['cmd' => 'ajax_add_to_cart'])}}'
                // let quantity = $('.qty-input-' + id).val()
                // quantity = parseInt(quantity)
                let quantity = 1
                url = setUrlParametersHref(url, 'id', id)
                url = setUrlParametersHref(url, 'quantity', quantity)
                url = setUrlParametersHref(url, 'color', color)
                url = setUrlParametersHref(url, 'size', size)
                return _POST_FORM('', url, {
                    callback: function (res) {
                        if (res.status === 200) {
                            let val = res.result;
                            let count = val.count
                            let cartItem = val.cartItem
                            console.log(cartItem)
                            let html = ''
                            let value = ''
                            $('.remove-to-cart').remove()
                            $.map(cartItem, function (val) {
                                console.log(12121)
                                value = val.value
                                html += `<li class="remove-to-cart remove-to-cart-${val.id}">
                    <a href="${get_link_product(val.product_slug)}" class="sidecart_pro_img"><img
                                src="${show_img(val['product_avatar'])}" alt="cart-${val.id}"></a>
                    <div class="ec-pro-content">
                        <a href="${get_link_product(val.product_slug)}" class="cart_pro_title f-sans-serif">${val.product_name}</a>
                        <span>${val.size.name}, ${val.color.name}</span>
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

        function activeLi(element){
            const elements  = document.querySelectorAll('li')
            elements.forEach(element => {
                element.classList.remove('active');
            });
            element.classList.add('active');
        }
    </script>
@endpush