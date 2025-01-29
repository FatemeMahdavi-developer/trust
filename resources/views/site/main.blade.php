@extends("site.layout.base")
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-01.css')}}">
@endsection

@section('content')
    <div class="page-home">
        <!-- page slider -->
        <div class="container-fluid container-page-slider">
            <div class="page-slider-items" dir="rtl">
                <a href="" class="item">
                    <div class="image-box"><img src="{{asset("site/assets/image/closet.jpg")}}" alt=""/></div>
                    <h3 class="title">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                        گرافیک است</h3></a>
                {{-- <a href="" class="item">
                    <div class="image-box"><img src="{{asset("site/assets/image/slider-02.jpg")}}" alt=""/></div>
                    <h3 class="title">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                        گرافیک است</h3></a> --}}
            </div>

            <div class="slick-counter-button">
                <button class="slick-next-custom" type="button"><i class="fi fi-rr-angle-right icon"></i></button>
                <button class="slick-prev-custom" type="button"><i class="fi fi-rr-angle-left icon"></i></button>

                <div class="slick-counter"></div>
            </div>
        </div>
        <!--/ page slider -->

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
                                    <a href="" class="image-box">
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

                                        <a href="" class="link-title"><span
                                                class="title">{{$item["title"]}}<br/><br/>
                                        </span></a>

                                        <div class="des-link-more-box">
                                            <div class="des">{{$item["news_note"]}}</div>

                                            <div class="link-more-box">
                                                <a href="" class="link-more">مشاهده بیشتر</a>
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

