@extends("site.layout.base")
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-05.css')}}">
@endsection
@section('content')
    <div class="page-about">
        <!-- bread crumb -->
        <div class="container-fluid container-bread-crumb">
            <div class="container-custom">
                <div class="row">
                    <div class="col">
                        <h1 class="page-title">درباره ما</h1>
                        <ul class="bread-crumb">
                            <li><a href="#">صفحه اصلی</a></li>
                            <li><a href="#">درباره ما</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid container-about">
            <div class="container-custom">
                <div class="row">
                    <div class="col-12">
                        @if(isset($pages_about_title))
                            <div class="section-des">
                                <div class="title">{{$pages_about_title}}</div>
                                <div class="des">{!! $pages_about_note !!}</div>
                            </div>
                        @else
                            <div class="alert alert-danger">@lang("common.page_error",["name"=>"about"])</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid container-about container-about-vision">
            <div class="container-custom">
                <div class="row">
                    @if(isset($pages_target_title))
                        <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                            <div class="title">{{$pages_target_title}}</div>
                            @if(!empty($pages_target_pic))
                                <img class="image-01" src="{{asset("upload/".$pages_target_pic)}}"
                                     alt="{{$pages_target_alt_pic ?? $pages_target_title}}"/>
                            @endif
                        </div>
                    @else
                        <div class="alert alert-danger">@lang("common.page_error",["name"=>"target"])</div>
                    @endif
                    <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                        @if(isset($pages_target2_title))
                            @if(!empty($pages_target_pic))
                                <img class="image-02" src="{{asset("upload/".$pages_target2_pic)}}"
                                     alt="{{$pages_target2_alt_pic ?? $pages_target2_title}}"/>
                            @endif
                            {!! $pages_target2_note !!}
                        @else
                            <div class="alert alert-danger">@lang("common.page_error",["name"=>"target2"])</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid container-about">
            <div class="container-custom">
                <div class="row">
                    @if(isset($pages_duty_title))
                    <div class="col-12">
                        <div class="section-des">
                            <div class="title">{{$pages_duty_title}}</div>
                            <div class="des">{!! $pages_duty_note !!}</div>
                        </div>
                    </div>
                    @else
                        <div class="alert alert-danger">@lang("common.page_error",["name"=>"duty"])</div>
                    @endif
                </div>
            </div>
        </div>


        <div class="container-fluid container-about container-about-standard" @if(!empty($pages_standard_pic))style="background-image: url('upload/{{$pages_standard_pic}}')"@endif>
            @if(isset($pages_standard_title))
            <div class="container-custom">
                <div class="row">
                    <div class="col-md-10 offset-md-1 col-sm-12 col-12">
                        <div class="title">{{$pages_standard_title}}</div>
                        {!! $pages_standard_note !!}
                    </div>
                </div>
            </div>
            @else
                <div class="alert alert-danger">@lang("common.page_error",["name"=>"standard"])</div>
            @endif
        </div>

    </div>
@endsection
