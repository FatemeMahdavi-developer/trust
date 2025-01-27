@props(['options'=>[],'label'=>'','class'=>'','name'=>'','first_option'=>false, 'sub_method' => '','value'=>'','id'=>false,'ignore_id'=>0,'choose'=>false])
<div class="col-md-6 col-sm-12">
    <div class="input-box {{$class}}" @if($id) id="{{$id}}" @endif>
        @if($label)
        <label class="control-label">{{$label}}</label>
        @endif
        <select class="select2" name="{{$name}}" data-placeholder="{{$placeholder}}">
            @if($first_option)
                <option value="0">{{$first_option}}</option>
            @endif
            @if($choose)
                <option value="">انتخاب کنید</option>
            @endif
            @if(isset($options[0]))
                @foreach($options as $option)
                    @if($ignore_id)
                        @if($option['id'] != $ignore_id)
                            <option value="{{$option["id"]}}" @if($option['id'] == $value) selected @endif>{{$option["title"]}}</option>
                            @component("site.components.sub_option",['options'=>$option, 'method'=>$sub_method,'value'=>$value])@endcomponent
                        @endif
                    @else
                        <option value="{{$option["id"]}}" @if($option['id'] == $value) selected @endif>{{$option["title"]}}</option>
                        @component("site.components.sub_option",['options'=>$option, 'method'=>$sub_method,'value'=>$value])@endcomponent
                    @endif
                @endforeach
            @endif
        </select>
        @error($name)<span class="text text-danger">{{$errors->first($name)}}</span>@enderror
    </div>
</div>
@if(!empty($value))
    <script>
        var select = document.getElementById('{{$name}}');
        select.value = '{{$value}}';
    </script>
@endif
