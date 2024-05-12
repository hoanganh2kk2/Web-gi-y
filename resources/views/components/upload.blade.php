<input type="file" @if(request()->get('view') == 1) disabled @endif name="{{$name ?? 'images'}}" class="dropify" id="dropify"  data-max-file-
       size="2M" data-height="{{$height ?? 300}}"
       data-default-file="{{ url($img) }}">
<input type="hidden" @if(request()->get('view') == 1) disabled @endif  name="{{@$name ? $name.'_c' : 'images_c'}}" value="{{ $img }}">

