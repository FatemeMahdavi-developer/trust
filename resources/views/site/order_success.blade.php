@extends("site.layout.base")

@section("head")
<link rel="stylesheet" href="{{asset("site/assets/css/pages/page-04.css")}}" >
@endsection

@section("content")
<div class="page-contact">
<div class="container-fluid container-bread-crumb" @if($module_pic) style="background-image:url({{asset("upload/".$module_pic)}})" @endif >
    <div class="container-custom">
        <div class="row">
            <div class="col">
                <h1 class="page-title">{{$module_title}}</h1>
                <ul class="bread-crumb">
                    @include('site.layout.partials.breadcrumb')
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid container-contact">
    <div class="container-custom">
        <div class="row">
        @if(session()->has('success'))
            <div style="text-align:justify;line-height: 30px;font-size: 14px;margin-top: 20px;margin-bottom:20px;background: #D5FFC6 !important;
            color: #48A41C !important; padding:10px;">
                <div class="success" style="text-align: center;">
                    <h3>{{session()->get('success')}}</h3>
                    <ul class="list-unstyled" style="margin-top: 10px;">
                        <li>کد پیگیری : <span>{{session()->get('ref_number')}}</span></li>
                    </ul>
                </div>
            </div>
        @endif
        </div>
    </div>
</div>
</div>
@endsection

