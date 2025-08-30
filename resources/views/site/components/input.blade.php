@props(['name'=>'','type'=>'text','title'=>'','col_class'=>'','placeholder'=>'','value'=>'','class'=>'','autocomplete'=>''])
<div @if($col_class) class="{{$col_class}}" @else class="col-md-6 col-sm-12" @endif>
    <div class="input-box">
        @if($title)
            <label>{{$title}}</label>
        @endif
        <input type="{{$type}}" name="{{$name}}" class="form-input {{$class}}" @if($placeholder) placeholder="{{$placeholder}}" @endif  @if($autocomplete) autocomplete="off" @endif value="{{$value}}"/>
        @php
            $errorName = $name;
            if (preg_match('/\[\d*\]$/', $name)) {
                $errorName = str_replace(['[', ']'],['.',''], $name);
            }
        @endphp
        @error($errorName)<span class="text text-danger">{{$errors->first($errorName)}}</span>@enderror
    </div>
</div>
