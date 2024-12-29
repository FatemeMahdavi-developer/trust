<title>{{$seo["seo_title"] ?? app('setting')[$module."_title"]}}</title>
<meta name="robots" content="{{$seo["seo_index_kind"]}}">

@if($seo["seo_keyword"])
<meta name="keywords" content="{{$seo["seo_keyword"]}}">
@endif
@if($seo["seo_description"])
<meta name="description" content="{{$seo["seo_description"]}}">
@endif
<link rel="canonical" href="{{urldecode($seo["seo_canonical"])}}" />
