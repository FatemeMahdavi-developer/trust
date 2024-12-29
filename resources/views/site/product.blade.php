@extends("site.layout.base")
@section('seo')
    @include("site.layout.partials.seo",["seo"=>$seo,"module"=>$module])
@endsection
@section('head')
   <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-02.css')}}">
@endsection
@section('content')
<div class="page-products">  
   <div class="container-fluid container-bread-crumb" @if(@$product_cat->pic_banner) style="background-image: url({{asset("upload/thumb1/".$product_cat->pic_banner)}}" @endif>
       <div class="container-custom">
           <div class="row">
               <div class="col">
                   <h1 class="page-title">@if(@$product_cat){{$product_cat->h1()}}@else @lang('modules.module_name_site.product') @endif</h1>
                   <ul class="bread-crumb">
                       @include("site.layout.partials.breadcrumb",[
                           'module_title'=>$module_title,
                           'url_page'=>'/product',
                           'breadcrumb'=>$breadcrumb,
                           'category'=>@$product_cat
                       ])
                   </ul>
               </div>
           </div>
       </div>
   </div>
   <div class="container-fluid container-products">
       <div class="container-custom">
           <div class="row">
               <div class="col-xl-3 col-lg-4 col-md-4 col-12 col-right">
                   <div class="filter-box">
                       <form id="form_product"  method="get" class="form-filter-search form-search">
                           <input type="text" name="keyword" value="{{request()->get('keyword')}}" placeholder="جستجو دسته بندی مورد نظر" />
                           <button type="submit"><i class="icon-search"></i></button>
                       </form>
                       <div class="filter-section show">
                           <div class="filter-section-title">دسته بندی</div>
                           <div class="filter-content">
                               @if(isset($product_cats))
                               <ul class="menu-category">
                                   @foreach($product_cats as $item_1)
                                       @include('site.product.partials.category',['category'=>$item_1])
                                   @endforeach
                               </ul>
                               @endif
                           </div>
                       </div>
                   </div>
               </div>
               {{-- <div class="col-xl-9 col-lg-8 col-md-8 col-12 col-left">
                  <div class="btn-filter-view-box">
                       <div class="row">
                           <div class="col-xl-6 col-lg-12 col-md-12 col-12">
                               <a href="#" class="btn-filter-view"><i class="fi fi-rr-search icon"></i> مشاهده فیلترها</a>
                           </div>
                       </div>
                   </div> --}}
                   <div class="col-xl-9 col-lg-8 col-md-8 col-12 col-left">
                   <div class="products-items">
                       <div class="row">
                           @if(isset($product[0]))
                           @foreach($product as $item)
                               <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                                   <a href="{{$item['url']}}" class="product-item">
                                       @if($item['pic'])
                                       <img src="{{asset("upload/thumb3/".$item["pic"])}}"  alt="{{$item["alt_image"]}}" />
                                       @else
                                       <img src="{{asset("site/img/no_image/no_image(234x234).jpg")}}" alt="{{$item["alt_image"]}}"/>
                                       @endif
                                       <h3 class="title">{{$item['title']}}<br /><br /></h3>
                                       <div class="price-box" style="min-height: 23px">
                                           @if($item['price'])
                                               <div class="price">{{show_price($item['price'])}}<span class="price-unit">تومان</span></div>
                                           @endif
                                       </div>
                                   </a>
                               </div>
                           @endforeach
                           @else
                               <div class="alert alert-danger">@lang('common.messages.result_not_found')</div>
                           @endif
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!-- pagination -->
   {{$product->links('site.layout.paginate.paginate')}}
   <!--/ pagination -->

 

   @if(@$product_cat->note)
   <!-- product-list-des -->
   <div class="container-fluid container-product-list-des">
       <div class="container-custom">
           <div class="row">
               <div class="col">
                   <div class="des-box">
                       <div class="des">{!! $product_cat->note !!}</div>
                       <a href="javascript:void(0);" class="btn-des-change"><span class="title">مشاهده بیشتر</span><span class="title-2">بستن</span> <i class="fi fi-rr-angle-up icon icon-up"></i><i class="fi fi-rr-angle-down icon icon-down"></i></a>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!--/ product-list-des -->
   @endif
</div>
@endsection
@section('footer')
<script type="text/javascript" src="{{asset('site/assets/js/pages/page-02.js')}}"></script>
<script>
if($(".des-box .des").height() < 130){
   $(".btn-des-change").hide();
}
</script>

<script>
   var keyword = '';
   var query_string = '';
   $("#form_product").on('submit', function (e) {
       keyword = $("[name='keyword']").val()
       e.preventDefault();
       if (keyword.length != '0') {
           query_string = "?keyword=" + keyword
       }
       window.location.href = query_string
   })
</script>

@endsection



