@props(['title'=>'','name'=>'','placeholder'=>'','value'=>'','dir'=>'rtl','class'=>'','module'=>false])

<div class="form-group {{$class}}">
    <label for="{{$name}}">@if(!$module) {{$title}} @else {{$title}} {{getMaxSize($module,$name)}} @endif</label>
    <div class="d-flex">
        <input type="file" id="{{$name}}" name="{{$name}}[]" class="form-control" multiple>
    </div>
    @if($errors->has($name.'.*'))
        @foreach ($errors->get($name.'.*') as $message)
            @foreach ( $message as $value)
                <span class="text text-danger d-block">{{ $value }}</span>
            @endforeach
        @endforeach
    @endif
    @error($name)
        <span class="text text-danger d-block">{{$errors->first($name)}}</span>
    @enderror
</div>
