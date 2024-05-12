@extends('layouts.base')

@section('content')
        <div class="row">
            <div class="col-sm-12 col-xl-8">
                <form id="info_user">
                <div class="card">
                    <div class="card-header d-flex flex-wrap gap-3">
                        <h4 class="card-title mb-0">Thông tin cơ bản</h4>
                    </div>
                    <div class="card-body form-steps">
                        <div class="tab-content p-0">
                            <div class="row">
                                <div class="col-12 my-2 row">

                                    <div class="col-9 row">
                                        <div class="col-6 my-2">
                                            <label class="form-label">Tên sản phẩm</label><span class="text-info font-bold" style="margin-left: 7px">#{{@$obj['sku']}}</span>
                                            <input name="name" value="{{@$obj['name']}}" type="text" class="form-control" @if(request()->get('view') == 1) disabled @endif   placeholder="Vui lòng nhập thông tin">
                                        </div>
                                        <div class="col-6 my-2">
                                            <div class="form-group">
                                                <label for="profession">Trạng thái</label>
                                                <select class="single-select" id="status" @if(request()->get('view') == 1) disabled @endif name="status">
                                                    <option value="">Vui lòng chọn thông tin</option>
                                                    @foreach($status as $item)
                                                        <option @if(@$item['id'] === @$obj['status']['id']) selected @endif
                                                        value="{{$item['id']}}">{{value_show($item['name'])}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <div class="form-group">
                                                <label for="description">Mô tả</label>
                                                <textarea class="tinymce" id="content" name="description"> {!! @$obj['description'] !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <div class="form-group">
                                                <label for="category">Thể loại (Danh mục)</label>
                                                <select class="select2 form-control select2-multiple" name="category[]" @if(request()->get('view') == 1) disabled @endif multiple="multiple" data-placeholder="Choose ...">

                                                    @if($categories)
                                                        @foreach($categories as $item)
                                                            <option class="ms-2" @if(isset($cate[$item['id']])) selected @endif
                                                            value="{{$item['id']}}">{{value_show($item['name'])}}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6 my-2">
                                            <label class="form-label">Giá gốc</label>
                                            <input name="price" value="{{@$obj['price']}}" @if(request()->get('view') == 1) disabled @endif type="text" class="form-control" placeholder="Vui lòng nhập thông tin">
                                        </div>
                                        <div class="col-6 my-2">
                                            <label class="form-label">Giá bán</label>
                                            <input name="sell_price" value="{{@$obj['sell_price']}}" @if(request()->get('view') == 1) disabled @endif type="text" class="form-control" placeholder="Vui lòng nhập thông tin">
                                        </div>



                                    </div>

                                    <div class="col-3">
                                        @include('components.upload', ['img' => show_img(@$obj['avatar'], false), 'view' => request()->get('view')])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card ">
                        <div class="footer footer-action">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <div class="sm-end d-none d-sm-block text-end">
                                            @if(request()->get('view') != 1)
                                            <button id="send_form_input_draft" type="button" class="btn btn-sm btn-danger btn-load send-f">
                                                <div class="d-flex align-items-center">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_iconCarrier"> <path d="M7 3V6.4C7 6.96005 7 7.24008 7.10899 7.45399C7.20487 7.64215 7.35785 7.79513 7.54601 7.89101C7.75992 8 8.03995 8 8.6 8H15.4C15.9601 8 16.2401 8 16.454 7.89101C16.6422 7.79513 16.7951 7.64215 16.891 7.45399C17 7.24008 17 6.96005 17 6.4V4M17 21V14.6C17 14.0399 17 13.7599 16.891 13.546C16.7951 13.3578 16.6422 13.2049 16.454 13.109C16.2401 13 15.9601 13 15.4 13H8.6C8.03995 13 7.75992 13 7.54601 13.109C7.35785 13.2049 7.20487 13.3578 7.10899 13.546C7 13.7599 7 14.0399 7 14.6V21M21 9.32548V16.2C21 17.8802 21 18.7202 20.673 19.362C20.3854 19.9265 19.9265 20.3854 19.362 20.673C18.7202 21 17.8802 21 16.2 21H7.8C6.11984 21 5.27976 21 4.63803 20.673C4.07354 20.3854 3.6146 19.9265 3.32698 19.362C3 18.7202 3 17.8802 3 16.2V7.8C3 6.11984 3 5.27976 3.32698 4.63803C3.6146 4.07354 4.07354 3.6146 4.63803 3.32698C5.27976 3 6.11984 3 7.8 3H14.6745C15.1637 3 15.4083 3 15.6385 3.05526C15.8425 3.10425 16.0376 3.18506 16.2166 3.29472C16.4184 3.4184 16.5914 3.59135 16.9373 3.93726L20.0627 7.06274C20.4086 7.40865 20.5816 7.5816 20.7053 7.78343C20.8149 7.96237 20.8957 8.15746 20.9447 8.36154C21 8.59171 21 8.8363 21 9.32548Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                    <div class="flex-grow-1 font-15 ms-2 text-white">
                                                        Lưu nháp
                                                    </div>
                                                </div>
                                            </button>
                                            @endif
                                            <button id="send_form_input" type="button" class="btn btn-sm btn-success btn-load send-f">
                                                <div class="d-flex align-items-center">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_iconCarrier"> <path d="M7 3V6.4C7 6.96005 7 7.24008 7.10899 7.45399C7.20487 7.64215 7.35785 7.79513 7.54601 7.89101C7.75992 8 8.03995 8 8.6 8H15.4C15.9601 8 16.2401 8 16.454 7.89101C16.6422 7.79513 16.7951 7.64215 16.891 7.45399C17 7.24008 17 6.96005 17 6.4V4M17 21V14.6C17 14.0399 17 13.7599 16.891 13.546C16.7951 13.3578 16.6422 13.2049 16.454 13.109C16.2401 13 15.9601 13 15.4 13H8.6C8.03995 13 7.75992 13 7.54601 13.109C7.35785 13.2049 7.20487 13.3578 7.10899 13.546C7 13.7599 7 14.0399 7 14.6V21M21 9.32548V16.2C21 17.8802 21 18.7202 20.673 19.362C20.3854 19.9265 19.9265 20.3854 19.362 20.673C18.7202 21 17.8802 21 16.2 21H7.8C6.11984 21 5.27976 21 4.63803 20.673C4.07354 20.3854 3.6146 19.9265 3.32698 19.362C3 18.7202 3 17.8802 3 16.2V7.8C3 6.11984 3 5.27976 3.32698 4.63803C3.6146 4.07354 4.07354 3.6146 4.63803 3.32698C5.27976 3 6.11984 3 7.8 3H14.6745C15.1637 3 15.4083 3 15.6385 3.05526C15.8425 3.10425 16.0376 3.18506 16.2166 3.29472C16.4184 3.4184 16.5914 3.59135 16.9373 3.93726L20.0627 7.06274C20.4086 7.40865 20.5816 7.5816 20.7053 7.78343C20.8149 7.96237 20.8957 8.15746 20.9447 8.36154C21 8.59171 21 8.8363 21 9.32548Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                    <div class="flex-grow-1 font-15 ms-2 text-white">
                                                        @if(request()->get('view') == 1)
                                                            Chỉnh sửa
                                                        @elseif(request()->get('id'))
                                                            Lưu
                                                        @else
                                                            Thêm mới
                                                        @endif

                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    @include('components.seo')--}}
                </form>
                <div class="card ">
                    <div class="card-header d-flex flex-wrap gap-3">
                        <h4 class="card-title mb-0">Hình ảnh đi kèm</h4>
                    </div>
                    <div class="card-body form-steps">
                        <div class="tab-content p-0">
                            <form id="form_upload_media">
                                <div class="row">
                                    <label class="btn btn-sm btn-outline-warning btn-border ms-2">
                                        <i class="ri-upload-2-fill me-1 align-bottom"></i>Upload File
                                        <input @if(request()->get('view') == 1) disabled @endif name="file" id="upload_media" multiple type="file" hidden>
                                    </label>
                                </div>

                                <div class="app-media d-flex">
                                    @if(@$obj['media'])
                                        @php
                                            $media = json_decode($obj['media'])
                                        @endphp
                                        @foreach($media as $k => $item)
                                            <div class="data-appen ms-3" id="media-{{$k}}">
                                                <a onclick="remove_file('media-{{$k}}')">
                                                    <i class="bx bx-x-circle float-end delete_icon"></i>
                                                    <img width="150" height="100" src="{{show_img($item)}}" alt="media">
                                                </a>
                                                <input @if(request()->get('view') == 1) disabled @endif form="info_user" type="hidden" value="{{$item}}" name="media[]">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info_lo col-sm-12 col-xl-4">
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

    @if($obj)
        <input form="info_user" type="hidden" class="token" name="token" value="{{build_token($obj['id'])}}">
        <input form="info_user" type="hidden" class="id" name="id" value="{{$obj['id']}}">
    @endif
    <!--  END CONTENT AREA  -->
