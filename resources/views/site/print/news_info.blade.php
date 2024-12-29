@extends('site.print.base')
@section('title')
    {{$news["title"]}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div style="text-align: left">
                    <span>{{$news->date_convert('validity_date')}}</span>
                </div>
                <h1>{{$news['title']}}</h1>
                <div class="post my-3">
                    {!! $news["short_note"] !!}
                </div>
                @if($news['pic'])
                    <img class="w-100" src="{{asset("upload/".$news["pic"])}}" alt="{{$news["alt_image"]}}"/>
                @endif
                <div class="post">
                    {!! $news["note_more"] !!}
                </div>
            </div>
        </div>
    </div>
@endsection


