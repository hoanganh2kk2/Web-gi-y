<div class="">
    @if(!empty($logs) && !$logs->isEmpty())
        <ul class="verti-timeline list-unstyled">
        @foreach($logs as $log)
                <li class="event-list">
                    <div class="event-date text-primar">{{@$log['created_at']}}</div>
                    <a href="javascript:void(0)" onclick="show_log('{{$log['id']}}')" class="t-meta-time">Nội dung chỉnh sửa</a>
                    <p>Bản ghi này được <strong>{{@$log['type']['name']}}</strong> bởi <strong>
                            <a @if(@$log['guard'] === 'client') class="text-danger" href=" {{route('customer', ['cmd' => 'input', 'id' => $log['created_by']->id])}}"  @else class="text-success"  href="{{route('member', ['cmd' => 'input', 'id' => $log['created_by']->id])}}" @endif>{{@$log['created_by']->email}}</a></strong></p>
                </li>
        @endforeach
        </ul>
    @else
        <div class="alert alert-warning fw-bold mb-0" role="alert">
            Không tìm thấy thông tin thay đổi.
        </div>
    @endif
</div>


<script>
    function show_log(id){
        let _url = '{{route($router_current_name, ['cmd' => 'get_log_detal'])}}'
        _url = setUrlParameters(_url, 'id', id)
        return _SHOW_FORM_REMOTE(_url.href, 'log_modal')
    }
</script>
