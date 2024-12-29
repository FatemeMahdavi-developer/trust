@props(['title'=>'','name'=>'','items'=>[],'key'=>'','value'=>'','value_old'=>'','placeholder'=>'انتخاب کنید','class'=>''])
<div class="col-md-6 col-sm-12">
    <div class="input-box {{$class}}">
        @if($title)
        <label>{{$title}}</label>
        @endif
        <select name="{{$name}}" class="select2" data-placeholder="{{$placeholder}}">
            <option></option>
            @foreach($items as $key_item => $value_item)
                <option @if(empty($key))value="{{$key_item}}"
                        @else value="{{$value_item[$key]}}" @endif>@if(empty($value)){{$value_item}}@else{{$value_item[$value]}} @endif</option>
            @endforeach
        </select>
        @error($name)<span class="text text-danger">{{$errors->first($name)}}</span>@enderror
    </div>
</div>
@if(!empty($value_old))
    <script>
        $("select[name='{{$name}}']").val({{$value_old}});
    </script>
@endif
