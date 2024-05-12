<div class="ec-shop-leftside col-lg-3 col-md-12">
    <div id="shop_sidebar_1">
        <div class="ec-sidebar-heading">
            <h1 class="f-sans-serif">Tìm kiếm sản phẩm</h1>
        </div>
        <div class="ec-sidebar-wrap">
            <!-- Sidebar Category Block -->
            <div class="ec-sidebar-block">
                <div class="ec-sb-title">
                    <h3 class="ec-sidebar-title">Danh mục</h3>
                </div>
                <div class="ec-sb-block-content">
                    <ul>
                        @if($cateBlock)
                            @foreach($cateBlock as $item)
                                <li>
                                    <div class="ec-sidebar-block-item">
                                        <input type="checkbox" onclick="directional('{{get_link_cate($item['slug'])}}')" @if(get_link_cate($item['slug']) == url()->full()) checked  @endif /> <a href="{{get_link_cate($item['slug'])}}">{{$item['name']}}</a><span
                                                class="checked"></span>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                        <li id="ec-more-toggle-content" style="padding: 0; display: none;">
                            <ul>
                                @if($cateNone)
                                    @foreach($cateNone as $item)
                                        <li>
                                            <div class="ec-sidebar-block-item">
                                                <input type="checkbox" onclick="directional('{{get_link_cate($item['slug'])}}')" @if(get_link_cate($item['slug']) == url()->full()) checked  @endif /> <a href="{{get_link_cate($item['slug'])}}">{{$item['name']}}</a><span
                                                        class="checked"></span>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                        <li>
                            <div class="ec-sidebar-block-item ec-more-toggle">
                                <span class="checked"></span><span id="ec-more-toggle">Xem thêm</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <div id="shop_sidebar_2">
        <div class="ec-sidebar-heading">
            <h1 class="f-sans-serif">Tin sản phẩm</h1>
        </div>
        <div class="ec-sidebar-wrap">
            <!-- Sidebar Category Block -->
            <div class="ec-sidebar-block">
                <div class="ec-sb-title">
                    <h3 class="ec-sidebar-title">Sản phẩm mới nhất</h3>
                </div>
                <div class="ec-sb-block-content">
                    @if(!empty($newProduct) && !$newProduct->isEmpty())
                        @foreach($newProduct as $product)
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

        </div>
    </div>
</div>