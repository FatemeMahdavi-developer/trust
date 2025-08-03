@extends("site.layout.base")
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-11.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-11-01.css')}}">
@endsection
@section('content')
    <div class="page-profile">
        <!-- bread crumb -->
        <div class="container-fluid container-bread-crumb"
             @if($module_pic) style="background-image:url({{asset("upload/".$module_pic)}})" @endif >
            <div class="container-custom">
                <div class="row">
                    <div class="col">
                        <h1 class="page-title">{{$module_title}}</h1>
                        <ul class="bread-crumb">
                            @include("site.layout.partials.breadcrumb",[
                                'module_title'=>$module_title,
                            ])
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid container-profile">
            <div class="container-custom">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-12">
                        @include("site.auth.partials.user_panel")
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-8 col-12">
                        <div class="page-sign-in">
                            <div class="container-sign-in showMessage" @if($module_pic) style="background-image:url({{asset("upload/".$module_pic)}})" @endif>

                                <div class="sign-in-box" style="border: 1px solid #D9D9D9;">
                                    <div class="title-size text-right my-3 mx-4">باز کردن {{$box["title"]}}</div>
                                    <form action="{{route('user.unlocker.door')}}" method="post" class="form p-4" id="unlockerDoor">
                                        @csrf
                                        <input type="hidden" name="username" value="">
                                        <div class="d-flex justify-content-center">
                                            <div class="input-box w-50">
                                                <input type="hidden" name="title" value="{{$box["title"]}}">
                                                <input type="text" name="confirm_code" value="{{old('confirm_code')}}"
                                                       class="form-input" placeholder="کد تایید"/>
                                                @error('confirm_code')
                                                <span class="text text-danger"
                                                      style="text-align: right !important;"> {{$errors->first('confirm_code')}}</span>
                                                @enderror
                                                <div class="numberCode">
                                                    <a href="javascript:void(0);" class="time"
                                                       style="display: none"></a>
                                                </div>
                                                <div class="numberCode">
                                                    <a href="javascript:void(0);" id="show-link-recode"> ارسال مجدد </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn-custom text-left">ورود</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section("footer")
    <script>
        $(function () {
            function timer(){
                $("#show-link-recode").hide();
                var second = "{{env("EXPIRE_DATE_CONFIRM_CODE")}}";
                var time = $(".time");
                time.show();
                time.html("00:" + second + "");
                var timer = setInterval(function () {
                    second--;
                    time.html("00:" + second + "");
                    if (second == 0) {
                        time.hide();
                        $("#show-link-recode").show();
                        clearInterval(timer);
                    }
                }, 1000);
            }
            timer()
        });

        $("#unlockerDoor").on('submit',function (e){
            e.preventDefault()
            $.ajax({
                url:$(this).attr("action"),
                method:$(this).attr("method"),
                dataType:"json",
                data: {
                    '_token': $("input[name='_token']").val(),
                    'confirm_code':$("[name='confirm_code']").val(),
                    'title':$("[name='title']").val(),
                },
                success:function (result){
                    $(".alertMsg").remove()
                    if (typeof result["msg"] !== 'undefined') {
                        $(".title-size").after("<div class='alertMsg alert alert-success'>"+result["msg"]+"</div>")
                        $("#unlockerDoor").slideUp()
                    }
                    if (typeof result["error"] !== 'undefined') {
                        $("[name='confirm_code']").after("<div class='alertMsg text-danger'>کد اشتباه میباشد</div>")
                    }
                },
                error:function (msg){
                    alert(msg)
                }
            })
        })
    </script>

    <script>
        $(".numberCode").on('click',function (){
            alert("taa s")
        })
    </script>
@endsection
