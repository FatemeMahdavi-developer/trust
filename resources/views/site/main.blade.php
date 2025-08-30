@extends("site.layout.base")
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-01.css')}}">
@endsection

@section('content')
<div class="page-home">
    @if($banners)
        <div class="container-fluid container-page-slider">
            <div class="page-slider-items" dir="rtl">
                @foreach($banners as $banner)
                <a href="{{$banner->address}}" class="item">
                    <div class="image-box">
                        @if($banner->pic)
                            <img src="{{asset("upload/thumb1/".$banner->pic)}}" alt="{{$banner->alt_image}}">
                        @else
                            <img class="object-cover rounded-b-3xl w-full" src="{{asset("site/img/no_image/no_image(1360x780).jpg")}}"  alt="{{$banner->alt_image}}">
                        @endif
                    </div>
                    @if($banner->title)
                        <h3 class="title">{{$banner->title}}</h3>
                    @endif
                </a>
                @endforeach
            </div>
            <div class="slick-counter-button">
                <button class="slick-next-custom" type="button"><i class="fi fi-rr-angle-right icon"></i></button>
                <button class="slick-prev-custom" type="button"><i class="fi fi-rr-angle-left icon"></i></button>
                <div class="slick-counter"></div>
            </div>
        </div>
    @endif
    <div class="container-fluid container-blog">
        <div class="container-custom">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <div class="title">هوشمندانه وسایلتو بسپار، آزادانه حرکت کن</div>
                    </div>
                    <div class="container-category">
                        <div class="category-item ">
                            <span class="title">سیستم قفل هوشمند با دسترسی امن </span>
                        </div>
                        <div class="category-item ">
                            <span class="title">رزرو و باز کردن لاکر تنها با چند کلیک</span>
                        </div>
                        <div class="category-item">
                            <span class="title">تحویل و دریافت سریع بدون نیاز به صف و انتظار</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(isset($pages_main_title))
        <div class="container-fluid container-banner" @if(isset($pages_main_pic) && !empty($pages_main_pic)) style='background-image:url({{asset("upload/".$pages_main_pic)}})' @endif>
            <div class="container-custom">
                <div class="row">
                    <div class="col">
                        <div class="des">{{$pages_main_title}}</div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(isset($news[0]))
    <div class="container-fluid container-blog">
        <div class="container-custom">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <div class="title">بلاگ</div>
                        <a href="" class="link">مشاهده بیشتر</a>
                    </div>
                    <div class="blog-top-items" dir="rtl">
                        @foreach($news as $item)
                            <div class="blog-top-item">
                                <a href="{{$item->url}}" class="image-box">
                                    @if(@$item['pic'])
                                        <img src="{{asset("upload/thumb2/".$item["pic"])}}" alt=""/>
                                    @else
                                        <img src="{{asset("site/img/no_image/no_image(372x358).jpg")}}" alt=""/>
                                    @endif
                                </a>

                                <div class="post-data-box">
                                    <div class="date-box">
                                        <span class="date">{{$item->date_convert('validity_date')}}</span>
                                    </div>

                                    @if(isset($item->news_cat->title))
                                        <div class="category-box">
                                            <a href="{{route('news.index',['news_cat'=>$item->news_cat->seo_url])}}"
                                                class="category-link">{{$item->news_cat->title}}</a>
                                        </div>
                                    @endif

                                    <a href="{{$item->url}}" class="link-title"><span
                                            class="title">{{$item["title"]}}<br/><br/>
                                    </span></a>

                                    <div class="des-link-more-box">
                                        <div class="des">{{$item["news_note"]}}</div>

                                        <div class="link-more-box">
                                            <a href="{{$item->url}}" class="link-more">مشاهده بیشتر</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="container-fluid container-about">
        <div class="container-custom">
            <div class="row">
                <div class="col-12">
                    <div class="col-des">
                        <div class="title">لاکرت هوشمند، انتخابت هوشمندانه</div>
                        <div class="des">
                            <ul class="list-unstyled">
                                <li>سامانه لاکرهای هوشمند لاکیتو، راهکاری نوین برای مدیریت و نگهداری ایمن وسایل شخصی و سازمانی است و طراحی هوشمندانه لاکرها، تجربه‌ای مدرن و متفاوت از نگهداری وسایل را فراهم می‌سازد.</li>
                                <li>این سامانه با بهره‌گیری از فناوری‌های روز، امنیت بالا و سهولت در استفاده را برای کاربران تضمین می‌کند و
                                فرآیند اجاره و استفاده از لاکرها کاملاً آنلاین و سریع انجام می‌شود.</li>
                                <li>انتخاب این سامانه، گامی هوشمندانه در جهت ارتقای امنیت، کارآمدی و رضایت مشتریان است.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(isset($instagram_posts[0]))
        <div class="container-fluid container-instagram">
            <div class="container-custom">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <div class="title">ما را در اینستاگرام دنبال کنید</div>
                        </div>
                        <div class="section-title section-title-2">
                            <a href="" class="link">lockito <i class="fi fi-rr-instagram"></i></a>
                        </div>
                        <div class="instagram-items" dir="rtl">
                            @foreach($instagram_posts as $instagram_post)
                            <div class="slide-instagram-item">
                                <a href="{{$instagram_post['link']}}" class="image-box">
                                    @if($instagram_post['pic'])
                                        <img src="{{asset("upload/thumb1/".$instagram_post["pic"])}}" alt="{{$instagram_post["alt_image"]}}"/>
                                    @else
                                        <img src="{{asset("site/img/no_image/no_image(310x300).jpg")}}" alt="{{$instagram_post["alt_image"]}}"/>
                                    @endif
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@section('footer')
    <script type="text/javascript" src="{{asset('site/assets/js/pages/page-01.js')}}"></script>
@endsection
