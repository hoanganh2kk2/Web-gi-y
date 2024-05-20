@extends('layouts.frontend')

@section('CSS')
    <link rel="stylesheet" href="{{asset('commerce/assets/css/responsive.css')}}" />
    <link rel="stylesheet" href="{{asset('commerce/assets/css/style.css')}}" />
    <style>
        .select2-container .select2-selection--single {
            height: 48px;
        }
        span#select2-city-container {
            margin-top: 10px;
        }
        span.select2-selection__arrow{
            margin-top: 10px;
        }
        span#select2-districts-container {
            margin-top: 10px;
        }
        span#select2-ward-container {
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')
<!-- Ec cart page -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="ec-cart-leftside col-lg-8 col-md-12 ">
                <!-- cart content Start -->
                <div class="ec-cart-content">
                    <div class="ec-cart-inner">
                        <div class="row">
                            <form action="#">
                                <div class="table-content cart-table-content">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Kích cỡ </th>
                                            <th>Màu sắc </th>
                                            <th>Sản phẩm</th>
                                            <th>Giá</th>
                                            <th style="text-align: center;">Số lượng</th>
                                            <th>Tổng tiền</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($carts) && !$carts->isEmpty())
                                            <input type="hidden" class="cart-count-checkout" value="{{$carts->count()}}">
                                            @foreach($carts as $cart)
                                        <tr class="remove-to-cart-{{$cart['id']}}">
                                            <td data-label="Product" class="ec-cart-pro-name"><a
                                                        href="{{get_link_product($cart['product_slug'])}}"><img
                                                            class="ec-cart-pro-img mr-4 f-sans-serif"
                                                            src="{{show_img($cart['product_avatar'])}}" alt="cart-{{$cart['id']}}" />{{$cart['product_name']}}</a></td>
                                            <td>{{$cart->size->name}}</td>
                                            <td>{{$cart->color->name}}</td>
                                            <td></td>
                                            <td data-label="Price" class="ec-cart-pro-price"><span
                                                        class="amount ">{{show_money($cart['value'])}}</span></td>
                                            <input type="hidden" name="cart-value" class="cart-value-hidden-{{$cart['id']}}" value="{{$cart['value']}}">
                                            <td data-label="Quantity" class="ec-cart-pro-qty" style="text-align: center;">
                                                <div class="cart-qty-plus-minus">
                                                    <input class="cart-plus-minus qty-input-{{$cart['id']}}" type="text"
                                                           name="cartqtybutton" value="{{$cart['quantity']}}" />
                                                    <div class="ec_cart_qtybtn">
                                                        <div onclick="AddAmountCartCheckOut('{{$cart['id']}}')" class="inc ec_qtybtn">+</div>
                                                        <div  onclick="SubtractQuantityCartCheckOut('{{$cart['id']}}')" class="dec ec_qtybtn">-</div></div>
                                                </div>
                                            </td>
                                            <td data-label="Total" class="ec-cart-pro-subtotal "><span class="cart-total-{{$cart['id']}}">{{show_money($cart['total'])}}</span></td>
                                            <td data-label="Remove" class="ec-cart-pro-remove">
                                                <a onclick="clearCartItemCheckOut('{{$cart['id']}}')"  href="javascript:void(0)"><i class="ecicon eci-trash-o"></i></a>
                                            </td>
                                        </tr>
                                            @endforeach
                                        @else
                                            <div class="alert alert-warning fw-bold mb-0" role="alert">
                                                Không tìm thấy thông tin.
                                            </div>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ec-cart-update-bottom">
                                            <a href="{{get_link_cate('san-pham')}}">Mua thêm sản phẩm</a>
                                            <button type="button" id="send_form_card" class="btn btn-primary f-sans-serif">Tạo đơn hàng</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--cart content End -->
            </div>
            <!-- Sidebar Area Start -->
            <div class="ec-cart-rightside col-lg-4 col-md-12">
                <div class="ec-sidebar-wrap">
                    <!-- Sidebar Summary Block -->
                    <div class="ec-sidebar-block">
                        <div class="ec-sb-title">
                            <h3 class="ec-sidebar-title f-sans-serif">Chi tiết đơn</h3>
                        </div>
                        <div class="ec-sb-block-content">
                            <h4 class="ec-ship-title f-sans-serif">Liên hệ mua hàng</h4>
                            <div class="ec-cart-form">
                                <p class="f-sans-serif">Nhập thông tin để chúng tôi có thể liên hệ và giao hàng cho bạn</p>
                                <form id="form_cart" method="post">
                                        <span class="ec-cart-wrap">
                                            <label>Họ tên</label>
                                            <input type="text" name="customer_name" value="{{$customer['name']}}" placeholder="Tên khách hàng">
                                        </span>
                                         <span class="ec-cart-wrap">
                                            <label>Số điện thoại</label>
                                            <input type="text" name="customer_phone" value="{{$customer['phone'] }}" placeholder="Số điện thoại khách hàng">
                                         </span>

                                         <span class="ec-cart-wrap">
                                            <label>Email</label>
                                            <input type="text" name="customer_email" value="{{$customer['email'] }}" placeholder="Email khách hàng">
                                         </span>

                                        <span class="ec-cart-wrap">
                                            <label>Tỉnh/Thành phố *</label>
                                            <span class="ec-cart-select-inner">
                                                <select class="single-select" id="city" name="city">
                                                    <option value="">Vui lòng chọn thông tin</option>
                                                    @foreach($cities as $item)
                                                        <option @if($item['id'] === $customer['city_id']) selected
                                                                @endif
                                                                value="{{$item['id']}}">{{value_show($item['name'])}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </span>
                                        </span>
                                    <span class="ec-cart-wrap">
                                            <label>Quận/Huyện *</label>
                                            <span class="ec-cart-select-inner">
                                                <select class="single-select" id="districts" name="districts">
                                                    <option value="">Vui lòng chọn thông tin</option>
                                                    @if(@$customer)
                                                        <option selected class="districts-ap"
                                                                value="{{@$customer['district_id']}}">{{ @$customer['districts']['name'] }}</option>
                                                    @endif
                                                </select>
                                            </span>
                                        </span>

                                    <span class="ec-cart-wrap">
                                            <label>Xã/Phường *</label>
                                            <span class="ec-cart-select-inner">
                                                 <select class="single-select " id="ward" name="ward">
                                                    <option value="">Vui lòng chọn thông tin</option>
                                                    @if(@$customer)
                                                         <option selected class="wards-ap" value="{{$customer['ward_id']}}">{{ @$customer['ward']['name'] }}</option>
                                                     @endif
                                                </select>
                                            </span>
                                        </span>

                                    <span class="ec-cart-wrap">
                                            <label class="f-sans-serif">Địa chỉ chi tiết</label>
                                          <input name="address" value="{{@$customer['address']}}" class="form-control" placeholder="Địa chỉ chi tiết" type="text">
                                        </span>
                                </form>
                            </div>
                        </div>

                        <div class="ec-sb-block-content">
                            <div class="ec-cart-summary-bottom">
                                <div class="ec-cart-summary">
                                    <div class="ec-cart-summary-total">
                                        <span class="text-left f-sans-serif">Tổng tiền</span>
                                        <span class="text-right all-cart-total">{{show_money($carts->sum('total'))}}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Sidebar Summary Block -->
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@section('JS')
    <script>
        function clearCartItemCheckOut(id) {
            let url = '{{route('fe.cart', ['cmd' => 'ajax_clear_cart'])}}'
            url = setUrlParametersHref(url, 'id', id)
            return _GET_URL(url, {callback:function (res){
                    if(res.status === 200) {
                        let cartTotal = $('.cart-total-'+id).text()
                        $('.remove-to-cart-'+id).remove()
                        let count = $('.cart-count-checkout').val()
                        let total = $('.all-cart-total').text()
                        count = parseInt(count)
                        total = convertMoneyToNumber(total)
                        cartTotal = convertMoneyToNumber(cartTotal)
                        total = total - cartTotal
                        if(total < 0) {
                            total = 0
                        }
                        total = formatMoney(total)
                        count = count-1
                        $('.all-cart-total').text(total)
                        $('.cart-count').text(count)
                        $('.cart-count-checkout').val(count)
                        show_alert_success(res.msg)
                    }
                }})
        }

        function SubtractQuantityCartCheckOut(id){
            @if(!auth()->check())
                return location.replace('{{route('login')}}')
            @endif
            if(id) {
                let url = '{{route('fe.cart', ['cmd' => 'ajax_clear_quantiti_cart'])}}'
                url = setUrlParametersHref(url, 'id', id)
                url = setUrlParametersHref(url, 'quantity', 1)
                return _POST_FORM('', url, {callback: function (res){
                        if(res.status === 200) {
                            let val = res.result;
                            let count  = val.count;
                            let total = $('.all-cart-total').text()
                            let cartTotal = $('.cart-value-hidden-'+id).val()
                            cartTotal =  parseInt(cartTotal)
                            total = convertMoneyToNumber(total)
                            total = total - cartTotal
                            total = formatMoney(total)
                            $('.all-cart-total').text(total)
                            if(count < 1) {
                                let length = $('.remove-to-cart').length
                                length = length-1
                                $('.cart-count').text(length)
                                $('.remove-to-cart-'+id).remove()
                            }else {
                                $('.qty-input-' +id).val(count)
                                let value = cartTotal * count
                                value = formatMoney(value)
                                $('.cart-total-'+id).text(value)
                            }
                            show_alert_success(res.msg)
                        }
                    }})
            }
        }

        function AddAmountCartCheckOut(id) {

            @if(!auth()->check())
                return location.replace('{{route('login')}}')
            @endif
            if(id) {
                let url = '{{route('fe.cart', ['cmd' => 'ajax_add_quantity_to_cart'])}}'
                url = setUrlParametersHref(url, 'id', id)
                url = setUrlParametersHref(url, 'quantity', 1)
                return _POST_FORM('', url, {callback: function (res){
                        if(res.status === 200) {
                            let val = res.result;
                            let count  = val.count;
                            let value = $('.cart-value-hidden-'+id).val()
                            value = parseInt(value)
                            let total = $('.all-cart-total').text()
                            total = convertMoneyToNumber(total)
                            total = total + value
                            total = formatMoney(total)
                            value = value * count
                            value = formatMoney(value)
                            $('.qty-input-' +id).val(count)
                            $('.cart-total-'+id).text(value)
                            $('.all-cart-total').text(total)
                            show_alert_success(res.msg)
                        }
                    }})
            }
        }

        $('#send_form_card').click(function () {
            let url = '{{route($router_current_name, ['cmd' => 'create_order'])}}'
            return _POST_FORM('#form_cart', url)
        })

        $('#city').change(function () {   // load ra quận/huyện
            $('.districts-ap').remove();
            $('.wards-ap').remove();
            let city_id = $('#city').val();
            let city = $('#city option:selected').text();
            $('#change_city').html(city);
            let url = '{{route($router_current_name, ['cmd' => 'ajax_load_district'])}}';
            url = setUrlParameters(url, 'city_id', city_id);
            return _GET_URL(url, {callback:function (res){
                    if(res.status === 200) {
                        let val = res.result;
                        $.map(val, function (val){
                            $('#districts').append(`<option class='districts-ap' value='${val.id}'>${val.name}</option>`)
                        })
                    }else {
                        return show_alert_error(res.msg);
                    }
                }})
        });


        $('#districts').change(function () {   // load ra quận/huyện
            $('.wards-ap').remove();
            let district_id = $('#districts').val();
            let url = '{{route($router_current_name, ['cmd' => 'ajax_load_ward'])}}';
            url = setUrlParameters(url, 'district_id', district_id);
            return _GET_URL(url, {
                callback: function (res) {
                    if (res.status === 200) {
                        let val = res.result
                        $.map(val, function (val) {
                            $('#ward').append(`<option class='wards-ap' value='${val.id}'>${val.name}</option>`)
                        })
                    } else {
                        return show_alert_error(res.msg);
                    }
                }
            })
        });

    </script>
@endsection