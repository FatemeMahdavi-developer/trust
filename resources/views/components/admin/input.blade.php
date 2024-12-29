@props(['type'=>'text','title'=>'','name'=>'','placeholder'=>'','value'=>'','dir'=>'rtl','class'=>'w-50'])
<div class="form-group {{$class}}">
    <label for="{{$name}}">{{$title}}</label>
    <input type="{{$type}}" name="{{$name}}" id="{{$name}}"  dir="{{$dir}}" @if($placeholder) placeholder="{{$placeholder}}" @endif value="{{$value}}" class="form-control">
    @error($name)<span class="text text-danger">{{$errors->first($name)}}</span>@enderror
</div>
