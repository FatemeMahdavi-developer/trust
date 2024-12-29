@props(['action'=>'','method'=>'post','upload_file'=>false,'id'=>'action_all'])
<form action="{{$action}}" method="{{$method}}" @if($upload_file) enctype="multipart/form-data" @endif id="{{$id}}">
    @if(session()->has('success'))
        <div class="alert alert-success">{{session()->get('success')}}</div>
    @endif
    @if($method!="get")
        @csrf
    @endif
    {{$content}}
</form>
