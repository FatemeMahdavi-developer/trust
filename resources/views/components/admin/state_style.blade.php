@props(['column'=>'','id'=>'','state'=>'','class'=>'success','title'=>''])
{{-- @php $module=explode("/",url()->current()) @endphp
@can("read_".end($module)) --}}
<div class="pretty p-switch">
    <input type="checkbox" class="state_checkbox"
           data-column="{{$column}}"
           data-item="{{$id}}"
           @if($state) checked @endif>
    <div class="state p-{{$class}}">
        <label>{{$title}}</label>
    </div>
</div>
{{-- @else
<div class="btn btn-sm @if($state=='1') btn-success @else btn-danger @endif">{{trans("common.state")[$state]}}</div>
@endcan --}}