<!-- Ekka Cart Start -->
<div class="ec-side-cart-overlay"></div>
<div id="ec-side-cart" class="ec-side-cart">
    <div class="ec-cart-inner">
        <div class="ec-cart-top">
            <div class="ec-cart-title">
                <span class="cart_title">Giỏ hàng của bạn</span>
                <button class="ec-close">×</button>
            </div>
            <ul class="eccart-pro-items appent-to-cart">
                @php  $cart = get_cart();  $total = 0 ; if($cart) $total = $cart->sum('total') @endphp
                @if($cart)
                    @foreach($cart as $item)
                <li class="remove-to-cart remove-to-cart-{{$item['id']}}">
                    <a href="{{get_link_product($item['product_slug'])}}" class="sidecart_pro_img"><img
                                src="{{show_img($item['product_avatar'])}}" alt="cart-{{$item['id']}}"></a>
                    <div class="ec-pro-content">
                        <a href="{{get_link_product($item['product_slug'])}}" class="cart_pro_title f-sans-serif">{{$item['product_name']}}</a>
                        <span class="cart-price"><span class="cart-value-{{$item['id']}}">{{$item['value']}}</span> x <span class="cart-price-quantity cart-price-quantity-{{$item['id']}}">{{$item['quantity']}}</span></span>
                        <div class="qty-plus-minus">
                            <div onclick="SubtractQuantityCart('{{$item['id']}}')" class="dec ec_qtybtn ec_qtybtn_dec">-</div>
                            <input class="qty-input qty-input-cart-value qty-input-{{$item['id']}}" type="text" value="{{$item['quantity']}}" name="ec_qtybtn">
                            <div onclick="AddAmountCart('{{$item['id']}}')" class="inc ec_qtybtn">+</div>
                        </div>
                        <a href="javascript:void(0)" onclick="clearCartItem('{{$item['id']}}')" class="remove">×</a>
                    </div>
                </li>
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="ec-cart-bottom">
            <div class="cart-sub-total">
                <table class="table cart-table">
                    <tbody>
                    <tr>
                        <td class="text-left f-sans-serif ">Tổng phụ : </td>
                        <td class="text-right all-cart-total">{{show_money($total, 0)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left">VAT (0%) :</td>
                        <td class="text-right">0 đ</td>
                    </tr>
                    <tr>
                        <td class="text-left f-sans-serif ">Tổng tiền :</td>
                        <td class="text-right primary-color all-cart-total">{{show_money($total, 0)}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="cart_btn">
                <a href="{{route('fe.cart', ['cmd' => 'get_cart'])}}" class="btn btn-primary">Giỏ hàng</a>
            </div>
        </div>
    </div>
</div>
<!-- Ekka Cart End -->

@push('JS')
    <script>
        function clearCartItem(id) {
            let url = '{{route('fe.cart', ['cmd' => 'ajax_clear_cart'])}}'
            url = setUrlParametersHref(url, 'id', id)
            return _GET_URL(url, {callback:function (res) {
                    if(res.status === 200) {
                        let cartTotal = $('.all-cart-total').text()
                        let cartValue = $('.cart-value-'+id).text()
                        let cartQuantity = $('.cart-price-quantity-'+id).text()
                        cartValue = parseInt(cartValue);
                        cartQuantity = parseInt(cartQuantity);
                        cartTotal = convertMoneyToNumber(cartTotal);
                        let allTotal = cartValue * cartQuantity
                        cartTotal = cartTotal - allTotal
                        if(cartTotal < 0) {
                            cartTotal = 0
                        }
                        cartTotal = formatMoney(cartTotal)
                        $('.all-cart-total').text(cartTotal)
                        let cart_product_count = $(".eccart-pro-items li").length;
                        $('.remove-to-cart-'+id).remove()
                        if (!cart_product_count) {
                            $('.eccart-pro-items').html('<li><p class="emp-cart-msg">Your cart is empty!</p></li>');
                        }
                        let count = $(".ec-cart-count").html();
                        count--;
                        $(".ec-cart-count").html(count);
                        cart_product_count--;
                        show_alert_success(res.msg)
                    }
                }})
        }

        function SubtractQuantityCart(id){
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
                            let cartTotal = $('.all-cart-total').text()
                            let cartValue = $('.cart-value-'+id).text()
                            cartValue = parseInt(cartValue);
                            cartTotal = convertMoneyToNumber(cartTotal);
                            cartTotal = cartTotal - cartValue
                            cartTotal = formatMoney(cartTotal)
                            $('.all-cart-total').text(cartTotal)
                            if(count < 1) {
                                let length = $('.remove-to-cart').length
                                length = length-1
                                $('.cart-count').text(length)
                                $('.remove-to-cart-'+id).remove()
                            }else {
                                $('.qty-input-' +id).val(count)
                                $('.cart-price-quantity-'+id).text(count)
                            }

                            show_alert_success(res.msg)
                        }
                    }})
            }
        }

        function AddAmountCart(id) {

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
                            $('.qty-input-' +id).val(count)
                            $('.cart-price-quantity-'+id).text(count)
                            let cartTotal = $('.all-cart-total').text()
                            let cartValue = $('.cart-value-'+id).text()
                            cartValue = parseInt(cartValue);
                            cartTotal = convertMoneyToNumber(cartTotal);
                            cartTotal = cartTotal + cartValue
                            cartTotal = formatMoney(cartTotal)
                            $('.all-cart-total').text(cartTotal)
                            show_alert_success(res.msg)
                        }
                    }})
            }
        }


    </script>
@endpush