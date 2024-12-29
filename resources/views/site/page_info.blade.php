@extends("site.layout.base")
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-05.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-07-01.css')}}">
@endsection

@section('content')
    <div class="page-about ">

        <!-- bread crumb -->
        <div class="container-fluid container-bread-crumb" style="background-image: url({{asset("site/assets/image/bc/bg-bread-crumb-products.jpg")}}" >
            <div class="container-custom">
                <div class="row">
                    <div class="col">
                        <h1 class="page-title">{{$page["title"]}}</h1>

                        <ul class="bread-crumb">
                            <li><a href="#">صفحه اصلی</a></li>
                            <li><a href="#">{{$page["title"]}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--/ bread crumb -->
        <!-- --------------------------------------------------------------------------------------------------------------- -->
        <div class="container-fluid container-about">
            <div class="container-custom">
                <div class="row">
                    <div class="col-12">
                        <div class="section-des">
                            <div class="title">{{$page["title"]}}</div>
                            @if(isset($page["pic"]) && !empty($page["pic"]))
                                <img class="d-block mx-auto my-4" src="{{asset("upload/".$page["pic"])}}"
                                     alt="{{$page["alt_image"]}}">
                            @endif
                            <div class="des">
                                {!! $page["note"] !!}
                            </div>
                            @foreach($contents as $key => $content)
                                @if($key=="3")
                                    @if(!$content->isEmpty())
                                    <div class="container-custom">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="blog-top-items" dir="rtl">
                                                    @foreach($content as $item)
                                                        <div class="blog-top-item">
                                                            <a href="#" class="image-box"><img
                                                                    src="{{asset("upload/thumb1/".$item["pic"])}}"
                                                                    alt=""/></a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endif
                                @if($key=="7")
                                    @if(!$content->isEmpty())
                                        @foreach($content as $item)
                                            <div class="container-custom">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="section-des">
                                                            <div class="title">{{$item["title"]}}</div>
                                                            <div class="des">{!! $item["note_more"] !!}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div></div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@section("footer")
    <script type="text/javascript" src="{{asset("site/assets/js/pages/page-07-01.js")}}"></script>

@endsection
