@extends('layouts.base')

@php
    if(!empty($lsObj) && !$lsObj->isEmpty()) {
    $lsObj = $lsObj->getCollection()->groupBy('type');
    if(isset($lsObj[\App\Models\Menu::getInstance()->getMenuHeader()])) {
        $menuHerder = $lsObj[\App\Models\Menu::getInstance()->getMenuHeader()]->groupBy('parent_id');
    }
    if(isset($lsObj[\App\Models\Menu::getInstance()->getMenuFooter()])) {
         $menufooter = $lsObj[\App\Models\Menu::getInstance()->getMenuFooter()]->groupBy('parent_id');
    }
 }
@endphp

@section('content')
    <div class="row mt-3">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">Header menu</h6>
                        <hr/>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="col-2">STT</th>
                                    <th colspan="2">Tên Menu</th>
                                    <th class="col-3">Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($menuHerder[0]))
                                    @foreach($menuHerder[0] as $item)
                                        <tr>
                                            <td @if(isset($menuHerder[$item['id']]) && !empty($menuHerder[$item['id']])) rowspan="{{count($menuHerder[$item['id']])+1}}" @endif> {{$loop->iteration}}</td>
                                            @if(isset($menuHerder[$item['id']]) && !empty($menuHerder[$item['id']]))
                                                <td rowspan="{{count($menuHerder[$item['id']])+1}}"> {{$item['name']}}
                                                    <a href="{{route($router_current_name, ['cmd' => 'input', 'id' => $item['id']])}}"
                                                       class="bs-tooltip me-2" data-bs-toggle="tooltip" data-bs-placement="top"
                                                       title="Chỉnh sửa" data-original-title="Chỉnh sửa"
                                                       data-bs-original-title="Chỉnh sửa" aria-label="Chỉnh sửa">
                                                        <i class="uil-comment-alt-edit fs-4"></i>
                                                    </a>
                                                    <a onclick="deleted('{{$item['id']}}', '{{route($router_current_name, ['cmd' => 'deleted'])}}')" href="javascript:void(0);"
                                                       class="bs-tooltip confirm-{{$item['id']}}" data-bs-toggle="tooltip" data-bs-placement="top"
                                                       title="" data-original-title="Xóa bản ghi"
                                                       data-bs-original-title="Xóa bản ghi" aria-label="Xóa bản ghi">
                                                        <i class="uil-minus-circle fs-4"></i>
                                                    </a>
                                                </td>
                                                <input type="hidden" class="token" name="token" value="{{build_token(@$item['id'])}}">
                                            @else
                                                <td colspan="2"> {{$item['name']}}</td>
                                                <td>
                                                    <a href="{{route($router_current_name, ['cmd' => 'input', 'id' => $item['id']])}}"
                                                       class="bs-tooltip me-2" data-bs-toggle="tooltip" data-bs-placement="top"
                                                       title="Chỉnh sửa" data-original-title="Chỉnh sửa"
                                                       data-bs-original-title="Chỉnh sửa" aria-label="Chỉnh sửa">
                                                        <i class="uil-comment-alt-edit fs-4"></i>
                                                    </a>
                                                    <a onclick="deleted('{{$item['id']}}', '{{route($router_current_name, ['cmd' => 'deleted'])}}')" href="javascript:void(0);"
                                                       class="bs-tooltip confirm-{{$item['id']}}" data-bs-toggle="tooltip" data-bs-placement="top"
                                                       title="" data-original-title="Xóa bản ghi"
                                                       data-bs-original-title="Xóa bản ghi" aria-label="Xóa bản ghi">
                                                        <i class="uil-minus-circle fs-4"></i>
                                                    </a>
                                                </td>
                                                <input type="hidden" class="token" name="token" value="{{build_token(@$item['id'])}}">
                                            @endif
                                        </tr>
                                        @if(isset($menuHerder[$item['id']]) && !empty($menuHerder[$item['id']]))
                                            @foreach($menuHerder[$item['id']] as $value)
                                                <input type="hidden" class="token" name="token" value="{{build_token(@$value['id'])}}">
                                                <tr>
                                                    <td> {{$loop->iteration}}. {{$value['name']}}</td>
                                                    <td >
                                                        <a href="{{route($router_current_name, ['cmd' => 'input', 'id' => $value['id']])}}"
                                                           class="bs-tooltip me-2" data-bs-toggle="tooltip" data-bs-placement="top"
                                                           title="Chỉnh sửa" data-original-title="Chỉnh sửa"
                                                           data-bs-original-title="Chỉnh sửa" aria-label="Chỉnh sửa">
                                                            <i class="uil-comment-alt-edit fs-4"></i>
                                                        </a>
                                                        <a onclick="deleted('{{$value['id']}}', '{{route($router_current_name, ['cmd' => 'deleted'])}}')" href="javascript:void(0);"
                                                           class="bs-tooltip confirm-{{$value['id']}}" data-bs-toggle="tooltip" data-bs-placement="top"
                                                           title="" data-original-title="Xóa bản ghi"
                                                           data-bs-original-title="Xóa bản ghi" aria-label="Xóa bản ghi">
                                                            <i class="uil-minus-circle fs-4"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <div class="alert border-0 bg-light-warning alert-dismissible fade show py-2">
                                            <div class="d-flex align-items-center">
                                                <div class="fs-3 text-warning"><i class="bi bi-exclamation-triangle-fill"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <div class="text-warning">Không tìm thấy thông tin</div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">Footer menu</h6>
                        <hr/>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="col-2">STT</th>
                                    <th colspan="2">Tên Menu</th>
                                    <th class="col-3">Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($menufooter[0]))
                                    @foreach($menufooter[0] as $item)
                                        <tr>
                                            <td @if(isset($menufooter[$item['id']]) && !empty($menufooter[$item['id']])) rowspan="{{count($menufooter[$item['id']])+1}}" @endif> {{$loop->iteration}}</td>
                                            @if(isset($menufooter[$item['id']]) && !empty($menufooter[$item['id']]))
                                                <td rowspan="{{count($menufooter[$item['id']])+1}}"> {{$item['name']}}
                                                    <a href="{{route($router_current_name, ['cmd' => 'input', 'id' => $item['id']])}}"
                                                       class="bs-tooltip me-2" data-bs-toggle="tooltip" data-bs-placement="top"
                                                       title="Chỉnh sửa" data-original-title="Chỉnh sửa"
                                                       data-bs-original-title="Chỉnh sửa" aria-label="Chỉnh sửa">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                             stroke-linecap="round" stroke-linejoin="round"
                                                             class="feather feather-edit">
                                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                        </svg>
                                                    </a>
                                                    <a onclick="deleted('{{$item['id']}}', '{{route($router_current_name, ['cmd' => 'deleted'])}}')" href="javascript:void(0);"
                                                       class="bs-tooltip confirm-{{$item['id']}}" data-bs-toggle="tooltip" data-bs-placement="top"
                                                       title="" data-original-title="Xóa bản ghi"
                                                       data-bs-original-title="Xóa bản ghi" aria-label="Xóa bản ghi">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                             stroke-linecap="round" stroke-linejoin="round"
                                                             class="feather feather-minus-circle">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <line x1="8" y1="12" x2="16" y2="12"></line>
                                                        </svg>
                                                    </a>
                                                </td>
                                                <input type="hidden" class="token" name="token" value="{{build_token(@$item['id'])}}">
                                            @else
                                                <td colspan="2"> {{$item['name']}}</td>
                                                <td>
                                                    <a href="{{route($router_current_name, ['cmd' => 'input', 'id' => $item['id']])}}"
                                                       class="bs-tooltip me-2" data-bs-toggle="tooltip" data-bs-placement="top"
                                                       title="Chỉnh sửa" data-original-title="Chỉnh sửa"
                                                       data-bs-original-title="Chỉnh sửa" aria-label="Chỉnh sửa">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                             stroke-linecap="round" stroke-linejoin="round"
                                                             class="feather feather-edit">
                                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                        </svg>
                                                    </a>
                                                    <a onclick="deleted('{{$item['id']}}', '{{route($router_current_name, ['cmd' => 'deleted'])}}')" href="javascript:void(0);"
                                                       class="bs-tooltip confirm-{{$item['id']}}" data-bs-toggle="tooltip" data-bs-placement="top"
                                                       title="" data-original-title="Xóa bản ghi"
                                                       data-bs-original-title="Xóa bản ghi" aria-label="Xóa bản ghi">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                             stroke-linecap="round" stroke-linejoin="round"
                                                             class="feather feather-minus-circle">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <line x1="8" y1="12" x2="16" y2="12"></line>
                                                        </svg>
                                                    </a>
                                                </td>
                                                <input type="hidden" class="token" name="token" value="{{build_token(@$item['id'])}}">
                                            @endif
                                        </tr>
                                        @if(isset($menufooter[$item['id']]) && !empty($menufooter[$item['id']]))
                                            @foreach($menufooter[$item['id']] as $value)
                                                <input type="hidden" class="token" name="token" value="{{build_token(@$value['id'])}}">
                                                <tr>
                                                    <td> {{$loop->iteration}}. {{$value['name']}}</td>
                                                    <td>
                                                        <a href="{{route($router_current_name, ['cmd' => 'input', 'id' => $value['id']])}}"
                                                           class="bs-tooltip me-2" data-bs-toggle="tooltip" data-bs-placement="top"
                                                           title="Chỉnh sửa" data-original-title="Chỉnh sửa"
                                                           data-bs-original-title="Chỉnh sửa" aria-label="Chỉnh sửa">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                                 stroke-linecap="round" stroke-linejoin="round"
                                                                 class="feather feather-edit">
                                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                            </svg>
                                                        </a>
                                                        <a onclick="deleted('{{$value['id']}}', '{{route($router_current_name, ['cmd' => 'deleted'])}}')" href="javascript:void(0);"
                                                           class="bs-tooltip confirm-{{$value['id']}}" data-bs-toggle="tooltip" data-bs-placement="top"
                                                           title="" data-original-title="Xóa bản ghi"
                                                           data-bs-original-title="Xóa bản ghi" aria-label="Xóa bản ghi">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                                 stroke-linecap="round" stroke-linejoin="round"
                                                                 class="feather feather-minus-circle">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <line x1="8" y1="12" x2="16" y2="12"></line>
                                                            </svg>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <div class="alert border-0 bg-light-warning alert-dismissible fade show py-2">
                                            <div class="d-flex align-items-center">
                                                <div class="fs-3 text-warning"><i class="bi bi-exclamation-triangle-fill"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <div class="text-warning">Không tìm thấy thông tin</div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection