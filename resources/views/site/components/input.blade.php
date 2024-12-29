@props(['name'=>'','title'=>'','col_class'=>'','placeholder'=>'','value'=>'','class'=>'','autocomplete'=>''])
<div @if($col_class) class="{{$col_class}}" @else class="col-md-6 col-sm-12" @endif>
    <div class="input-box">
        @if($title)
            <label>{{$title}}</label>
        @endif
        <input name="{{$name}}" class="form-input {{$class}}" @if($placeholder) placeholder="{{$placeholder}}" @endif  @if($autocomplete) autocomplete="off" @endif value="{{$value}}"/>
        @error($name)<span class="text text-danger">{{$errors->first($name)}}</span>@enderror
    </div>
</div>