@extends("site.layout.base")
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-05.css')}}">
    <style>
        .container-menu{
            display: none;
        }
        .success-card {
            margin-top: 20px;
            background: #e4f1df;
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out;
        }

        .failed-card {
            margin-top: 20px;
            background: #f1dfdf;
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out;
        }

        .success-icon {
            width: 30px;
            height: 30px;
        }
        .order-code {
            padding: 15px;
            border-radius: 10px;
            letter-spacing: 2px;
        }
    </style>
@endsection
@section('content')
    <div class="page-about">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-10">
                    @if ($status=='success')
                        <div class="card success-card mb-4">
                            <div class="card-body p-5 text-center">
                                <h2 class=" fw-bold mb-3" style="color: #48A41C !important">
                                    <img src="{{asset("site/assets/image/success.png")}}" class="success-icon">
                                    پرداخت موفقیت‌آمیز
                                </h2>
                                <p class="text-muted mb-4 fs-5">
                                    رزرو شما با موفقیت ثبت و پرداخت شد
                                </p>
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="mb-0">
                                            <i class="fas fa-shopping-cart me-2"></i>
                                            کد سفارش
                                        </h5>
                                        <div class="order-code">
                                            {{$ref_number}}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="mb-0">
                                            کد رهگیری
                                        </h5>
                                        <div class="order-code">
                                            {{$ref_id}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-btn">
                                    <i class="fi fi-rr-angle-right icon"></i> بازگشت به صفحه اصلی
                                </div>
                            </div>
                        </div>
                    @elseif($status=='failed')
                        <div class="card failed-card mb-4">
                            <div class="card-body p-5 text-center">
                                <h2 class=" fw-bold mb-3" style="color: #a41c1c !important">
                                    <img src="{{asset("site/assets/image/error.png")}}" class="success-icon">
                                    پرداخت ناموفق
                                </h2>
                                <p class="text-muted mb-4 fs-5">
                                    رزرو با شکست مواجه شد
                                </p>
                                <div class="col-md-12 col-sm-12 col-btn">
                                <a href="{{asset("/")}}">
                                    <i class="fi fi-rr-angle-right icon"></i> بازگشت به صفحه اصلی
                                </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
