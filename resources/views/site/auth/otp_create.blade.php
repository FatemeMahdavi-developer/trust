@extends("site.layout.base")
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-01-02.css')}}">
@endsection
@section('content')
    <div class="page-sign-in">
        <div class="container-sign-in" @if($module_pic) style="background-image:url({{asset("upload/".$module_pic)}})" @endif>
            <div class="sign-in-box">
                <a href="{{asset("/")}}" class="logo">
                    <img src="{{asset('site/assets/image/logo.png')}}" @if($site_title) alt="{{$site_title}}" @endif/>
                </a>
                <form action="{{route('auth.otp_check_confirm')}}" method="post" class="form">
                    @csrf
                    <input type="hidden" name="username" value="{{$username}}">
                    <div class="title">{{$module_title}}</div>
                    <div class="input-box">
                        <input type="text" name="confirm_code" value="{{old('confirm_code')}}" class="form-input" placeholder="کد تایید"/>
                        @error('confirm_code') 
                            <span class="text text-danger" style="text-align: right !important;"> {{$errors->first('confirm_code')}}</span> 
                        @enderror
                        <div class="numberCode">
                            <a href="javascript:void(0);" class="time" style="display: none"></a>
                        </div>
                        <div class="numberCode">
                            <a href="javascript:void(0);" id="show-link-recode"> ارسال مجدد </a>
                        </div>
                    </div>
                    <button type="submit" class="btn-custom">ورود</button>
                    <a href="{{asset("/")}}" class="link-back"><i class="fi fi-rr-angle-right icon"></i> بازگشت به صفحه اصلی</a>
                </form>
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

            @if(!$errors->has('confirm_code'))
            timer()
            @enderror
            $("#show-link-recode").click(function () {
                timer()
                $.ajax({
                    type: 'post',
                    url: "{{route('auth.otp_resend',$username)}}",
                    dataType: 'json',
                    data: $(".form").serialize(),
                    success: function(res) {
                        console.log(res)
                        // time.hide();
                        // $("#show-link-recode").show();
                    }
                });
            });
        });
    </script>
@endsection
