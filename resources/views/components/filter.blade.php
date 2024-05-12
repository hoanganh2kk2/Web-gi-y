<div class="card">
    <form class="row g-3 mt-2 mb-3 p-3">
        <div class="col-md-12 row">
            @foreach($columns as $column)
                @if($column['type'] !== \App\Http\Enum\filterEnum::FILTER_HIDDEN)
                <div class="col-md-3 mb-3">
                    @if($column['type'] === \App\Http\Enum\filterEnum::FILTER_SELECT && $column['value'])
                        <select class="single-select" name="{{$column['name'] ?? ''}}">
                            <option value="" >{{$column['placeholder'] ?? 'Vui lòng chọn thông tin'}}</option>
                            @foreach($column['value'] as $item)
                                <option @if(!empty(request()->filled($column['name'])) && $item['id'] === (int)request($column['name'])) selected @endif
                                value="{{$item['id']}}">{{value_show($item['name'])}}
                                </option>
                            @endforeach
                        </select>
                    @elseif($column['type'] === \App\Http\Enum\filterEnum::FILTER_TEXT || $column['type'] === \App\Http\Enum\filterEnum::FILTER_SEARCH)
                        <input type="{{$column['type'] ?? 'search'}}" name="{{$column['name'] ?? ''}}"
                               placeholder="{{$column['placeholder'] ?? 'vui lòng nhập thông tin'}}"
                               class="form-control" value="{{$column['value']  ?? request($column['name'])}}">
                    @else
                        <input type="{{$column['type'] ?? 'date'}}" name="{{$column['name'] ?? ''}}"
                               placeholder="{{$column['placeholder'] ?? 'vui lòng nhập thông tin'}}"
                               class="form-control" value="{{$column['value']  ?? request($column['name'])}}">
                    @endif
                </div>
                @else
                    <input type="{{$column['type'] ?? 'search'}}" name="{{$column['name'] ?? ''}}"
                           placeholder="{{$column['placeholder'] ?? 'vui lòng nhập thông tin'}}"
                           class="form-control" value="{{$column['value']  ?? request($column['name'])}}">
                @endif
            @endforeach
            @if($sorts)
                <div class="col-md-3 mb-3">
                    <select class="single-select" name="sort">
                        @foreach($sorts as $sort)
                            <option @if(@$sort['selected'] === true) selected
                                    @endif value="{{$sort['id']}}">{{value_show($sort['name'])}}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="col-md-3 mb-3">
                <button type="submit" class="btn btn-info"><svg width="17px" height="17px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_iconCarrier"> <path d="M21 21L16.65 16.65M11 6C13.7614 6 16 8.23858 16 11M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg><span> Tìm kiếm</span>
                </button>
                <button onclick="window.location.replace(window.location.pathname)" type="button" class="btn btn-dark btn-soft-dark waves-effect waves-light">Reset</button>
            </div>
        </div>
    </form>
</div>
