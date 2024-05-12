<!-- Modal end -->
<div class="modal-header">
    <span class="f-sans-serif fs-13">Chi tiết đơn hàng</span>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row">
        <table class="table ec-table">
            <thead>
            <tr>
                <th scope="col" class="f-sans-serif">Mã sản phẩm</th>
                <th scope="col" class="f-sans-serif">Sản phẩm</th>
                <th scope="col" class="f-sans-serif">Tên sản phẩm</th>
                <th scope="col" class="f-sans-serif">Giá tiền</th>
                <th scope="col" class="f-sans-serif">Số lượng</th>
                <th scope="col" class="f-sans-serif">Tổng tiền</th>
            </tr>
            </thead>
            <tbody>

            @if(!empty($orderItem) && !$orderItem->isEmpty())
                @foreach($orderItem as $item)
                    <tr>
                        <th scope="row"><span>{{$item['product_sku']}}</span></th>
                        <td><span class="f-sans-serif"><img width="50" src="{{show_img($item['product_avatar'])}}" alt="{{$item['product_name']}}"></span></td>
                        <td><span class="f-sans-serif"><a href="{{get_link_product($item['product_slug'])}}">{{$item['product_name']}}</a></span></td>
                        <td><span class="f-sans-serif">{{show_money($item['value'])}}</span></td>
                        <td><span class="f-sans-serif">{{$item['quantity']}}</span></td>
                        <td><span class="f-sans-serif">{{show_money($item['total'])}}</span></td>
                    </tr>

                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>





