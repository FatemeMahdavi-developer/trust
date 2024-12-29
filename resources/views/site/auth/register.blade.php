@extends("site.layout.base")
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-01-03.css')}}">
@endsection
@section('content')
    <div class="page-sign-up">
        <div class="container-sign-up" @if($module_pic) style="background-image:url({{asset("upload/".$module_pic)}})" @endif>
            <div class="sign-up-box">
                <a href="{{asset("/")}}" class="logo">
                    <img src="{{asset('site/assets/image/logo.png')}}" @if($site_title) alt="{{$site_title}}" @endif/>
                </a>
                <form action="{{route('auth.register')}}" method="post" class="form">
                    @csrf
                    <div class="title">{{$module_title}}</div>
                    <div class="des">اگر قبلا ثبت نام نکرده اید اینجا ثبت نام کنید</div>
                    @if(session()->has('wrong_username'))
                        <div class="alert alert-danger">{{session()->get('wrong_username')}}</div>
                    @endif
                    <div class="input-box">
                        <input type="text" name="name" value="{{old('name')}}" class="form-input" placeholder="نام"/>
                        @error('name') <span class="text text-danger">{{$errors->first('name')}}</span> @enderror
                    </div>
                    <div class="input-box">
                        <input type="text" name="lastname" value="{{old('lastname')}}" class="form-input" placeholder="نام خانوادگی"/>
                        @error('lastname') <span class="text text-danger">{{$errors->first('lastname')}}</span> @enderror
                    </div>
                    <div class="input-box">
                        <input type="text" name="username" value="{{old('username')}}" class="form-input" placeholder="ایمیل"/>
                        @error('username') <span class="text text-danger">{{$errors->first('username')}}</span> @enderror
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" class="form-input" placeholder="رمز عبور"/>
                        <i class="fi fi-rr-eye btn-show-password"></i>
                        @error('password') <span class="text text-danger">{{$errors->first('password')}}</span> @enderror
                    </div>
                    <div class="input-box input-check-box">
                        {{-- <label class="label-input-checkbox-by-style"><input type="checkbox" name="form-sign-in-newsletter"/>دریافت خبرنامه</label>--}}
                        <label class="label-input-checkbox-by-style"><input type="checkbox" name="rule" value="1"/><a href="#" target="_blank">قوانین و مقررات</a> سایت را می پذیرم</label>
                        @error('rule') <span class="text text-danger">{{$errors->first('rule')}}</span> @enderror
                    </div>
                    <button type="submit" name="form-sign-up-send" class="btn-custom">ثبت نام</button>
                    <a href="{{asset("/")}}" class="link-back"><i class="fi fi-rr-angle-right icon"></i> بازگشت به صفحه اصلی</a>
                </form>
            </div>
        </div>
    </div>
@endsection

