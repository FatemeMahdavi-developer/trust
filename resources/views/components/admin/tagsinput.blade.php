@props(['title'=>'','name'=>'','value'=>'','class'=>''])

<div class=form-group>
    <label for="{{$name}}">{{$title}}</label>
    <input data-role="tagsinput" id="{{$name}}" value="{{$value}}" class="form-control {{$class}}" name="{{$name}}">
    @error($name)<span class="text text-danger">{{$errors->first($name)}}</span>@enderror
</div>
