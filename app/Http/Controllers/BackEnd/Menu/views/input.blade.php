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
                                <div class="col-12 my-2">
                                    <label class="form-label">Tên menu</label>
                                    <input name="name" value="{{@$obj['name']}}" type="text" class="form-control" placeholder="Email">
                                </div>
                                <div class="col-12 my-2">
                                    <label class="form-label">Loại menu</label>
                                    <select class="single-select" id="type" name="type">
                                        <option value="">Vui lòng chọn thông tin</option>
                                        @if($type)
                                            @foreach($type as $item)
                                                <option @if(@$item['id'] === @$obj['type']) selected @endif
                                                value="{{$item['id']}}">{{value_show($item['name'])}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-12 my-2">
                                    <label class="form-label">Đối tượng áp dụng</label>
                                    <select class="single-select" id="apply" name="apply">
                                        <option value="">Vui lòng chọn thông tin</option>
                                        @if($apply)
                                            @foreach($apply as $item)
                                                <option @if(@$item['id'] === @$obj['apply']) selected @endif
                                                value="{{$item['id']}}">{{value_show($item['name'])}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>


                                <div class="col-12 my-2 ">
                                    <label class="form-label">Chi tiết áp dụng</label>
                                    <select class="single-select" id="apply-detail" onchange="post_detail()" name="apply_detail">
                                        <option value="">Vui lòng chọn thông tin</option>
                                    </select>
                                </div>

                                <div class="col-12 my-2 post-append hidden">


                                </div>
                            </div>



                            <div class="col-12 my-2">
                                <div class="form-group">
                                    <label for="profession">Menu cha</label>
                                    <select class="single-select" id="parent_id" name="parent_id">
                                        <option value="">Vui lòng chọn thông tin</option>
                                    </select>
                                </div>
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

        let obj_apply = 0
        let static_page = '{{\App\Models\Category::get_type_static_page()}}'

        $('#send_form_input').click(function () {
            return _POST_FORM('#info_user', '{{route($router_current_name, ['cmd' => 'ajax_save'])}}')
        })


        $('#type').change(function () {
            appen_menu()
        });
        @if(@$obj)
        let parent_id = {{$obj['parent_id']}}
        @endif
        appen_menu()

        function appen_menu() {
            $('.parent-ap').remove()
            let type = $('#type').val()
            let url = '{{route($router_current_name, ['cmd' => 'ajax_get_menu'])}}'
            url = setUrlParametersHref(url, 'type', type)
            return _GET_URL(url, {
                callback: function (res) {
                    let val = res.result
                    let option = ''
                    $.map(val, function (val) {
                        if(parent_id == val.id) {
                            option += `<option class='parent-ap' selected value='${val.id}'>${val.name}</option>`
                        }else {
                            option += `<option class='parent-ap' value='${val.id}'>${val.name}</option>`
                        }
                    })
                    $('#parent_id').append(option)
                }
            })
        }


        $('#apply').change(function (){
            get_detail()
            $('.post_detail_ap').remove()
            $('.post-append').addClass('hidden')
        })
        @if(@$obj)
            obj_apply = '{{$obj['apply_detail']}}'
        get_detail()
        @endif


        function get_detail() {
            $('.detail-ap').remove()
            let apply = $('#apply').val()
            let url = '{{route($router_current_name, ['cmd' => 'ajax_detail'])}}'
            url = setUrlParametersHref(url, 'apply', apply)
            return _GET_URL(url, {
                callback: function (res) {
                    let val = res.result
                    let option = ''
                    $.map(val, function (val) {
                        if(obj_apply == val.id) {
                            option += `<option selected value='${val.id}' class="detail-ap">${val.name}</option>`
                        }else {
                            option += `<option  value='${val.id}' class="detail-ap">${val.name}</option>`
                        }
                    })
                    $('#apply-detail').append(option);
                }
            })
        }


        var static_post_id = 0
        @if(@$obj['post_static_id'])
            static_post_id = '{{@$obj['post_static_id']}}'
        setTimeout(() => {
            post_detail()
        }, 3000);
        @endif

        function post_detail() {
            $('.post_detail_ap').remove()
            let apply = $('#apply').val()
            if(apply === static_page) {
                let obj_apply = $('#apply-detail').val()
                if(typeof obj_apply !== 'undefined') {
                    $('.post-append').removeClass('hidden')
                    let url = '{{route($router_current_name, ['cmd' => 'ajax_post_detail'])}}'
                    url = setUrlParametersHref(url, 'category_id', obj_apply)
                    return _GET_URL(url, {
                        callback: function (res) {
                            let val = res.result
                            let option = ''
                            $.map(val, function (val) {
                                if(static_post_id == val.id) {
                                    option += `<option selected value='${val.id}'>${val.name}</option>`
                                }else {
                                    option += `<option  value='${val.id}'>${val.name}</option>`
                                }
                            })
                            let html = `<div class="form-group post_detail_ap">
                                                            <label for="profession">Bài viết áp dụng</label>
                                                            <select class="single-select" id="post_detail" name="post_detail">
                                                                <option value="">Vui lòng chọn thông tin</option>
                                                                 ${option}
                    </select>
                </div>`
                            $('.post-append').append(html)
                            INISINGLESELECT()
                        }
                    })
                }
            }
        }





    </script>
@endsection

