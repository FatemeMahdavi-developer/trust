@extends("site.layout.base")
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-11.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-11-01.css')}}">
@endsection
@section('content')
    <div class="page-profile">
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
        <div class="container-fluid container-profile">
            <div class="container-custom">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-12">
                        @include("site.auth.partials.user_panel")
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-8 col-12">
                        <div class="section-content-box">
                            <div class="section-title">
                                <span class="title">لیست سفارشات</span>
                            </div>
                            <div class="content-box content-box">
                                <div class="row">
                                    <div class="ordersTable">
                                        <table style="width: 100%;">
                                            <thead>
                                                <tr class="invoice-tr">
                                                    <th>ردیف</th>
                                                    <th>کمد </th>
                                                    <th>سایز</th>
                                                    <th>مبلغ کل</th>
                                                    <th>نوع خرید</th>
                                                    <th>عملیات پرداخت</th>
                                                    <th>کد پیگیری</th>
                                                    <th>تاریخ</th>
                                                    <th>جزئیات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($orders[0]))
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$order->basket->box->title}}</td>
                                                        <td>{{$order->size->title}}</td>
                                                        <td>{{number_format($order->price)}} تومان</td>
                                                        <td>{{$kind_payment[$order->state->value]}}</td>
                                                        <td>{{$state_payment[$order->payment->state->value]}}</td>
                                                        <td>{{$order->ref_number}}</td>
                                                        <td style="direction:ltr;">{{$order->date_convert()}}</td>
                                                        <td><a href="" class="order_view_tbl">مشاهده</a></td>
                                                    </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
