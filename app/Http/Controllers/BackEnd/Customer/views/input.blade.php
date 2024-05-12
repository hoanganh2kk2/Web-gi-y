@extends('layouts.base')


@section('content')
    <form id="info_user">
        <div class="row">
            <div class="col-sm-12 col-xl-7">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Thông tin cơ bản</h4>
                    </div>
                    <div class="card-body form-steps">
                        <div class="tab-content p-0">
                            <div class="row">
                                <div class="col-12  my-2">
                                    <label class="form-label">Tên khách hàng</label>
                                    <input name="name" value="{{@$obj['name']}}" type="text" class="form-control" placeholder="Tên khách hàng">
                                </div>
                                <div class="col-12 my-2">
                                    <label class="form-label">Tài khoản/Email</label>
                                    <input name="email" value="{{@$obj['email']}}" type="text" class="form-control" placeholder="Tài khoản">
                                </div>
                                <div class="col-12 my-2">
                                    <label class="form-label">Mật Khẩu</label>
                                    <input type="password" name="password"  class="form-control" id="profession" placeholder="Nhập mật khẩu">
                                </div>
                                <div class="my-2">
                                    <label for="name_post" class="form-label">Trạng thái: </label>
                                    <select class="single-select" id="status" name="status">
                                        <option value="">Vui lòng chọn thông tin</option>
                                        @foreach($status as $item)
                                            <option @if($item['id'] === @$obj['status']['id']) selected
                                                    @endif
                                                    value="{{$item['id']}}">{{value_show($item['name'])}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 my-2">
                                    <label class="form-label">Số điện thoại</label>
                                    <input name="phone" value="{{@$obj['phone']}}" type="text" class="form-control" placeholder="Số điện thoại">
                                </div>

                                <div class="col-lg-6 col-xl-4 my-2">
                                    <label class="form-label">Tỉnh/Thành phố</label>
                                    <select class="single-select" id="city" name="city">
                                        <option value="">Vui lòng chọn thông tin</option>
                                        @foreach($cities as $item)
                                            <option @if($item['id'] === @$obj['city_id']) selected
                                                    @endif
                                                    value="{{$item['id']}}">{{value_show($item['name'])}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 col-xl-4 my-2">
                                    <label class="form-label">Quận/ Huyện</label>
                                    <select class="single-select" id="districts" name="districts">
                                        <option value="">Vui lòng chọn thông tin</option>
                                        @if(@$obj)
                                            <option selected class="districts-ap"
                                                    value="{{@$obj['district_id']}}">{{ @$obj['districts']['name'] }}</option>
                                        @endif
                                    </select>

                                </div>
                                <div class="col-lg-6 col-xl-4 my-2">
                                    <label class="form-label">Xã/Phường</label>
                                    <select class="single-select " id="ward" name="ward">
                                        <option value="">Vui lòng chọn thông tin</option>
                                        @if(@$obj)
                                            <option selected class="wards-ap" value="{{@$obj['ward_id']}}">{{ @$obj['ward']['name'] }}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-12 my-2">
                                    <label class="form-label">Địa chỉ chi tiết</label>
                                    <input name="address" value="{{@$obj['address']}}" type="text" class="form-control" placeholder="Nhập địa chỉ chi tiết">
                                </div>
                            </div>
                        </div>
                        <div class="footer footer-action">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <div class="sm-end d-none d-sm-block text-end">
                                            <button id="send_form_input" type="button" class="btn btn-sm btn-success btn-load send-f">
                                                <div class="d-flex align-items-center">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_iconCarrier"> <path d="M7 3V6.4C7 6.96005 7 7.24008 7.10899 7.45399C7.20487 7.64215 7.35785 7.79513 7.54601 7.89101C7.75992 8 8.03995 8 8.6 8H15.4C15.9601 8 16.2401 8 16.454 7.89101C16.6422 7.79513 16.7951 7.64215 16.891 7.45399C17 7.24008 17 6.96005 17 6.4V4M17 21V14.6C17 14.0399 17 13.7599 16.891 13.546C16.7951 13.3578 16.6422 13.2049 16.454 13.109C16.2401 13 15.9601 13 15.4 13H8.6C8.03995 13 7.75992 13 7.54601 13.109C7.35785 13.2049 7.20487 13.3578 7.10899 13.546C7 13.7599 7 14.0399 7 14.6V21M21 9.32548V16.2C21 17.8802 21 18.7202 20.673 19.362C20.3854 19.9265 19.9265 20.3854 19.362 20.673C18.7202 21 17.8802 21 16.2 21H7.8C6.11984 21 5.27976 21 4.63803 20.673C4.07354 20.3854 3.6146 19.9265 3.32698 19.362C3 18.7202 3 17.8802 3 16.2V7.8C3 6.11984 3 5.27976 3.32698 4.63803C3.6146 4.07354 4.07354 3.6146 4.63803 3.32698C5.27976 3 6.11984 3 7.8 3H14.6745C15.1637 3 15.4083 3 15.6385 3.05526C15.8425 3.10425 16.0376 3.18506 16.2166 3.29472C16.4184 3.4184 16.5914 3.59135 16.9373 3.93726L20.0627 7.06274C20.4086 7.40865 20.5816 7.5816 20.7053 7.78343C20.8149 7.96237 20.8957 8.15746 20.9447 8.36154C21 8.59171 21 8.8363 21 9.32548Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                    <div class="flex-grow-1 font-15 ms-2 text-white">
                                                        Lưu lại
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info_lo col-sm-12 col-xl-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Lịch sử thao tác</h4>
                    </div>
                    <div class="card-body">
                        @include('components.list-log')
                    </div>
                </div>
            </div>
        </div>
    </form>


    @if($obj)
        <input form="info_user" type="hidden" class="token" name="token" value="{{build_token($obj['id'])}}">
        <input form="info_user" type="hidden" class="id" name="id" value="{{$obj['id']}}">
    @endif

    <!--  END CONTENT AREA  -->
@endsection


@section('JS')
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


        $('#send_form_input').click(function () {
            return _POST_FORM('#info_user', '{{route($router_current_name, ['cmd' => 'ajax_save'])}}')
        })

    </script>
@endsection

