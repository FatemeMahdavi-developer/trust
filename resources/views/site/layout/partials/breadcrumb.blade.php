<li>
    <a href="{{asset("/")}}">صفحه اصلی</a>
</li>
<li>
    <a @if(@$breadcrumb) href="{{asset($url_page)}}" @else href="javascript:void(0);" @endif>{{$module_title}}</a>
</li>
@if(@$breadcrumb)
@foreach($breadcrumb as $item)
<li>
    <a href="{{$item->url}}">{{$item->title}}</a>
</li>
@endforeach
@endif
@if(@$category)
<li>
    <a  @if(@$title) href="{{$category->url}}" @else href="javascript:void(0);" @endif >{{$category->title}}</a>
</li>
@endif
@if(@$title)
<li>
    <a href="javascript:void(0);">{{$title}}</a>
</li>
@endif