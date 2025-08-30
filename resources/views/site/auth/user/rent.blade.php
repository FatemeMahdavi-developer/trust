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
                        <li><a href="#">لیست اجاره ها</a></li>
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
                            <span class="title">لیست اجاره لاکرهای من</span>
                        </div>
                        <div class="content-box content-box">
                            @if(isset($orders))
                            <div class="row">
                                <div class="ordersTable">
                                    @if(session()->has('success'))
                                    <div class="alert alert-success">{{session()->get('success')}}</div>
                                @endif
                                <table style="width: 100%;">
                                    <thead>
                                        <tr class="invoice-tr">
                                            <th>ردیف</th>
                                            <th>نام شعبه </th>
                                            <th>سایز</th>
                                            <th> شماره کمد</th>
                                            <th>مبلغ (تومان)</th>
                                            <th>تاریخ ثبت</th>
                                            <th>وضعیت تسویه</th>
                                            <th>تاریخ تسویه</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$order->box->lockerBank->branch->name}}</td>
                                                <td>{{$size[$order->box->lockerBank->size->value]}}</td>
                                                <td>{{$order->box->title}}</td>
                                                <td>{{$order->box->lockerBank->price}}</td>
                                                <td>{{$order->date_convert('created_at','h:i:s Y/m/d')}}</td>
                                                <td>{{$settlementStatus[$order->settlement_status->value]}}</td>
                                                <td>{{$order->settlement_status=="settled" ? $order->date_convert('settled_at') : ''}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                                </div>
                            @else
                                <div class="alert alert-danger alert-not-found">تاکنون سفارشی ثبت نشده</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
