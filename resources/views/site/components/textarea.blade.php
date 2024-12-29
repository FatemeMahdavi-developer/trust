@props(['name'=>'','title'=>'','placeholder'=>'','value'=>''])
<div class="col-md-12 col-sm-12">
    <div class="input-box">
    @if($title)
    <label>{{$title}}</label>
    @endif
    <textarea name="{{$name}}" class="form-textarea" placeholder="{{$placeholder}}">{{$value}}</textarea>
    @error($name) <span class="text text-danger">{{$errors->first($name)}}</span> @enderror
    </div>
</div>