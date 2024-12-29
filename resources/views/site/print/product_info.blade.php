@extends('site.print.base')
@section('title')
    {{$product["title"]}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div style="text-align: left">
                    <span>{{$product->date_convert('validity_date')}}</span>
                </div>
                <h1>{{$product['title']}}</h1>
                <div class="post my-3">
                    {!! $product["note"] !!}
                </div>
                @if($product['pic'])
                    <img class="w-100" src="{{asset("upload/".$product["pic"])}}" alt="{{$product["alt_image"]}}"/>
                @endif
                <div class="post">
                    {!! $product["note_more"] !!}
                </div>
            </div>
        </div>
    </div>
@endsection


