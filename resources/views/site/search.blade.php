<div class="col-right">
    <div class="section-title">محصولات</div>
    @if(isset($product[0]))
    <div class="search-product-result-box">
        <div class="search-product-items">
            @foreach($product as $item)
            <a href="{{$item->url}}" class="item">
                <div class="image-box">
                    @if($item->pic)
                    <img src="{{asset('upload/thumb1/'.$item->pic)}}" alt="{{$item->alt_image}}"/>
                    @else
                    <img src="{{asset('site/img/no_image/no_image(50x50).jpg')}}" alt="{{$item->alt_image}}"/>
                    @endif
                </div>
                <div class="title-price-box">
                    <h4 class="title">{{$item->title}}</h4>
                    @if($item->price)
                    <div class="price">{{show_price($item->price)}}<span class="price-unit">تومان</span></div>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </div>
    <a href="{{route('product.index',['keyword'=>request()->keyword])}}" class="btn-continue">ادامه <i class="fi fi-rr-arrow-left icon"></i></a>
    @else
        <div class="alert alert-danger">نیجه ای یافت نشد</div>
    @endif
</div>
<div class="col-left">
    <div class="section-title">دسته بندی</div>
    @if(isset($product_cat[0]))
    <ul class="site-search-category-box">
        @foreach($product_cat as $item)
        <li><a href="{{$item->url}}">{{$item->title}}</a></li>
        @endforeach
    </ul>
    @else
        <div class="alert alert-danger">نیجه ای یافت نشد</div>
    @endif
    <div class="section-title">اخبار و مقالات</div>
    @if(isset($news[0]))
    <div class="search-blog-items">
        @foreach($news as $item)
        <a href="{{$item->url}}" class="item">
            <div class="image-box">
                @if($item->pic)
                <img src="{{asset('upload/thumb4/'.$item->pic)}}" alt="{{$item->alt_image}}"/>
                @else
                <img src="{{asset('site/img/no_image/no_image(78x78).jpg')}}" alt="{{$item->alt_image}}"/>
                @endif
            </div>
            <h4 class="title">{{$item->title}}</h4>
        </a>
        @endforeach
    </div>
    <a href="{{route('news.index',['keyword'=>request()->keyword])}}" class="btn-continue">ادامه <i class="fi fi-rr-arrow-left icon"></i></a>
    @else
        <div class="alert alert-danger">نیجه ای یافت نشد</div>
    @endif
</div>