{{--
       <!-- banner -->
       <div class="container-fluid container-banner">
        <div class="container-custom">
            <div class="row">
                <div class="col">
                    <div class="des">بهترین ها را با گاز استریل پنبه تجربه کنید</div>
                </div>
            </div>
        </div>
    </div>
    <!--/ banner --> --}}

        <!-- about -->
        <div class="container-fluid container-about">
            <div class="container-custom">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-6 col-video">
                        <img src="{{asset("site/assets/image/home-about.jpg")}}" class="video-poster"/>
                        <!--                <video preload="none">-->
                        <!--                    <source src="" type="video/mp4">-->
                        <!--                </video>-->
                        <span class="icon-play" data-bs-toggle="modal" data-bs-target="#modal-video"></span>
                    </div>

                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="col-des">
                            <div class="title">درباره ما</div>

                            <div class="des">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از
                                طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                برای
                                شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می
                                طلبد تا
                                با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ
                                پیشرو
                                در زبان فارسی ایجاد کرد.
                            </div>

                            <div class="link-more-box">
                                <a href="" class="link-more">مشاهده بیشتر</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ about -->




    <!-- certificate -->
        {{-- <div class="container-fluid container-certificate">
            <div class="container-custom">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title section-title-white">
                            <div class="title center">گواهینامه ها و تندیس ها</div>
                            <a href="" class="link">مشاهده بیشتر</a>
                        </div>
                        <div class="certificate-items" dir="rtl">
                            <div class="certificate-item">
                                <div class="image-box"><img
                                        src="{{asset("site/assets/image/certificate/certificate-01.png")}}" alt=""/>
                                </div>
                                <div class="des">دریافت تقدیرنامه مسئول کنترل کیفیت نمونه استان مرکزی از اداره استاندارد
                                    و
                                    تحقیقات صنعتی استان مرکزی در سالهای ۱۳۸۴ و ۱۳۹۴<br/><br/><br/><br/></div>
                            </div>

                            <div class="certificate-item">
                                <div class="image-box"><img
                                        src="{{asset("site/assets/image/certificate/certificate-02.png")}}" alt=""/>
                                </div>
                                <div class="des">دریافت تقدیرنامه مسئول کنترل کیفیت نمونه استان مرکزی از اداره استاندارد
                                    و
                                    تحقیقات صنعتی استان مرکزی در سالهای ۱۳۸۴ و ۱۳۹۴<br/><br/><br/><br/></div>
                            </div>

                            <div class="certificate-item">
                                <div class="image-box"><img
                                        src="{{asset("site/assets/image/certificate/certificate-01.png")}}" alt=""/>
                                </div>
                                <div class="des">دریافت تقدیرنامه مسئول کنترل کیفیت نمونه استان مرکزی از اداره استاندارد
                                    و
                                    تحقیقات صنعتی استان مرکزی در سالهای ۱۳۸۴ و ۱۳۹۴<br/><br/><br/><br/></div>
                            </div>

                            <div class="certificate-item">
                                <div class="image-box"><img
                                        src="{{asset("site/assets/image/certificate/certificate-02.png")}}" alt=""/>
                                </div>
                                <div class="des">دریافت تقدیرنامه مسئول کنترل کیفیت نمونه استان مرکزی از اداره استاندارد
                                    و
                                    تحقیقات صنعتی استان مرکزی در سالهای ۱۳۸۴ و ۱۳۹۴<br/><br/><br/><br/></div>
                            </div>

                            <div class="certificate-item">
                                <div class="image-box"><img
                                        src="{{asset("site/assets/image/certificate/certificate-01.png")}}" alt=""/>
                                </div>
                                <div class="des">دریافت تقدیرنامه مسئول کنترل کیفیت نمونه استان مرکزی از اداره استاندارد
                                    و
                                    تحقیقات صنعتی استان مرکزی در سالهای ۱۳۸۴ و ۱۳۹۴<br/><br/><br/><br/></div>
                            </div>

                            <div class="certificate-item">
                                <div class="image-box"><img
                                        src="{{asset("site/assets/image/certificate/certificate-02.png")}}" alt=""/>
                                </div>
                                <div class="des">دریافت تقدیرنامه مسئول کنترل کیفیت نمونه استان مرکزی از اداره استاندارد
                                    و
                                    تحقیقات صنعتی استان مرکزی در سالهای ۱۳۸۴ و ۱۳۹۴<br/><br/><br/><br/></div>
                            </div>

                            <div class="certificate-item">
                                <div class="image-box"><img
                                        src="{{asset("site/assets/image/certificate/certificate-01.png")}}" alt=""/>
                                </div>
                                <div class="des">دریافت تقدیرنامه مسئول کنترل کیفیت نمونه استان مرکزی از اداره استاندارد
                                    و
                                    تحقیقات صنعتی استان مرکزی در سالهای ۱۳۸۴ و ۱۳۹۴<br/><br/><br/><br/></div>
                            </div>

                            <div class="certificate-item">
                                <div class="image-box"><img
                                        src="{{asset("site/assets/image/certificate/certificate-02.png")}}" alt=""/>
                                </div>
                                <div class="des">دریافت تقدیرنامه مسئول کنترل کیفیت نمونه استان مرکزی از اداره استاندارد
                                    و
                                    تحقیقات صنعتی استان مرکزی در سالهای ۱۳۸۴ و ۱۳۹۴<br/><br/><br/><br/></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!--/ certificate -->


        <!-- instagram -->
        {{-- @if(isset($instagram_posts[0]))
            <div class="container-fluid container-instagram">
                <div class="container-custom">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <div class="title">ما را در اینستاگرام دنبال کنید</div>
                            </div>
                            <div class="section-title section-title-2">
                                <a href="" class="link">cotton <i class="fi fi-rr-instagram"></i></a>
                            </div>

                            <div class="instagram-items" dir="rtl">
                                @foreach($instagram_posts as $instagram_post)
                                <div class="slide-instagram-item">
                                    <a href="{{$instagram_post['link']}}" class="image-box">
                                        @if($instagram_post['pic'])
                                            <img src="{{asset("upload/thumb1/".$instagram_post["pic"])}}"
                                                 alt="{{$instagram_post["alt_image"]}}"/>
                                        @else
                                            <img src="{{asset("site/img/no_image/no_image(310x300).jpg")}}"
                                                 alt="{{$instagram_post["alt_image"]}}"/>
                                        @endif
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif --}}
        <!--/ instagram -->
    </div>
@endsection
@section('footer')
    <script type="text/javascript" src="{{asset('site/assets/js/pages/page-01.js')}}"></script>
@endsection
