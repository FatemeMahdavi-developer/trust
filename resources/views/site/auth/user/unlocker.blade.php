@extends("site.layout.base")
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-11.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-11-01.css')}}">
@endsection
@section('content')
    <div class="page-profile">
        <!-- bread crumb -->
        <div class="container-fluid container-bread-crumb"
             @if($module_pic) style="background-image:url({{asset("upload/".$module_pic)}})" @endif >
            <div class="container-custom">
                <div class="row">
                    <div class="col">
                        <h1 class="page-title">{{$module_title}}</h1>
                        <ul class="bread-crumb">
                            @include("site.layout.partials.breadcrumb",[
                                'module_title'=>$module_title,
                            ])
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid container-profile">
            <div class="container-custom">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-12">
                        @include("site.auth.partials.user_panel")
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-8 col-12">
                        @if(isset($orders[0]))
                            <div class="row">
                                @foreach($orders as $order)
                                    <div class="col-sm-6 col-12">
                                        <a href="{{route("user.unlocker_info",["box"=>$order->basket->box->id])}}" class="link-box">
                                            <i class="fi fi-rr-comment icon"></i>
                                            <div class="title">{{$order->basket->box->title ?? "--"}}</div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-danger">نتیجه ای یافت نشد</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

