@props(['name'=>'','title'=>'','class_clear'=>'','kinds'=>[]])
<div class="clone_03" style="margin:10px 0px">                                
    <h2>{{$title}}</h2>
    <br>
    <div class="row myform addField_03">
        @foreach($kinds as $item)     
            @if($item['type']=='input')
                @component('site.components.input',['name'=>$name.'['.$item['name'].'][]','placeholder'=>$item['placeholder'],'class'=>$class_clear])@endcomponent   {{-- 'value'=>old('name') --}}          
                @if($errors->has($name.'.*'))
                @if($errors->has($name.'.'.$item['name'].'.*'))
                @foreach ($errors->get($name.'.'.$item['name'].'.*') as $message)
                        @foreach ( $message as $value)
                                <span class="text text-danger d-block">{{ $value }}</span>
                        @endforeach
                    @endforeach
                    @endif
                @endif

            @elseif($item['type']=='select')
                @component("site.components.select",['name'=>$name.'['.$item['name'].'][]','items'=>$item['items'],'placeholder'=>$item['placeholder']])@endcomponent
            @endif
        @endforeach
    </div>
    <a href="javascript:void(0);" class="adding addField03"> + افزودن </a>
    @error($name)<span class="text text-danger">{{$errors->first($name)}}</span>@enderror
</div>