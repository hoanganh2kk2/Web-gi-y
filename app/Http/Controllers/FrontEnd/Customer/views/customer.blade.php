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
                <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
                    <div class="ec-vendor-card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="ec-vendor-block-profile">
                                    <div class="ec-vendor-block-img space-bottom-30">
                                        <div class="ec-vendor-block-bg"></div>
                                        <div class="ec-vendor-block-detail">
                                            <img class="v-img" src="{{asset('assets/images/user.jpeg')}}" alt="vendor image">
                                            <h5 class="name">{{$customer['name']}}</h5>
                                        </div>
                                        <p>Xin chào <span class="f-sans-serif">{{$customer['name']}}</span></p>
                                        <p class="f-sans-serif">Từ tài khoản của bạn, bạn có thể dễ dàng xem và theo dõi các đơn đặt hàng. Bạn có thể quản lý và thay đổi thông tin tài khoản của mình như địa chỉ, thông tin liên hệ và lịch sử đặt hàng.</p>
                                    </div>
                                    <h5 class="f-sans-serif">Thông tin cá nhân</h5>
                                    <form id="form_customer">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="ec-vendor-detail-block ec-vendor-block-contact space-bottom-30">
                                                <input name="name" value="{{@$customer['name']}}" class="form-control" placeholder="Họ tên khách hàng" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="ec-vendor-detail-block ec-vendor-block-address mar-b-30 space-bottom-30">
                                                <input name="phone" value="{{@$customer['phone']}}" class="form-control" placeholder="Số điện thoại khách hàng" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="ec-vendor-detail-block ec-vendor-block-address mar-b-30 space-bottom-30">
                                                <select class="single-select" id="city" name="city">
                                                    <option value="">Vui lòng chọn thông tin</option>
                                                    @foreach($cities as $item)
                                                        <option @if($item['id'] === @$customer['city_id']) selected
                                                                @endif
                                                                value="{{$item['id']}}">{{value_show($item['name'])}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="ec-vendor-detail-block ec-vendor-block-address space-bottom-30">
                                                <select class="single-select" id="districts" name="districts">
                                                    <option value="">Vui lòng chọn thông tin</option>
                                                    @if(@$customer)
                                                        <option selected class="districts-ap"
                                                                value="{{@$customer['district_id']}}">{{ @$customer['districts']['name'] }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="ec-vendor-detail-block ec-vendor-block-address space-bottom-30">
                                                <select class="single-select " id="ward" name="ward">
                                                    <option value="">Vui lòng chọn thông tin</option>
                                                    @if(@$customer)
                                                        <option selected class="wards-ap" value="{{@$customer['ward_id']}}">{{ @$customer['ward']['name'] }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="ec-vendor-detail-block ec-vendor-block-email space-bottom-30 space-bottom-30">
                                                <input name="address" value="{{@$customer['address']}}" class="form-control" placeholder="Địa chỉ chi tiết" type="text">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-end">
                                                <button id="send_form_customer" class="btn btn-primary f-sans-serif" type="button">Lưu thông tin</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($customer)
        <input form="form_customer" type="hidden" class="token" name="token" value="{{build_token($customer['id'])}}">
        <input form="form_customer" type="hidden" class="id" name="id" value="{{$customer['id']}}">
    @endif
</section>
@endsection
@push('JS')
  <script>
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

      $('#send_form_customer').click(function () {
          return _POST_FORM('#form_customer', '{{route($router_current_name, ['cmd' => 'ajax_save'])}}')
      })

      function show_form_reset() {
          let _url = '{{route($router_current_name, ['cmd' => 'ajax_show_form_change_password'])}}'
          return _SHOW_FORM_REMOTE(_url, 'show_modal', 'modal-lg')
      }
  </script>
@endpush