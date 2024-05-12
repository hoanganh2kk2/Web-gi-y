<!-- Modal end -->
    <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-5 col-sm-12 col-xs-12">
                <!-- Swiper -->
                <div class="qty-product-cover">
                    <div class="qty-slide">
                        <img class="img-responsive" src="{{show_img($product['avatar'])}}" alt="{{$product['name']}}">
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-12 col-xs-12">
                <div class="quickview-pro-content">
                    <h5 class="ec-quick-title"><a class="f-sans-serif" href="{{get_link_product($product['slug'])}}">{{$product['name']}}</a></h5>
                    <div class="ec-quickview-rating">

                    </div>

                    <div class="ec-quickview-desc sp-line-3">{!! $product['description'] !!}</div>
                    <div class="ec-quickview-price">
                        <span class="old-price">{{show_money($product['price'])}}</span>
                        <span class="new-price">{{show_money($product['sell_price'])}}</span>
                    </div>

                    <div class="ec-quickview-qty">
                        <div class="qty-plus-minus">
                            <div onclick="SubtractQuantity()" class="dec ec_qtybtn ec_qtybtn_dec">-</div>
                            <input class="qty-input qty-input-{{$product['id']}}" type="text" value="1" name="ec_qtybtn">
                            <div onclick="AddAmount()" class="inc ec_qtybtn">+</div></div>
                        <div class="ec-quickview-cart ">
                            <button onclick="addToCart('{{$product['id']}}')" class="btn btn-primary">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@push('JS')
    <script>
        function addToCart(id){
            @if(!auth()->check())
                return location.replace('{{route('login')}}')
            @endif
            if(id) {
                let url = '{{route('fe.cart', ['cmd' => 'ajax_add_to_cart'])}}'
                let quantity = $('.qty-input-'+id).val()
                quantity = parseInt(quantity)
                url = setUrlParametersHref(url, 'id', id)
                url = setUrlParametersHref(url, 'quantity', quantity)
                return _POST_FORM('', url, {callback: function (res){
                        if(res.status === 200) {
                            let val = res.result;
                            let count = val.count
                            $('.cart-count').text(count);
                            show_alert_success(res.msg)
                        }
                    }})
            }
        }

    </script>
@endpush



