@extends("site.layout.base")
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-08.css')}}">
@endsection

@section('content')
<div class="page-media">
<div class="container-fluid container-bread-crumb" @if(@$photo_cat['pic_banner']) style="background-image: url({{asset("upload/thumb1/".$photo_cat["pic_banner"])}}" @endif>
    <div class="container-custom">
        <div class="row">
            <div class="col">
                <h1 class="page-title">@if($photo_cat) {{$photo_cat->h1()}} @else {{$module_title}} @endif</h1>
                <ul class="bread-crumb">
                    @include("site.layout.partials.breadcrumb",[
                        'module_title'=>$module_title,
                        'url_page'=>'/photo',
                        'breadcrumb'=>$breadcrumb,
                        'category'=>@$photo_cat
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
                    <option value="1" selected>تصاویر</option>
                    <option value="2">ویدئو</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid container-media">
    <div class="container-custom">
        @if(isset($gallery_cats[0]) || isset($gallery[0]) )
        <div class="row image-thumbnail">
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
                <div class="col-md-4 col-sm-6 ">
                    <a  @if($item['pic']) href="{{asset("upload/".$item["pic"])}}" @else href="{{asset("site/img/no_image/no_image(372x303).jpg")}}" @endif class="media-item item-main lightpic">
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

    $(document).ready(function() {
        if(!$.fn.lightGallery) return false;
        $('.image-thumbnail').lightGallery({
            selector: '.item-main',
            videojs: false,
            share: false,
            hash: false
        });
    });
</script>
@endsection