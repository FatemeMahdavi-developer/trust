@props(['title'=>'','name'=>'','placeholder'=>'','value'=>'','dir'=>'rtl','class'=>'','module'=>false])

<div class="form-group {{$class}}">
    <label for="{{$name}}">@if(!$module) {{$title}} @else {{$title}} {{getMaxSize($module,$name)}} @endif</label>
    <div class="d-flex">
        <input type="file" id="{{$name}}" name="{{$name}}" class="form-control">
        @if(!empty($value) && in_array(pathinfo($value,PATHINFO_EXTENSION),['jpeg','png','jpg','gif','svg','webp']))
            <img src="{{asset('upload/'.$value)}}"
                 width="50" height="50" alt="" class="mx-2" style="border-radius: 6px">
        @endif
    </div>
    @if(!empty($value))
        <input type="text" class="form-control disabled" name="{{$name}}" value="{{$value}}">
    @endif
    @error($name)<span class="text text-danger">{{$errors->first($name)}}</span>@enderror
</div>