@endsection


@section('JS')
    <script>
        $('#send_form_input_draft').click(function () {

            return _POST_FORM('#info_user', '{{route($router_current_name, ['cmd' => 'ajax_save', 'draft' => true])}}')
        })

        $('#send_form_input').click(function () {

            @if(request()->get('view') == 1)
                    window.location.href = `{{substr(request()->fullUrl(),0,-7)}}`
            @else
                return _POST_FORM('#info_user', '{{route($router_current_name, ['cmd' => 'ajax_save'])}}')
            @endif

        })

        INIDROPIFY()

        $('#upload_media').change(function (){
            _POST_FORM('#form_upload_media', '{{route('upload')}}', {
                callback: function (res) {
                    if (res.status === 200) {
                        let arr_data = res.result.media
                        let html = ''
                        if (arr_data instanceof Array) {
                            $.map(arr_data, function (val){
                                 let link = val.url
                                 let relative_link = val.relative_link
                                 let id = val.id
                                 if (link) {
                                      html += ` <div class="data-appen ms-3" id="${id}">
                                <a onclick="remove_file('${id}')">
<i class="bx bx-x-circle float-end delete_icon"></i>
 <img width="150" height="100" src="${link}" alt="media">
</a>
                                <input form="info_user" type="hidden" value="${relative_link}" name="media[]">
                                 </div> `
                                 }
                             })
                        } else {
                            let link = arr_data.url
                            let relative_link = arr_data.relative_link
                            let id = arr_data.id
                            if (link) {
                                html = `<div class="data-appen ms-3" id="${id}">
<a onclick="remove_file('${id}')">
<i class="bx bx-x-circle float-end delete_icon"></i>
                                 <img width="150" height="100" src="${link}" alt="media">
</a>
                                <input form="info_user" type="hidden" value="${relative_link}" name="media[]">
                                 </div> `
                            }
                        }
                        $('.app-media').append(html)
                    }
                }})
        })
        @if(request()->get('view') == 1)
        INIT_TINYMCE(true)
        @else
        INIT_TINYMCE()
        @endif

    </script>
@endsection

