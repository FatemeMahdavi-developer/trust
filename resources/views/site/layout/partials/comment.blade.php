@if(isset($comment[0]))
    @foreach($comment as $item)
        <div class="comment-item">
            <div class="comment-data">
                <div class="image-box"><img src="{{asset("site/assets/image/user-w.png")}}" alt="">
                </div>
                <div class="comment-inner">
                    <div class="user-date">
                        <span class="user">{{$item->user->fullname}}</span>
                        <span class="date">{{$item->date_convert()}}</span>
                    </div>
                    <div class="des">{!! $item["note"] !!}</div>
                    <div class="like" data-id="{{$item["id"]}}">
                        <span class="like-des">آیا این دیدگاه برایتان مفید بود؟</span>
                        <button type="button" class="btn-like increaseLike comment_rate_like" data-kind='like'>{{$item->count_like}} <i class="fi fi-rr-thumbs-up icon"></i></button>
                        <button type="button" class="btn-like decreaseLike comment_rate_like" data-kind='dislike'>{{$item->count_dislike}} <i class="fi fi-rr-thumbs-down icon"></i></button>
                    </div>
                </div>
            </div>
            @if(!empty($item['response_note']))
                <div class="comment-data answer">
                    <div class="user-date">
                        <span class="user">پاسخ پشتیبان</span>
                        <span class="date">{{$item->date_convert('response_created_at')}}</span>
                    </div>
                    <div class="des">{!! $item['response_note'] !!}</div>
                </div>
            @endif
        </div>
    @endforeach
    {{$comment->links('site.layout.paginate.paginate')}}
@else
<div class="alert alert-info">شما اولین فردی باشید که نظر می دهد</div>
@endif

<script>
    $(".pagination a").click(function (e) {
        e.preventDefault()
        if ($(this).attr("href") != "javascript:void(0)") {

            $.ajax({
                url: $(this).attr('href'),
                method: "get",
                success: function (res) {
                    $(".result_comment").html(res)
                    $('html, body').scrollTop($(".comment-box").offset().top);
                },
                error: function () {
                    alert("error to sending ajax data")
                }
            })
        }
    })
</script>
