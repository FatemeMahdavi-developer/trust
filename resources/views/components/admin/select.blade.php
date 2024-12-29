@props(['title'=>'','name'=>'','items'=>[],'key'=>'','value'=>'','value_old'=>'','placeholder'=>'انتخاب کنید','class'=>''])
<div class="form-group {{$class}}">
    <label for="{{$name}}">{{$title}}</label>
    <select name="{{$name}}" id="{{$name}}" class="form-control select2">
        <option value="">{{$placeholder}}</option>
        @foreach($items as $key_item => $value_item)
            <option @if(empty($key))value="{{$key_item}}"
                    @else value="{{$value_item[$key]}}" @endif>@if(empty($value)){{$value_item}}@else{{$value_item[$value]}} @endif</option>
        @endforeach
    </select>
    @error($name)<span class="text text-danger">{{$errors->first($name)}}</span>@enderror
</div>
@if(!empty($value_old))
    <script>
        var select = document.getElementById('{{$name}}');
        select.value = '{{$value_old}}';
    </script>
@endif
