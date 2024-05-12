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
    <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                <div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12">
                    <div class="ec-sidebar-wrap ec-border-box">
                        <!-- Sidebar Category Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-vendor-block">
                                <!-- <div class="ec-vendor-block-bg"></div>
                                <div class="ec-vendor-block-detail">
                                    <img class="v-img" src="assets/images/user/1.jpg" alt="vendor image">
                                    <h5>Mariana Johns</h5>
                                </div> -->
                                <div class="ec-vendor-block-items">
                                    <ul>
                                        <li><a href="{{route('fe.customer')}}">Thông tin cá nhân</a></li>
                                        <li><a class="f-sans-serif" href="{{route('fe.orders')}}">Đơn hàng của bạn</a></li>
                                        <li><a href="{{route('fe.cart', ['cmd' => 'get_cart'])}}">Giỏ hàng</a></li>
                                        <li><a href="javascipt:void(0)" onclick="show_form_reset()">Đổi mật khẩu</a></li>
                                        <li> <form action="{{route('logout')}}" method="post">
                                                @csrf
                                                <button  type="submit" class="btn btn-primary w-100 btnhover btn-sm"><i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Đăng xuất</span></button>
                                            </form></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card">
                        <div class="ec-vendor-card-header">
                            <h5>Đơn hàng của bạn</h5>
                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">
                                <table class="table ec-table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Mã đơn hàng</th>
                                        <th scope="col" class="f-sans-serif">Tên khách hàng</th>
                                        <th scope="col" class="f-sans-serif">Email</th>
                                        <th scope="col" class="f-sans-serif">Số điện thoại</th>
                                        <th scope="col" class="f-sans-serif">Tổng tiền</th>
                                        <th scope="col" class="f-sans-serif">Trạng thái</th>
                                        <th scope="col" class="f-sans-serif">Ngày tạo</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($lsObj) && !$lsObj->isEmpty())
                                        @foreach($lsObj as $item)
                                    <tr>
                                        <th scope="row"><span>{{$item['sku']}}</span></th>
                                        <td><span>{{$item['customer_name']}}</span></td>
                                        <td><span>{{$item['customer_email']}}</span></td>
                                        <td><span>{{$item['customer_phone']}}</span></td>
                                        <td><span>{{show_money($item['total'])}}</span></td>
                                        <td><span>{{$item['status']['name']}}</span></td>
                                        <td><span>{{$item['created_at']}}</span></td>
                                        <td><span class="tbl-btn">
                                                <a href="javascipt:void(0)" onclick="_SHOW_FORM_REMOTE('{{route($router_current_name, ['cmd' => 'ajax_load_detail', 'id' => $item['id']])}}', 'order-detail', 'modal-xl')"
                                                   class="bs-tooltip me-2" data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   title="Chỉnh sửa" data-original-title="Chỉnh sửa"
                                                   data-bs-original-title="Chỉnh sửa" aria-label="Chỉnh sửa">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path
                                                                            d="M11 4.00023H6.8C5.11984 4.00023 4.27976 4.00023 3.63803 4.32721C3.07354 4.61483 2.6146 5.07377 2.32698 5.63826C2 6.27999 2 7.12007 2 8.80023V17.2002C2 18.8804 2 19.7205 2.32698 20.3622C2.6146 20.9267 3.07354 21.3856 3.63803 21.6732C4.27976 22.0002 5.11984 22.0002 6.8 22.0002H15.2C16.8802 22.0002 17.7202 22.0002 18.362 21.6732C18.9265 21.3856 19.3854 20.9267 19.673 20.3622C20 19.7205 20 18.8804 20 17.2002V13.0002M7.99997 16.0002H9.67452C10.1637 16.0002 10.4083 16.0002 10.6385 15.945C10.8425 15.896 11.0376 15.8152 11.2166 15.7055C11.4184 15.5818 11.5914 15.4089 11.9373 15.063L21.5 5.50023C22.3284 4.6718 22.3284 3.32865 21.5 2.50023C20.6716 1.6718 19.3284 1.6718 18.5 2.50022L8.93723 12.063C8.59133 12.4089 8.41838 12.5818 8.29469 12.7837C8.18504 12.9626 8.10423 13.1577 8.05523 13.3618C7.99997 13.5919 7.99997 13.8365 7.99997 14.3257V16.0002Z"
                                                                            stroke="#0184fe" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                </g>
                                                            </svg>
                                               </a>
                                                <a onclick="deleted('{{$item['id']}}', '{{route($router_current_name, ['cmd' => 'deleted'])}}')"
                                                   href="javascript:void(0);"
                                                   class="bs-tooltip confirm-{{$item['id']}}"
                                                   data-bs-toggle="tooltip" data-bs-placement="top"
                                                   title="" data-original-title="Xóa bản ghi"
                                                   data-bs-original-title="Xóa bản ghi"
                                                   aria-label="Xóa bản ghi">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                                 xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path fill="#f50000"
                                                                          d="M20 2h-4v-.85C16 .52 15.48 0 14.85 0h-5.7C8.52 0 8 .52 8 1.15V2H4c-1.1 0-2 .9-2 2 0 .74.4 1.38 1 1.73v14.02C3 22.09 4.91 24 7.25 24h9.5c2.34 0 4.25-1.91 4.25-4.25V5.73c.6-.35 1-.99 1-1.73 0-1.1-.9-2-2-2zm-1 17.75c0 1.24-1.01 2.25-2.25 2.25h-9.5C6.01 22 5 20.99 5 19.75V6h14v13.75z"></path>
                                                                    <path fill="#f50000"
                                                                          d="M8 20.022c-.553 0-1-.447-1-1v-10c0-.553.447-1 1-1s1 .447 1 1v10c0 .553-.447 1-1 1zm8 0c-.553 0-1-.447-1-1v-10c0-.553.447-1 1-1s1 .447 1 1v10c0 .553-.447 1-1 1zm-4 0c-.553 0-1-.447-1-1v-10c0-.553.447-1 1-1s1 .447 1 1v10c0 .553-.447 1-1 1z"></path>
                                                                </g>
                                                            </svg>
                                                        </a>
                                            </span>
                                        </td>
                                    </tr>
                                    <input type="hidden" class="token" name="token"
                                           value="{{build_token(@$item['id'])}}">
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('JS')
    <script>
        function show_form_reset() {
            let _url = '{{route($router_current_name, ['cmd' => 'ajax_show_form_change_password'])}}'
            return _SHOW_FORM_REMOTE(_url, 'show_modal', 'modal-sm')
        }
    </script>
@endpush