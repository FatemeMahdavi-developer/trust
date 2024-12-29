@extends("site.layout.base")
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-01-02.css')}}">
@endsection
@section('content')
    <div class="page-sign-in">
        <div class="container-sign-in" @if($module_pic) style="background-image:url({{asset("upload/".$module_pic)}})" @endif>
            <div class="sign-in-box">
                <a href="{{asset("/")}}" class="logo">
                    <img src="{{asset('site/assets/image/logo.png')}}" @if($site_title) alt="{{$site_title}}" @endif />
                </a>
                @if(!request()->has('username'))
                <form action="{{route('auth.authenticateUserName')}}" method="post" class="form">
                    @csrf
                    <div class="title">{{$module_title}}</div>
                    <div class="des">اگر قبلا ثبت نام کرده اید وارد حساب کاربری خود شوید</div>
                    @if(session()->has('user_login'))
                        <div class="alert alert-success">{{session()->get('user_login')}}</div>
                    @endif
                    <div class="input-box">
                        <input type="text" name="username" value="{{old('username')}}" class="form-input" placeholder="ایمیل" />
                        @error('username')
                        <span class="text text-danger">{{$errors->first('username')}}</span>
                        @enderror
                    </div>
{{--                    <div class="input-box">--}}
{{--                        <input type="password" name="password" class="form-input" placeholder="رمز عبور" />--}}
{{--                        <i class="fi fi-rr-eye btn-show-password"></i>--}}
{{--                        @error('password') <span class="text text-danger">{{$errors->first('password')}}</span> @enderror--}}

{{--                    </div>--}}
{{--                    <div class="input-box input-check-box">--}}
{{--                        <a href="#" class="link-forgotten">فراموشی رمز</a>--}}
{{--                    </div>--}}
                    <button type="submit" class="btn-custom">ورود</button>

                    <a href="{{asset("/")}}" class="link-back"><i class="fi fi-rr-angle-right icon"></i> بازگشت به صفحه اصلی</a>
                </form>
                @else
                    <form action="{{route('auth.login')}}" method="post" class="form">
                        @csrf
                        <div class="title">{{$module_title}}</div>
                        <div class="des">اگر قبلا ثبت نام کرده اید وارد حساب کاربری خود شوید</div>
                        @if(session()->has('user_login'))
                            <div class="alert alert-success">{{session()->get('user_login')}}</div>
                        @endif
                        <input type="hidden" name="username" value="{{request()->get('username')}}" class="form-input" />
                        <div class="input-box">
                            <input type="password" name="password" class="form-input" placeholder="رمز عبور" />
                            <i class="fi fi-rr-eye btn-show-password"></i>
                            @error('password')<span class="text text-danger">{{$errors->first('password')}}</span>@enderror
                        </div>
                        <div class="input-box input-check-box  flex-row">
                            <a href="{{route('auth.forget',request()->only('username'))}}" class="link-forgotten">فراموشی رمز</a>
                            <a href="{{route('auth.otp_create',request()->only('username'))}}" class="link-forgotten">رمز یکبار مصرف</a>
                        </div>
                        <button type="submit" class="btn-custom">ورود</button>
                        <a href="{{asset("/")}}" class="link-back"><i class="fi fi-rr-angle-right icon"></i> بازگشت به صفحه اصلی</a>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

