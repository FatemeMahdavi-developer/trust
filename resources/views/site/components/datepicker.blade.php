@props(['title'=>'','value'=>'','name'=>'','class'=>'','class'=>'','hour_minute'=>true,'placeholder'=>''])
<div class="col-md-6 col-sm-12">
    @if($title)<label>{{$title}}</label>@endif
    <div class="input-box flex-row">
        <input type="text" name="{{$name}}[0]" class="form-input datepicker-input" @if($placeholder)placeholder="{{$placeholder}}" @endif  @if(isset($value[0])) value="{{$value[0]}}" @endif autocomplete="off" @if($hour_minute)name="{{$name}}[0]"@else name="{{$name}}" @endif/>
        @if($hour_minute)
        <div class="d-flex">
            <select name="{{$name}}[1]" id="hour_{{$name}}" class="form-control" style="width:110px">
                <option value="">ساعت</option>
                @for($i=0;$i<=23;$i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
            <select name="{{$name}}[2]" id="minute_{{$name}}" class="form-control">
                <option value="">دقیقه</option>
                @for($i=0;$i<=59;$i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        @endif
    </div>
    @error($name)<span class="text text-danger">{{$errors->first($name)}}</span>@enderror
</div>

@if(isset($value[1]))
    <script>
        var select = document.getElementById('hour_{{$name}}');
        select.value = '{{$value[1]}}';
    </script>
@endif

@if(isset($value[2]))
    <script>
        var select = document.getElementById('minute_{{$name}}');
        select.value = '{{$value[2]}}';
    </script>
@endif


