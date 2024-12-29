@extends('site.layout.base')
@section('seo')
    @include("site.layout.partials.seo",["seo"=>$seo,"module"=>$module])
@endsection
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-03.css')}}">
@endsection
@section('content')
<div class="page-product">
<div class="container-fluid container-bread-crumb" @if(@$product['pic_banner']) style="background-image: url({{asset("upload/thumb1/".$product["pic_banner"])}}" @endif>
    <div class="container-custom">
        <div class="row">
            <div class="col">
                <h1 class="page-title">{{$product->h1()}}</h1>
                <ul class="bread-crumb">
                    @include("site.layout.partials.breadcrumb",[
                        'module_title'=>$module_title,
                        'url_page'=>'/product',
                        'breadcrumb'=>$breadcrumb,
                        'category'=>$product->product_cat,
                        'title'=>$product->title
                    ])
                </ul>
            </div>
        </div>
    </div>
</div>
<!--/ bread crumb -->
<div class="container-fluid container-product">
    <div class="container-custom">
        <div class="row">
            <div class="col-12">
                <div class="product-detail-box">
                    <div class="row">
                        <div class="col-12 product-title-2-box">
                            <div class="product-title"><h2 class="title">{{$product->title}}</h2></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="images-box">
                                @if(!$content_pics->isEmpty())
                                <div class="image-thumbnail">
                                    <a  @if($product->pic) href="{{asset("upload/".$product->pic)}}" @else  href="{{asset("site/img/no_image/no_image(470x470).jpg")}}"  @endif class="item item-main">
                                        @if($product->pic)
                                            <img src="{{asset("upload/thumb4/".$product->pic)}}" alt="{{$product->alt_image}}"/>
                                        @else
                                            <img src="{{asset("site/img/no_image/no_image(78x78).jpg")}}" alt="{{$product->alt_image}}"/>
                                        @endif
                                    </a>
                                    @foreach ($content_pics->slice(0,3) as $item)
                                            <a @if($item->pic) href="{{asset("upload/".$item->pic)}}"  @else href="{{asset("upload/".$item->pic)}}" @endif class="item item-main">
                                                @if($item->pic)
                                                    <img src="{{asset("upload/thumb1/".$item->pic)}}" alt="{{$item->alt_image}}"/>
                                                @else
                                                    <img src="{{asset("site/img/no_image/no_image(78x78).jpg")}}" alt="{{$item->alt_image}}"/>
                                                @endif
                                            </a>
                                    @endforeach
                                    @if($content_pics->count() > 3)
                                    <a href="javascript:void(0);" class="item item-more"><i class="fi fi-rr-menu-dots icon"></i></a>
                                    @endif
                                    @foreach ($content_pics->slice(3,25) as $item)
                                    <a @if($item->pic) href="{{asset("upload/".$item->pic)}}"  @else href="{{asset("upload/".$item->pic)}}" @endif class="item item-main d-none">
                                        @if($item->pic)
                                            <img src="{{asset("upload/thumb1/".$item->pic)}}" alt="{{$item->alt_image}}"/>
                                        @else
                                            <img src="{{asset("site/img/no_image/no_image(78x78).jpg")}}" alt="{{$item->alt_image}}"/>
                                        @endif
                                    </a>
                                    @endforeach
                                </div>
                                @endif
                                <a href="javascript:void(0);" class="image-big-box">
                                    @if($product->pic)
                                        <img src="{{asset("upload/thumb1/".$product->pic)}}" alt="{{$product->alt_image}}"/>
                                    @else
                                        <img src="{{asset("site/img/no_image/no_image(470x470).jpg")}}" alt="{{$product->alt_image}}"/>
                                    @endif
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="data-box">
                                <div>
                                    <div class="product-title"><h1 class="title">{{$product->title}}</h1></div>
                                    <div style="display: flex;     justify-content: space-between;">
                                        <div class="score-box">
                                            @if($product->count_rate())
                                            <span class="person">({{$product->count_rate()}})</span>
                                            <span class="score">{{$product->avg()}}</span>
                                            <div class="stars show_rate_stars" data-score={{$product->avg()}}></div>
                                            @endif
                                        </div>
                                        <div class="score-box">
                                            <a href="javascript:void(0);" class="btn-custom add_like"style="width: 190px;">
                                                <img src="{{asset("site/assets/image/icon4.svg")}}" style="padding-left:5px;">
                                                افزودن به علاقه مندی
                                            </a>
                                        </div>
                                    </div>
                                    <div class="btns-box">
                                       @if($product->code)<div class="item">کد محصول  {{$product->code}}</div> @endif
                                        <div class="item"><a href="{{route('product.print',['product'=>$product['seo_url']])}}"><i class="icon icon-print"></i> چاپ صفحه</a></div>
                                        <div class="item">
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modal-share">
                                                <i class="icon icon-share"></i> اشتراک گذاری
                                            </a>
                                        </div>
                                        @if(isset($content_catalog['catalog']))
                                            <div class="item"><a href="{{asset("upload/".$content_catalog['catalog'])}}" target="_blanks"><i class="icon icon-download"></i> دانلود کاتالوگ</a></div>
                                        @endif
                                    </div>
                                    @if($product->note)
                                    <div class="property-box">
                                        <div class="title">ویژگی ها</div>
                                        {!! $product->note !!}
                                    </div>
                                    @endif
                                </div>
                                @if($product->price)
                                <div class="price-btn-add-to-basket-box" style="justify-content: end">
                                    <div class="price-box">
                                        <span class="price">{{show_price($product->price)}}</span>
                                        <span class="price-unit">تومان</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($product->note_more)
        <div class="row">
            <div class="col-12">
                <div class="product-des-property-comment-box">
                    <div id="des-box">
                        <ul class="section-tabs">
                            <li class="tab-item"><a href="#des-box" class="tab-link active"><span class="title">معرفی محصول</span></a></li>
                            <li class="tab-item"><a href="#comment-box" class="tab-link"><span class="title">نظرات کاربران</span></a></li>
                        </ul>
                        <div class="des-box">
                            {!! $product->note_more !!}
                            {{-- <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
                            <div class="row row-image">
                                <div class="col-12"><img src="{{asset('site/assets/image/product.jpg')}}" alt="" /></div>
                            </div>
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<div class="container-fluid container-product">
    <div class="container-custom">
        <div class="row">
            <div class="col-12">
                <div class="product-des-property-comment-box">
                    <div id="comment-box">
                        <ul class="section-tabs">
                            @if($product->note_more)
                            <li class="tab-item"><a href="#des-box" class="tab-link"><span class="title">معرفی محصول</span></a></li>
                            @endif
                            <li class="tab-item"><a href="#comment-box" class="tab-link active"><span class="title">نظرات کاربران</span></a></li>
                        </ul>
                        <div class="comment-box">
                            <div class="section-title">
                                <span class="title">نظرات کاربران</span>
                                <div class="btn-new-comment-des-box">
                                    <span class="des">شما هم می توانید درمورد این محصول نظر بدهید</span>
                                    @auth
                                        <button type="button" class="btn-custom" data-bs-toggle="modal" data-bs-target="#modal-comment">افزودن نظر جدید </button>
                                    @else
                                        <a href="{{route('auth.login')}}" class="btn-custom">افزودن نظر جدید </a>
                                    @endauth
                                </div>
                            </div>
                            <div class="result_comment">
                                @include("site.layout.partials.comment",['comment'=>$comment])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


 <!-- share -->
 <div class="modal fade modal-share" id="modal-share" tabindex="-1" aria-labelledby="modal-share" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">اشتراک گذاری</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="social-share">
                    <div class="title">اشتراک گذاری در شبکه های اجتماعی</div>
                    <ul class="items">
                        @include("site.layout.partials.social_media",['title'=>$product["title"],'url'=>$product['url']])
                    </ul>
                </div>
                <form action="{{route('product.mail',['id'=>$product['id']])}}" method="post" class="form" id="send_mail_share">
                    @csrf
                    <input type="hidden" name="module" value="product">
                    <input type="hidden" name="item_id" value="{{$product['id']}}">
                    <div class="title">ارسال به ایمیل</div>
                    <input type="text" name="email" class="form-input" placeholder="ایمیل را وارد نمایید"/>
                    <button type="submit" class="btn-custom">ارسال</button>
                    <div class="page-link">
                        <div class="title">آدرس صفحه</div>
                        <div class="link">{{$product["url"]}}</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ share -->

 <!-- add comment -->
<div class="modal fade modal-comment" id="modal-comment" tabindex="-1" aria-labelledby="modal-comment" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">ارسال نظر</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('comment.store',['type'=>'product','module_id'=>$product['id']])}}" method="post" class="form form_comment">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="input-box">
                            <div class="score-box" style="display: flex;">
                                <div class="rate_stars" attr_id="{{$product->id}}" rate_kind="1" module="product" ></div>
                            </div>
                            <br>
                            <label for="form-comment-message">نظر شما</label>
                            <textarea name="note" id="form-comment-message" class="form-textarea" placeholder="دیدگاه خود را بنویسید"></textarea>
                            @error("note")
                            <span class="text text-danger">{{$errors->first('note')}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-custom-cancel" data-bs-dismiss="modal">انصراف و بازگشت</button>
                <button type="submit" class="btn-custom btn-comment">ثبت نظر</button>
            </div>
        </form>
    </div>
</div>
</div>
<!--/ add comment -->
@endsection

@section("footer")
<script type="text/javascript" src="{{asset('site/assets/js/pages/page-03.js')}}"></script>
<script>

$(document).ready(function(){
    $.fn.raty.defaults.path = "{{asset('/site/assets/image')}}";
    $('.show_rate_stars').raty({
        space:false,
        starOff: 'star-big-off.png',
        starOn: 'star-big-on.png',
        score: function() {
            return $(this).attr('data-score');
        },
        readOnly: true
    });
    @auth
    $('.rate_stars').raty({
        space:false,
        starOff: 'star-big-off.png',
        starOn: 'star-big-on.png',
        noRatedMsg: '! بدون امتیاز',
        hints: ['بد', 'ضعیف', 'عادی', 'خوب', 'عالی'],
        score: function() {
            return $(this).attr('data-score');
        },
        click: function(score, evt) {
            elm = this;
            module = $(elm).attr("module");
            $.ajaxSetup({
                headers:
                    { 'X-CSRF-TOKEN': "{{csrf_token()}}" }
            });
            $.ajax({
                type: 'POST',
                url:"{{route('user.rate.store',['type'=>'product','type_id'=>$product["id"]])}}",
                data: {
                    'rate': score,
                    'rate_kind': $(elm).attr("rate_kind")
                },
                dataType: 'json',
                success: function(res) {
                    if(res['sucess']){
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: res['sucess']
                        });
                    }else if(res['error']){
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "error",
                            title: res['error']
                        });
                    }
                }
            });
        }
    });
    @endauth
});
$(document).on("click",".add_like",function() {
    $.ajaxSetup({
        headers:
            { 'X-CSRF-TOKEN': "{{csrf_token()}}" }
    });
    @auth
    $.ajax({
        url:"{{route('user.like.store',['type'=>'product','type_id'=>$product["id"]])}}",
        type: 'POST',
        dataType: 'json',
        success: function (res) {
            if(res['sucess']){
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: res['sucess']
                });
            }else if(res['error']){
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "error",
                    title: res['error']
                });
            }
        }
    })
    @endauth
    @guest
    Swal.fire({
        title: "ابتدا لازم است وارد پنل کاربری شوید",
        icon: "error",
        showConfirmButton:false,
        timer: 2000
    });
    @endguest
})


$(document).on("click",".comment_rate_like",function() {
    var id=$(this).parent().attr('data-id');
    var kind=$(this).attr('data-kind');
    $.ajaxSetup({
        headers:
            { 'X-CSRF-TOKEN': "{{csrf_token()}}" }
    });
    @auth
    $.ajax({
        url:"{{route('user.like.store',['type'=>'comment'])}}",
        type: 'POST',
        dataType: 'json',
        data: {'module_id': id,'kind':kind},
        success: function (res) {
            if(res['sucess']){
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: res['icone_alert'],
                    title: res['sucess']
                });
                setTimeout(function(){
                    location.reload();
                },'3000');
            }else if(res['error']){
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "error",
                    title: res['error']
                });
            }
        }
    })
    @endauth
    @guest
    Swal.fire({
        title: "ابتدا لازم است وارد پنل کاربری شوید",
        icon: "error",
        showConfirmButton:false,
        timer: 2000
    });
    @endguest
})
</script>
@endsection
