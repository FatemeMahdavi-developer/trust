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
            {{-- <div class="col-12">
                <div class="contact-data">
                    <div class="row">
                        @if($tell)
                            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="contact-data-box">
                                    <img src="{{asset("site/assets/image/icon-phone.png")}}">
                                    <div class="des">
                                        <a href="tel:{{$tell}}" style="color: #fff">{{$tell}}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($address)
                            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="contact-data-box">
                                    <img src="{{asset("site/assets/image/icon-marker.png")}}">
                                    <div class="des">{{$address}}</div>
                                </div>
                            </div>
                        @endif
                        @if($email)
                            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="contact-data-box last">
                                    <img src="{{asset("site/assets/image/icon-envelope.png")}}">
                                    <div class="des">
                                        <a href="mailto:{{$email}}" style="color: #fff"> {{$email}}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div> --}}
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 show_here">
                <form action="{{route("reservation.store")}}" method="post" class="form">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="title">فرم تماس با ما</div>
                            <div class="des">کاربران گرامی، شما می توانید از طریق فرم زیر تمامی نقطه نظرات انتقادات و پیشنهادات خود را برای ما ارسال کنید</div>
                        </div>
                    </div>
                    @if(session()->has('success'))
                        <div class="alert alert-success">{{session()->get('success')}}</div>
                    @endif
                    <div class="row">
                        {{-- @auth
                            @component('site.components.input',['name'=>'user_id','value'=>Auth::user()->id])@endcomponent
                        @endauth --}}
                        @guest
                            @component('site.components.input',['name'=>'name','placeholder'=>'نام و نام خانوادگی','value'=>old('name')])@endcomponent
                            @component('site.components.input',['name'=>'mobile','placeholder'=>'شماره تماس','value'=>old('mobile')])@endcomponent
                        @endguest
                    </div>
                    <div class="row">
                        @component("site.components.select_recursive",['name'=>'size_id','placeholder'=>'سایز','options'=>$sizes,'value'=>old('size_id'),'choose'=>true])@endcomponent
                        @component("site.components.select",['name'=>'box_id','placeholder'=>'باکس','items'=>[]])@endcomponent
                    </div>
                    <div class="row">
                        @component("site.components.textarea",['name'=>'note','placeholder'=>'متن پیام','value'=>old('note')])@endcomponent
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-btn">
                            <button type="submit" class="btn-custom">ارسال پیام</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('footer')
<script>
    $(document).ready(function () {
        $("[name='size_id']").on('change', function () {
            if ($(this).val().length > 0) {
                $.ajax({
                    url: "{{route("select_box")}}",
                    method: "post",
                    dataType: "json",
                    data: {
                        '_token': $("input[name='_token']").val(),
                        'size_id': $(this).val()
                    },
                    success: function (result) {
                        if (result.length > 0) {
                            var html='<option value="">انتخاب کنید</option>';
                            $(result).each(function (index, element) {
                                var selected='';
                                if(element['id'] == "{{old("box_id")}}"){
                                    selected='selected'
                                }
                                html+="<option value=" + element['id'] + " "+selected   +">" + element['title'] + "</option>"
                            })
                            $("[name='box_id']").html(html)
                        } else {
                            $("[name='box_id']").append("<option value=''>نتیجه ای یافت نشد</option>")
                        }
                    },
                    error: function () {
                        toaste("error", "خطا در برقراری ارتباط")
                    }
                })
            }
        }).trigger("change");
    })
</script>
@if(Session::get('success') || $errors->count())
    <script>
         $('html, body').animate({
            scrollTop: $(".show_here").offset().top
         },100);
    </script>
@endif
@endsection
