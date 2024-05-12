<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0"><a href="{{route('home')}}">Trang chủ</a></h4>
            @if(isset($router_current_name) && $router_current_name !== 'home')
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{@$breadcrumb}}</a></li>
                        <li class="breadcrumb-item" style="color: #888888">/</li>
                        <li class="breadcrumb-item active">Chi tiết</li>
                    </ol>
                </div>
            @endif
        </div>
    </div>
</div>
