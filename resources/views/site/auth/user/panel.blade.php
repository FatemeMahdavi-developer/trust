@extends("site.layout.base")
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-11.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-11-01.css')}}">
@endsection
@section('content')
    <div class="page-profile">
        <!-- bread crumb -->
        <div class="container-fluid container-bread-crumb" @if($module_pic) style="background-image:url({{asset("upload/".$module_pic)}})" @endif >
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
                        <div class="section-content-box">
                            <div class="section-title">
                                <span class="title">مشخصات</span>
                                <a href="{{route('user.change_profile')}}" class="btn-custom"><i class="fi fi-rr-edit icon"></i> ویرایش</a>
                            </div>
                            <div class="content-box content-box">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="title">نام و نام خانوادگی</div>
                                        <div class="value">{{auth()->user()->fullname}}</div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="title">شماره تلفن همراه</div>
                                        <div class="value">{{auth()->user()->mobile ?? "--"}}</div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="title">محل سکونت</div>
                                        <div class="value">{{auth()->user()->address ?? "--"}}</div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="title">تاریخ تولد</div>
                                        <div class="value">{{auth()->user()->date_birth_convert}}</div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="title">ایمیل</div>
                                        <div class="value">{{auth()->user()->email ?? "--"}}</div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="title">شماره ثابت</div>
                                        <div class="value">{{auth()->user()->tell ?? "--"}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <a href="#" class="link-box">
                                    <i class="fi fi-rr-comment icon"></i>
                                    <div class="title">نظرات داده شده</div>
                                    <div class="count">{{auth()->user()->comment()->count('id')}} نظر</div>
                                </a>
                            </div>

                            <div class="col-sm-6 col-12">
                                <a href="#" class="link-box">
                                    <i class="fi fi-rr-heart icon"></i>
                                    <div class="title">علاقمندی ها</div>
                                    <div class="count">۷ علاقمندی</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

