@extends("site.layout.base")
@section('seo')
    @include("site.layout.partials.seo",["seo"=>$seo,"module"=>$module])
@endsection
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-07-01.css')}}">
@endsection

@section('content')
    <div class="page-blog">
        <!-- bread crumb -->
        <div class="container-fluid container-bread-crumb" @if(@$news_cat->pic_banner) style="background-image: url({{asset("upload/thumb1/".$news_cat->pic_banner)}}" @endif>
            <div class="container-custom">
                <div class="row">
                    <div class="col">
                        <h1 class="page-title">@if(@$news_cat){{$news_cat->h1()}}@else @lang('modules.module_name_site.news') @endif</h1>
                        <ul class="bread-crumb">
                            @include("site.layout.partials.breadcrumb",[
                                'module_title'=>$module_title,
                                'url_page'=>'/news',
                                'breadcrumb'=>$breadcrumb,
                                'category'=>@$news_cat
                            ])
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--/ bread crumb -->
        <div class="container-fluid container-blog">
            <div class="container-custom">
                <div class="row">
                    @if(isset($hit_news[0]))
                        <div class="col-12">
                            <div class="section-title">
                                <div class="title">پر بازدیدترین اخبار</div>
                            </div>

                            <div class="blog-top-items" dir="rtl">
                                @foreach($hit_news as $item)
                                    <div class="blog-top-item">
                                        <a href="{{$item->url}}" class="image-box">
                                            @if($item['pic'])
                                                <img src="{{asset("upload/thumb2/".$item["pic"])}}"
                                                     alt="{{$item["alt_image"]}}"/>
                                            @else
                                                <img src="{{asset("site/img/no_image/no_image(372x358).jpg")}}"
                                                     alt="{{$item["alt_image"]}}"/>
                                            @endif
                                        </a>

                                        <div class="post-data-box">
                                            <div class="date-box">
                                                <span class="date">{{$item->date_convert('validity_date')}}</span>
                                            </div>

                                            <div class="category-box">
                                                <a href="{{$item->news_cat->url}}"
                                                   class="category-link">{{$item->news_cat->title}}</a>
                                            </div>

                                            <a href="{{$item->url}}" class="link-title"><span
                                                    class="title">{{$item['title']}}<br/><br/></span></a>

                                            <div class="des-link-more-box">
                                                <div class="des">{{$item["short_note"]}}<br/><br/><br/></div>

                                                <div class="link-more-box">
                                                    <a href="{{$item->url}}" class="link-more">مشاهده بیشتر</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>


                <form id="form_news" method="get">
                    <div class="row row-filter">
                        <div class="col-xl-4 col-lg-4 col-md-5 col-sm-5 col-12">
                            <select id="catid" class="catid select2 selectNews">
                                <option value="{{route('news.index')}}">انتخاب کنید</option>
                                @foreach($news_cats as $item)
                                    <option value="{{$item['url']}}"
                                            @if(@$news_cat['id'] == $item['id']) selected @endif>{{$item["title"]}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-7 col-sm-7 col-12">
                            <div class="form-blog-search">
                                <input type="text" placeholder="جستجو دسته بندی مورد نظر" name="keyword"
                                       value="{{request()->get('keyword')}}"/>
                                <button type="submit"><i class="icon-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                @if(isset($news[0]))
                    <div class="row">
                        @foreach($news as $item)
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                <div class="blog-item">
                                    <a href="{{$item->url}}" class="image-box">
                                        @if($item['pic'])
                                            <img src="{{asset("upload/thumb3/".$item["pic"])}}"
                                                 alt="{{$item["alt_image"]}}"/>
                                        @else
                                            <img src="{{asset("site/img/no_image/no_image(274x264).jpg")}}"
                                                 alt="{{$item["alt_image"]}}"/>
                                        @endif
                                    </a>
                                    <div class="post-data-box">
                                        <div>
                                            <a href="{{$item->url}}" class="link-title">
                                                <span class="title">{{$item['title']}}</span>
                                            </a>

                                            <div class="des">{{$item["short_note"]}}</div>
                                        </div>
                                        <div class="category-date-box">
                                            <span class="date">{{$item->date_convert('validity_date')}}</span>
                                            <a href="{{$item->news_cat->url}}"
                                               class="category-link">{{$item->news_cat->title}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-danger">@lang('common.messages.result_not_found')</div>
                @endif
            </div>
        </div>


        <!-- pagination -->
    {{$news->links('site.layout.paginate.paginate')}}
    <!--/ pagination -->
    </div>

@endsection
@section('footer')
    <script type="text/javascript" src="{{asset('site/assets/js/pages/page-07-01.js')}}"></script>
    <script>

        var keyword = '';
        var query_string = '';
        $("#form_news select").on('change', function () {
            $("#form_news").trigger('submit')
        })
        $("#form_news").on('submit', function (e) {
            keyword = $("[name='keyword']").val()
            query_string = $("#form_news select").val();
            e.preventDefault();
            if (keyword.length != '0') {
                query_string += "?keyword=" + keyword
            }
            window.location.href = query_string
        })
    </script>
@endsection
