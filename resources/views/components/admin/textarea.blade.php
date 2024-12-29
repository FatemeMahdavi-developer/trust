@props(['title'=>'','name'=>'','placeholder'=>'','value'=>'','class'=>''])
<div class="form-group {{$class}}">
    <label for="{{$name}}">{{$title}}</label>
    <textarea name="{{$name}}" id="{{$name}}" class="form-control">{{$value}}</textarea>
    @error($name)<span class="text text-danger">{{$errors->first($name)}}</span>@enderror

</div>
