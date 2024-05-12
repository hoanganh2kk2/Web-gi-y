<div class="modal_log_modal" id="log_modal">
    <div class="modal-header">
        <h5 class="modal-title">Chi tiết thay đổi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form id="send-data" class="g-3 row">
            <div class="card">
                <div class="card-body d-flex">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="summary layout-spacing ">
                            <div class="widget-content widget-content-area">
                                <div class="order-summary mt-5">
                                    <div class="summary-list summary-income">
                                        <div class="info row">
                                            <div class="col-12 col-md-12 col-lg-6 col-xl-6" style="border-right: 1px solid #CCCCCC	 ">
                                                <h5 class="text-center text-danger">Trước khi thay đổi</h5>
                                                <div class="form-group mt-4">
                                                    @php
                                                        $brfore = [] ; if($log['before']) $brfore = $log['before']
                                                    @endphp
                                                    @if($brfore)
                                                         @foreach($brfore as $k => $item)
                                                             <div>
                                                                 <b>{{$k}}:</b>
                                                                 @if(is_array($item))
                                                                     <p style="white-space: pre-wrap;word-wrap: break-word;">
                                                                         {{ json_encode($item, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK) }}
                                                                     </p>
                                                                 @else
                                                                     <p>
                                                                         {{print_r($item,true)}}
                                                                     </p>
                                                                 @endif
                                                             </div>
                                                        @endforeach
                                                    @else
                                                        <p>{{json_encode($brfore)}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12 col-lg-6 col-xl-6">
                                                <h5 class="text-center text-danger">Sau khi thay đổi</h5>
                                                <div class="form-group mt-4">
                                                    <div class="switch form-switch-custom switch-inline form-switch-success mt-1">
                                                        @php $after = [] ; if($log['after']) $after = $log['after']   @endphp
                                                        @if($after)
                                                            @foreach($after as $k => $item)
                                                                @php
                                                                    if (is_array($item)) $after->$k = json_encode($item);
                                                                    if (is_array(@$brfore->$k)) $brfore[$k] = json_encode($brfore[$k])
                                                                @endphp
                                                               <div @if(print_r(@$brfore->$k, true) !== print_r(@$after->$k, true))
                                                                    style="background-color: lightgrey"
                                                                       @endif >
                                                                   <b>{{$k}}:</b>
                                                                   <p>
                                                                       {{print_r($item,true)}}
                                                                   </p>
                                                               </div>
                                                            @endforeach
                                                        @else
                                                            <p>{{json_encode($after)}}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
