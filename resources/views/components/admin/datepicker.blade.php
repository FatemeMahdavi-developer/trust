@props(['title'=>'','value'=>'','name'=>'','class'=>'','hour_minute'=>true])
<div class="form-group {{$class}}">
    <label>{{$title}}</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fas fa-calendar"></i>
            </div>
        </div>
        <input type="text" class="form-control datepicker-Depart" @if(isset($value[0])) value="{{$value[0]}}" @endif autocomplete="off" @if($hour_minute)name="{{$name}}[0]"@else name="{{$name}}" @endif>
        @if($hour_minute)
            <div class="d-flex">
                <select name="{{$name}}[1]" id="hour_{{$name}}" class="form-control">
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


