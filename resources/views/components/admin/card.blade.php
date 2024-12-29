@props(["title"=>"","class"=>"col-12"])
<div class="card {{$class}}">
    <div class="card-header">
        <h6>{{$title}}</h6>
        {{$header_card ?? ""}}
    </div>
    <div class="card-body">
        {{$card_content ?? ""}}
    </div>
    <div class="card-footer">
        {{$footer_catrd ?? ""}}
    </div>
</div>
