@props(['title'=>'','name'=>'','class'=>'state_action','action'=>'change_state_main'])
<div class="d-flex align-items-center">
    @if(!empty($title))
        <div class="section-title " style="margin: 0 !important;font-weight: 400">نمایش در{{$title}}</div>
    @endif
    <div class="pretty p-switch">
        <input type="radio" value="1" name="change_{{$name}}" class="{{$class}}">
        <div class="state p-primary">
            <label>فعال</label>
        </div>
    </div>
    <div class="pretty p-switch">
        <input type="radio" value="0" name="change_{{$name}}" class="{{$class}}">
        <div class="state p-primary">
            <label> غیر فعال </label>
        </div>
    </div>
    <button style="display: none" type='submit' name='action_all' value='{{$action}}'></button>
</div>
