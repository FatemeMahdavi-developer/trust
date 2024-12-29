<li>
    <a @if($category->sub_cats_site->count()) class="nav-dropdown-toggle open" @endif href="{{$category['url']}}">{{$category['title']}}</a>
    @if($category->sub_cats_site->count())
    <ul class="open">
        @foreach($category->sub_cats_site as $sub_cat)
            @include('site.product.partials.category',['category'=>$sub_cat])
        @endforeach
    </ul>
    @endif
</li>