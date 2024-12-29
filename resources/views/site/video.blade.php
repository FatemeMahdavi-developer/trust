@extends("site.layout.base")
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-08.css')}}">
@endsection
@section('content')
<div class="page-media">
<div class="container-fluid container-bread-crumb">
    <div class="container-custom">
        <div class="row">
            <div class="col">
                <h1 class="page-title">@if($video_cat) {{$video_cat->h1()}} @else {{$module_title}} @endif</h1>
                <ul class="bread-crumb">
                    @include("site.layout.partials.breadcrumb",[
                        'module_title'=>$module_title,
                        'url_page'=>"/video",
                        'breadcrumb'=>$breadcrumb,
                        'category'=>@$video_cat
                    ])
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid container-media-filter">
    <div class="container-custom">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-۱۴">
                <select name="media-filter kind" id="kind" class="select2 media-filter">
                    <option value="">همه</option>
                    <option value="1">تصاویر</option>
                    <option value="2" selected>ویدئو</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid container-media">
    <div class="container-custom">
        @if(isset($gallery_cats[0]) || isset($gallery[0]) )
        <div class="row">
            @if(isset($gallery_cats[0]))
                @foreach($gallery_cats as $item)
                <div class="col-md-4 col-sm-6">
                    <a href="{{$item->url}}" class="media-item">
                        <div class="image-box">
                            @if($item['pic'])
                                <img src="{{asset("upload/thumb1/".$item["pic"])}}" alt="{{$item["alt_image"]}}"/>
                            @else
                                <img src="{{asset("site/img/no_image/no_image(372x303).jpg")}}"  alt="{{$item["alt_image"]}}"/>
                            @endif
                        </div>
                        <div class="des">
                            <div class="no-image">{{$item->getgalleryBySubCat()->count()}} {{$item->kind_title}}</div>
                            <h3 class="title">{{$item->title}}</h3>
                        </div>
                    </a>
                </div>
                @endforeach
            @endif
            @if(isset($gallery[0]))
                @foreach($gallery as $item)
                <div class="col-md-4 col-sm-6 image-thumbnail">
                    <a  href="{{route("video.show",['video'=>$item->seo_url])}}" class="media-item item-main">
                        <div class="image-box">
                            @if($item['pic'])
                                <img src="{{asset("upload/thumb1/".$item["pic"])}}" alt="{{$item["alt_image"]}}"/>
                            @else
                                <img src="{{asset("site/img/no_image/no_image(372x303).jpg")}}"  alt="{{$item["alt_image"]}}"/>
                            @endif
                        </div>
                        <div class="des">
                            <div class="no-image" style="height:18px;"></div>
                            <h3 class="title">{{$item->title}}</h3>
                        </div>
                    </a>
                </div>
                @endforeach
            @endif
        </div>
        @else
        <div class="alert alert-danger">@lang('common.messages.result_not_found')</div>
        @endif
    </div>
</div>
</div>
@endsection

@section('footer')
<script>
    $("#kind").on("change",function(){
        window.location.href="{{route('multimedia.index')}}"+"?kind="+$(this).val();
    });
</script>
@endsection