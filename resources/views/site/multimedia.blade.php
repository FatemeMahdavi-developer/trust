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
                <h1 class="page-title">گالری</h1>
                <ul class="bread-crumb">
                    <li>
                        <a href="{{asset("/")}}">صفحه اصلی</a>
                    </li>
                    <li>
                        <a @if(request()->get("kind")) href="{{asset("/multimedia")}}" @else href="javascript:void(0);" @endif>{{$module_title}}</a>
                    </li>
                    @if(request()->get("kind")=='1')
                    <li>
                        <a href="javascript:void(0);">{{trans("modules.module_name_site.photo")}}</a>
                    </li>
                    @elseif(request()->get('kind')=='2')
                    <li>
                        <a href="javascript:void(0);">{{trans("modules.module_name_site.video")}}</a>
                    </li>
                    @endif
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
                    <option value="2">ویدئوها</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid container-media">
    <div class="container-custom">
        @if(isset($gallery_cats[0]))
        <div class="row">
            @foreach($gallery_cats as $item)
            <div class="col-md-4 col-sm-6 col-۱۴">
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
        </div>
        @else
        <div class="alert alert-danger">@lang('common.messages.result_not_found')</div>
        @endif
    </div>
</div>
<!-- pagination -->
{{$gallery_cats->links('site.layout.paginate.paginate')}}
<!--/ pagination -->
</div>
@endsection

@section('footer')
<script>
    $("#kind").on("change",function(){
        window.location.href="{{route('multimedia.index')}}"+"?kind="+$(this).val();
    });
    $("#kind").val("{{ Request::get('kind') }}");
</script>
@endsection