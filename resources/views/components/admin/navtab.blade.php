@props(['number'=>2,'titles'=>[]])
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    @for($i=0;$i<$number;$i++)
        <li class="nav-item">
            <a class="nav-link @if($i=='0') active @endif" id="pills-home-tab" data-toggle="pill"
               href="#{{\Illuminate\Support\Str::slug($titles[$i])}}"
               role="tab">{{$titles[$i]}}</a>
        </li>
    @endfor
</ul>
<div class="tab-content" id="pills-tabContent">
    @for($i=0;$i<$number;$i++)
        <div class="tab-pane fade @if($i=='0') show active @endif" id="{{\Illuminate\Support\Str::slug($titles[$i])}}"
             role="tabpanel">
            @php $name = "tabContent$i" @endphp
            {{$$name}}
        </div>
    @endfor
</div>
