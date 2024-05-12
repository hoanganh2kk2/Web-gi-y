<div class="card">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="widget-content widget-content-area br-8">
                <div class="card-body">
                    <div class="table-responsive">
                        @if(isset($add_href))
                        <a href="{{$add_href}}" class="btn btn-warning text-white mb-2 float-end">Thêm mới</a>
                        @endif
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                            <tr>
                                @if(@$th['checkbox'])
                                    <th class="checkbox-area" scope="col">
                                        <div class="form-check form-check-primary">
                                            <input class="form-check-input" id="custom_mixed_parent_all"
                                                   type="checkbox">
                                        </div>
                                    </th>
                                @endif
                                <th class="text-center" scope="col">STT</th>
                                @foreach($lsTh as $k => $th)
                                    <th scope="col"
                                        class="@if(@$th['class']) {{@$th['class']}} @else text-center @endif"
                                        @if(@$th['style']) style="{{ $th['style'] }}" @endif>{{@$th['name']}}</th>
                                @endforeach
                                @if(!isset($list_hidden) || $list_hidden !== true )
                                    <th class="text-center" style="width: 100px;">Chức năng</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($lsObj) && !$lsObj->isEmpty())
                                @foreach($lsObj as $key => $obj)
                                    <tr>
                                        @if(@$th['checkbox'])
                                            <td>
                                                <div class="form-check form-check-primary">
                                                    <input class="form-check-input custom_mixed_child" type="checkbox">
                                                </div>
                                            </td>
                                        @endif
                                        <td class="text-center">{{ str_pad(++$key, 2, '0', STR_PAD_LEFT) }}</td>
                                        @foreach($lsTh as $th)
                                            <td class="{{ @$th['td']['class'] }} @if(@$th['key'] === 'status') text-{{@$obj[$th['key']]['style']}} @endif" style="font-weight: bold">
                                                @if(@$th['td']['link'])
                                                    <a href=" @if(@$th['td']['info']) {{route($router_current_name, ['cmd' => 'input', 'id' => $obj['id']])}}  @else {{$th['td']['link']}}@endif"
                                                       class="{{ @$th['td']['class'] }} @if(@$th['key'] === 'status') {{@$obj[$th['key']]['style']}} @endif">
                                                        @if(@$th['relation'])
                                                            @php
                                                                $obj->load($th['relation']);
                                                                $rele = explode('.', $th['relation']);
                                                                $data = [];
                                                                dequyrele($rele, $obj, 0, $data)
                                                            @endphp
                                                            @if(@$th['number'])
                                                                {{show_number($data[$th['key']])}}
                                                            @elseif(@$th['money'])
                                                                {{show_money($data[$th['key']])}}
                                                            @elseif(@$th['date'])
                                                                {{show_int_date($data[$th['key']])}}
                                                            @elseif(@$th['img'])
                                                                <img width="50" src="{{show_img($data[$th['key']])}}" alt="image" />
                                                            @else
                                                                {{value_show(@$data[$th['key']])}}
                                                            @endif
                                                        @else
                                                        @if(@$th['number'])
                                                                {{show_number(@$obj[$th['key']])}}
                                                            @elseif(@$th['money'])
                                                                {{show_money($data[$th['key']])}}
                                                            @elseif(@$th['date'])
                                                                {{show_int_date($obj[$th['key']])}}
                                                            @elseif(@$th['img'])
                                                                <img width="50" src="{{show_img($data[$th['key']])}}" alt="image" />
                                                            @else
                                                                {{value_show(@$obj[$th['key']])}}
                                                            @endif
                                                        @endif
                                                    </a>
                                                @else
                                                    @if(@$th['relation'])
                                                        @php
                                                            $obj->load($th['relation']);
                                                            $rele = explode('.', $th['relation']);
                                                            $data = [];
                                                            dequyrele($rele, $obj, 0, $data)
                                                        @endphp
                                                        @if(@$th['number'])
                                                            {{show_number(@$data[$th['key']])}}
                                                        @elseif(@$th['money'])
                                                            {{show_money(@$data[$th['key']])}}
                                                        @elseif(@$th['date'])
                                                            {{show_int_date(@$data[$th['key']])}}
                                                        @elseif(@$th['img'])
                                                            <img width="50" src="{{show_img(@$data[$th['key']])}}" alt="image" />
                                                        @else
                                                            {{value_show(@$data[$th['key']])}}
                                                        @endif
                                                    @else
                                                        @if(@$th['number'])
                                                            {{show_number(@$obj[$th['key']])}}
                                                        @elseif(@$th['money'])
                                                            {{show_money(@$data[$th['key']])}}
                                                        @elseif(@$th['date'])
                                                            {{show_int_date(@$obj[$th['key']])}}
                                                        @elseif(@$th['img'])
                                                            <img width="50" src="{{show_img(@$obj[$th['key']])}}" alt="image" />
                                                        @else
                                                            {{value_show(@$obj[$th['key']])}}
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>
                                        @endforeach

                                        @if(!isset($list_hidden) || $list_hidden !== true)
                                            <td class="text-center">
                                                @if(@$obj['status']['id'] !== \App\Models\BaseModel::getStatusDeleted() && $router_current_name == 'products')
                                                <div class="d-flex">
                                                    <a href="{{route($router_current_name, ['cmd' => 'input', 'id' => $obj['id'], 'view' => true])}}" class="bs-tooltip me-2"
                                                       data-bs-toggle="tooltip" data-bs-placement="top"
                                                       title="Xem chi tiết"
                                                       data-original-title="Xem chi tiết"
                                                       data-bs-original-title="xem chi tiết"
                                                       aria-label="xem chi tiết">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                             height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round"
                                                             class="feather feather-eye">
                                                            <path
                                                                    d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                        </svg>
                                                    </a>
                                                    @endif
                                                    @if(@$obj['status']['id'] !== \App\Models\BaseModel::getStatusDeleted())
                                                        <a href="{{route($router_current_name, ['cmd' => 'input', 'id' => $obj['id']])}}"
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
                                                    @endif
                                                    @if(@$obj['status']['id'] !== \App\Models\BaseModel::getStatusDeleted())
                                                        <a onclick="deleted('{{$obj['id']}}', '{{route($router_current_name, ['cmd' => 'deleted'])}}')"
                                                           href="javascript:void(0);"
                                                           class="bs-tooltip confirm-{{$obj['id']}}"
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
                                                    @endif
                                                </div>
                                            </td>
                                        @endif
                                        <input type="hidden" class="token" name="token"
                                               value="{{build_token(@$obj['id'])}}">
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="20">
                                        <div class="alert alert-warning fw-bold mb-0" role="alert">
                                            Không tìm thấy kết quả nào phù hợp với điều kiện tìm kiếm của bạn.
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                       <div class="text-end">
                           @if(!empty($lsObj) && !$lsObj->isEmpty())
                               {!! $lsObj->links() !!}
                           @endif
                       </div>
                </div>

            </div>
        </div>
    </div>
</div>

