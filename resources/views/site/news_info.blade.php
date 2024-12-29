@extends('site.layout.base')
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-07-02.css')}}">
@endsection
@section('content')
    <div class="page-blog-post">
        <!-- bread crumb -->
        <div class="container-fluid container-bread-crumb"
             @if(@$news['pic_banner']) style="background-image: url({{asset("upload/thumb1/".$news["pic_banner"])}}" @endif>
            <div class="container-custom">
                <div class="row">
                    <div class="col">
                        <h1 class="page-title">{{$news->h1()}}</h1>

                        <ul class="bread-crumb">
                            <li><a href="#">صفحه اصلی</a></li>
                            <li><a href="#">اخبار</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--/ bread crumb -->

        <!-- --------------------------------------------------------------------------------------------------------------- -->

        <div class="container-fluid container-blog-post">
            <div class="container-custom">
                <div class="row">
                    <div class="col-12">
                        <div class="post-header">
                            <div class="post-data-box">
                                <div>
                                    <div class="category-date-box">
                                        <span class="date">{{$news->date_convert('validity_date')}}</span>
                                        <a href="{{$news->news_cat->url}}"
                                           class="category-link">{{$news->news_cat->title}}</a>
                                    </div>

                                    <a href="#" class="link-title"><h1 class="title">{{$news['short_note']}}</h1></a>
                                </div>

                                <div>
                                    <div class="print-share-box">
                                        <a href="{{route('news.print',['news'=>$news['seo_url']])}}" class="item"><i
                                                class="icon-print"></i> چاپ صفحه</a>
                                        <a href="#" class="item" data-bs-toggle="modal" data-bs-target="#modal-share"><i
                                                class="icon-share"></i> اشتراک گذاری</a>
                                    </div>

                                    <div class="next-prv-post-box">
                                        @if($news->nextNews())
                                            <div class="post-item">
                                                <a href="{{$news->nextNews()->url}}" class="icon-box"><i
                                                        class="fi fi-rr-angle-right icon"></i> خبر
                                                    بعدی</a>
                                            </div>
                                        @endif
                                        <div class="divider">&nbsp;</div>
                                        @if($news->prevNews())
                                            <div class="post-item">
                                                <a href="{{$news->prevNews()->url}}" class="icon-box prv"> خبر قبلی<i
                                                        class="fi fi-rr-angle-left icon"></i></a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <a href="javascript:void(0)" class="image-box">
                                @if($news['pic'])
                                    <img src="{{asset("upload/thumb1/".$news["pic"])}}"
                                         alt="{{$news["alt_image"]}}"/>
                                @else
                                    <img src="{{asset("site/img/no_image/no_image(568x546).jpg")}}"
                                         alt="{{$news["alt_image"]}}"/>
                                @endif
                            </a>
                        </div>
                        <div class="des-box">
                            {!! $news["note_more"] !!}
                        </div>
                        @if(is_array($news->keyword()))
                            <div class="tag-box">
                                <div class="title">کلمه کلیدی</div>
                                <ul>
                                    @foreach($news->keyword() as $value)
                                        <li><a href="{{route('news.index',['keyword'=>$value])}}">{{$value}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="comment-box">
                            <div class="section-title">
                                <span class="title">نظرات کاربران</span>

                                <div class="btn-new-comment-des-box">
                                    <span class="des">شما هم می توانید درمورد این مطلب نظر بدهید</span>
                                    @auth
                                        <button type="button" class="btn-custom" data-bs-toggle="modal"
                                                data-bs-target="#modal-comment">افزودن نظر جدید
                                        </button>
                                    @else
                                        <a href="{{route('auth.login')}}" class="btn-custom">افزودن نظر جدید
                                        </a>
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
                            @include("site.layout.partials.social_media",['title'=>$news["title"],'url'=>$news['url']])
                        </ul>
                    </div>
                    <form action="{{route('news.mail',['id'=>$news['id']])}}" method="post" class="form"
                          id="send_mail_share">
                        @csrf
                        <input type="hidden" name="module" value="news">
                        <input type="hidden" name="item_id" value="{{$news['id']}}">
                        <div class="title">ارسال به ایمیل</div>
                        <input type="text" name="email" class="form-input" placeholder="ایمیل را وارد نمایید"/>
                        <button type="submit" class="btn-custom">ارسال</button>
                        <div class="page-link">
                            <div class="title">آدرس صفحه</div>
                            <div class="link">{{$news["url"]}}</div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!--/ share -->

    <!-- add comment -->
    <div class="modal fade modal-comment" id="modal-comment" tabindex="-1" aria-labelledby="modal-comment"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">ارسال نظر</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{route('comment.store',['type'=>'news','module_id'=>$news['id']])}}" method="post"
                      class="form form_comment">
                    <div class="modal-body">
                        <div class="big_stars" style="display: flex; cursor: pointer;">

                        </div>
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="input-box">
                                    <label for="form-comment-message">نظر شما</label>
                                    <textarea name="note" id="form-comment-message"
                                              class="form-textarea" placeholder="دیدگاه خود را بنویسید"></textarea>
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
    {{--    <a href="{{route('comment.create',['type'=>'news','module_id'=>'1'])}}">mamad kojaeai</a>--}}
@endsection

@section("footer")
    @error("note")
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(document.getElementById("modal-comment"),{});
        document.onreadystatechange = function () {
            myModal.show();
        };
    </script>
    @enderror
    <script>
        $(function() {
            $.fn.raty.defaults.path = '{{asset("site/assets/image/")}}';
            $('.big_stars').raty({
                space:false,
                starOff: 'star-big-off.png',
                starOn: 'star-big-on.png',
                noRatedMsg: '! بدون امتیاز',
                hints: ['بد', 'ضعیف', 'عادی', 'خوب', 'عالی'],
                score: function() {
                    return $(this).attr('data-score');
                },
                click: function(score, evt) {
                    $.ajaxSetup({
                        headers:
                            { 'X-CSRF-TOKEN': $('[name="_token"]').val() }
                    });
                    $.ajax({
                        url:"{{route('rate',['module'=>'news','item_id'=>$news["id"]])}}",
                        method:"post",
                        dataType:"json",
                        data:{"rate":score},
                        success:function (response) {
                            console.log(response)
                        },
                        // error:function () {
                        //
                        // }
                    });
                }
            });
        });
    </script>


<script>
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

