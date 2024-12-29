@props(['title'=>'','name'=>'','items'=>[],'key'=>'','value'=>'','value_old'=>[],'placeholder'=>'','class'=>''])
<div class="form-group {{$class}}">
    <label for="{{$name}}">{{$title}}</label>
    <select name="{{$name}}[]" id="{{$name}}" class="form-control select2" multiple>
        @if(!empty($placeholder))
        <option value="">{{$placeholder}}</option>
        @endif
        @foreach($items as $key_item => $value_item)
            <option @if(empty($key))value="{{$key_item}}" @else value="{{$value_item[$key]}}" @endif @if(empty($key))@if(in_array($key_item,$value_old)) selected @endif @else @if(in_array($value_item[$key],$value_old)) selected @endif @endif>@if(empty($value)){{$value_item}}@else{{$value_item[$value]}} @endif</option>
        @endforeach
    </select>
    @error($name)<span class="text text-danger">{{$errors->first($name)}}</span>@enderror
</div>

