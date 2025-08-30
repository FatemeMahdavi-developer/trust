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
                        <li><a href="#">لیست قیمت ها</a></li>
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
                            <span class="title">لیست قیمت لاکر بانک ها</span>
                        </div>
                        <div class="content-box content-box">
                            @if(isset($lockerBanks))
                            <div class="row">
                                <div class="ordersTable">
                                    @if(session()->has('success'))
                                    <div class="alert alert-success">{{session()->get('success')}}</div>
                                @endif
                                <table style="width: 100%;">
                                    <form action="{{route("user.updatePriceOfLockerBank")}}" method="post" class="form">
                                        @csrf
                                        <thead>
                                            <tr class="invoice-tr">
                                                <th>ردیف</th>
                                                <th>نام شعبه </th>
                                                <th>سایز</th>
                                                <th>نوع اجاره</th>
                                                <th>مبلغ (تومان)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lockerBanks as $lockerBank)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$lockerBank->branch->name ?? ''}}</td>
                                                    <td>{{$size[$lockerBank->size->value]}}</td>
                                                    <td>
                                                        @component("site.components.select",['name'=>"pricing_type[".$lockerBank->id."]",'items'=>$pricingType,'class'=>'-','value_old'=>old('pricing_type')[$lockerBank->id] ?? ($lockerBank->pricing_type?->value ?? '') ])@endcomponent
                                                    </td>
                                                    <td>
                                                        @component('site.components.input',['name'=>"price[".$lockerBank->id."]",'value'=>old('price')[$lockerBank->id] ?? $lockerBank->price,'col_class'=>'-','class'=>'w-100'])@endcomponent
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="5">
                                                    <div class="col-md-12 col-sm-12 col-btn text-left mt-2">
                                                        <button type="submit" class="btn-custom">ارسال</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </form>
                                </table>
                                </div>
                                </div>
                            @else
                                <div class="alert alert-danger alert-not-found">تاکنون سفارشی ثبت نکرده اید</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
