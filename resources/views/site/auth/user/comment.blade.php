@extends("site.layout.base")
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-11.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-11-01.css')}}">
@endsection

@section('content')
    <div class="page-profile">
        <!-- bread crumb -->
        <div class="container-fluid container-bread-crumb">
            <div class="container-custom">
                <div class="row">
                    <div class="col">
                        <h1 class="page-title">حساب کاربری</h1>

                        <ul class="bread-crumb">
                            <li><a href="#">صفحه اصلی</a></li>
                            <li><a href="#">کامنت</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--/ bread crumb -->

        <!-- --------------------------------------------------------------------------------------------------------------- -->

        <div class="container-fluid container-profile">
            <div class="container-custom">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-12">
                        @include("site.auth.partials.user_panel")
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-8 col-12 comment-box">
                        <div class="result_comment">
                            @include("site.layout.partials.comment",['comment'=>$comment])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
