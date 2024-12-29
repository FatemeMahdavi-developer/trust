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
                <form action="{{route('auth.store')}}" method="post" class="form">
                    @csrf
                    <div class="title my-3">{{$module_title}}</div>
                    <div class="des">برای ارسال کد تایید نام کاربری خود را وارد کنید</div>
                    <div class="input-box">
                        <input type="text" name="username" value="{{$username}}" class="form-input" placeholder="نام کاربری"/>
                        @error('username') <span class="text text-danger">{{$errors->first('username')}}</span> @enderror
                    </div>
                    <div class="input-box">
                        <input type="text" name="confirm_code" class="form-input" placeholder="کد تایید"/>
                        @error('confirm_code') <span class="text text-danger">{{$errors->first('confirm_code')}}</span> @enderror
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" class="form-input" placeholder="رمز عبور جدید"/>
                        @error('password') <span class="text text-danger">{{$errors->first('password')}}</span> @enderror
                    </div>
                    <div class="input-box">
                        <input type="password" name="password_confirmation" class="form-input" placeholder="تکرار رمز عبور"/>
                    </div>
                    <button type="submit" class="btn-custom">بازیابی رمز عبور</button>
                    <a href="{{asset("/")}}" class="link-back"><i class="fi fi-rr-angle-right icon"></i> بازگشت به صفحه اصلی</a>
                </form>
            </div>
        </div>
    </div>
@endsection
