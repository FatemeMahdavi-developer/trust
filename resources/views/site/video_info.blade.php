@extends('site.layout.base')
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-07-02.css')}}">
@endsection
@section('content')
    <div class="page-blog-post">
        <div class="container-fluid container-bread-crumb"
             @if(@$video['pic_banner']) style="background-image:url({{asset("upload/thumb1/".$video["pic_banner"])}}" @endif>
            <div class="container-custom">
                <div class="row">
                    <div class="col">
                        <h1 class="page-title">{{$video->h1()}}</h1>
                        <ul class="bread-crumb">
                            @include("site.layout.partials.breadcrumb",[
                                'module_title'=>$module_title,
                                'url_page'=>'/video',
                                'breadcrumb'=>$breadcrumb,
                                'category'=>$video->gallery_cat,
                                'title'=>$video->title
                            ])
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--/ bread crumb -->
        <div class="container-fluid container-blog-post">
            <div class="container-custom">
                <div class="row">
                    <div class="col-12">
                        <div class="post-header">
                            <div class="post-data-box">
                                <div class="category-date-box" style="margin-bottom:25px">
                                    <span class="date">{{$video->date_convert('date')}}</span>
                                    <a  class="category-link">{{$video->title}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="post-header">
                            @if(@$video->video)
                                <video @if($video['pic']) poster="{{asset("upload/".$video["pic"])}}" @endif  controls style="display:block; margin:0 auto; width:90%;" >
                                    <source src="{{asset("upload/".$video->video)}}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @elseif($video->is_aparat)
                                <div style="width:90%; display:block; margin:0 auto;">{!! $video->aparat_video !!}</div>
                            @endif
                        </div>
                    </div>
                    @if($video->note)
                    <div class="col-12">
                        <div class="des-box">{!! $video["note"] !!}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection