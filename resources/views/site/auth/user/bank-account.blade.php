@extends("site.layout.base")
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-11.css')}}">
@endsection
@section('content')
    <div class="page-profile">
        <div class="container-fluid container-bread-crumb" @if($module_pic) style="background-image:url({{asset("upload/".$module_pic)}})" @endif>
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
                                <span class="title">{{$module_title}}</span>
                            </div>
                            <div class="content-box" >
                                <div class="alert alert-warning">شماره حساب تنها در صورتی پذیرفته می‌شود که به نام صاحب درخواست باشد</div>
                                @if($myBankAccount)
                                    <div class="row justify-content-center mb-5">
                                        <div class="card-container">
                                            <div class="bank-card" id="bankCard">
                                                <div class="card-background"></div>
                                                <div class="card-wave"></div>
                                                <div class="card-header">
                                                    <div class="bank-logo">
                                                        <div class="bank-name" > بانک {{$myBankAccount->bank_name}}</div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="card-chip"></div>
                                                    </div>
                                                </div>
                                                <div class="card-number">
                                                    <div class="sheba-number-display" >
                                                    شماره شبا:IR{{$myBankAccount->sheba_number}}
                                                    </div>
                                                    <div class="card-number-display" id="cardNumber">
                                                        {{$myBankAccount->card_number}}
                                                    </div>
                                                    <div class="card-holder-name" id="cardHolderName">
                                                        {{$myBankAccount->name}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if(session()->has('success'))
                                        <div class="alert alert-success">{{session()->get('success')}}</div>
                                    @endif
                                @else
                                    <form action="{{route("user.store-bank-account")}}" method="post" class="form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-12">
                                                <div class="row justify-content-center mb-5">
                                                    <div class="card-container">
                                                        <div class="bank-card" id="bankCard">
                                                            <div class="card-background"></div>
                                                            <div class="card-wave"></div>
                                                            <div class="card-header">
                                                                <div class="bank-logo">
                                                                    <i class="fas fa-university"></i>
                                                                    <div class="bank-name" > بانک <span id="cardHolderBankName"></span></div>
                                                                </div>
                                                                <div class="d-flex align-items-center mb-2">
                                                                    <div class="card-chip"></div>
                                                                </div>
                                                            </div>
                                                            <div class="contactless-icon">
                                                                <i class="fas fa-wifi" style="transform: rotate(90deg);"></i>
                                                            </div>
                                                            <div class="card-number">
                                                                <div class="sheba-number-display" >
                                                                شماره شبا:IR<span id="shebaNumber">1111 2222 3333 4444 5555 6666</span>
                                                                </div>
                                                                <div class="card-number-display" id="cardNumber">
                                                                    1234 5678 9101 1213
                                                                </div>
                                                                <div class="card-holder-name" id="cardHolderName">
                                                                    نام صاحب کارت
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="input-box">
                                                            <input placeholder="نام و نام خانوادگی صاحب کارت (اجباری)" type="text" name="name" id="holderName" value="{{old("name")}}" class="form-input">
                                                            @error("name")<span class="text text-danger">{{$errors->first('name')}}</span>@enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="input-box">
                                                            <input placeholder="نام بانک (اجباری)" type="text" name="bank_name" id="holderBankName" value="{{old("bank_name")}}" class="form-input">
                                                            @error("bank_name")<span class="text text-danger">{{$errors->first('bank_name')}}</span>@enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="input-box">
                                                            <input placeholder="شماره کارت (اجباری)" type="text" class="form-input" name="card_number" id="cardNum" value="{{old("card_number")}}" maxlength="16">
                                                            @error("card_number")<span class="text text-danger">{{$errors->first('card_number')}}</span>@enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="input-box">
                                                            <input placeholder="شماره شبا (اجباری)" type="text" class="form-input" name="sheba_number" id="shebaNum" value="{{old("sheba_number")}}" maxlength="24">
                                                            @error("sheba_number")<span class="text text-danger">{{$errors->first('sheba_number')}}</span>@enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-12 text-left">
                                                <button type="submit" name="form-profile-submit" class="btn-custom">ارسال</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@if(!$myBankAccount)
@section('footer')
<script>
    function formatCardNumber(value) {
        const v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
        // const matches = v.match(/\d{4,16}/g);
        // const match = matches && matches[0] || '';
        // const parts = [];
        // for (let i = 0, len = match.length; i < len; i += 4) {
        //     parts.push(match.substring(i, i + 4));
        // }
        // if (parts.length) {
        //     return parts.join(' ');
        // } else {
            return v;
        // }
    }

    document.getElementById('holderName').addEventListener('input', function() {
        const name = this.value || 'نام صاحب کارت';
        document.getElementById('cardHolderName').textContent = name;
    });

    function convertToPersianNumbers(str) {
        const persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        return str.replace(/\d/g, (match) => persianNumbers[parseInt(match)]);
    }

    document.getElementById('cardNum').addEventListener('input', function(e) {
        const formatted = formatCardNumber(e.target.value);
        e.target.value = formatted;
        document.getElementById('cardNumber').textContent = convertToPersianNumbers(formatted || '1234 5678 9101 1213');
    });

    document.getElementById('shebaNum').addEventListener('input', function(e) {
        const formatted = formatCardNumber(e.target.value);
        e.target.value = formatted;
        document.getElementById('shebaNumber').textContent =convertToPersianNumbers(formatted || '1111 2222 3333 4444 5555 6666');
    });

    document.getElementById('holderName').addEventListener('input', function() {
        const name = this.value || 'نام صاحب کارت';
        document.getElementById('cardHolderName').textContent = name;
    });

    document.getElementById('holderBankName').addEventListener('input', function() {
        const nameBank = this.value;
        document.getElementById('cardHolderBankName').textContent = nameBank;
    });

    document.addEventListener('DOMContentLoaded', function () {
        const holderName = document.getElementById('holderName').value || 'نام صاحب کارت';
        document.getElementById('cardHolderName').textContent = holderName;

        const holderBankName = document.getElementById('holderBankName').value;
        document.getElementById('cardHolderBankName').textContent = holderBankName;

        const cardNumInput = document.getElementById('cardNum').value;
        if (cardNumInput) {
            const formattedCard = formatCardNumber(cardNumInput);
            document.getElementById('cardNum').value = formattedCard;
            document.getElementById('cardNumber').textContent =convertToPersianNumbers(formattedCard);
        }

        const shebaNumInput = document.getElementById('shebaNum').value;
        if (shebaNumInput) {
            const formattedSheba = formatCardNumber(shebaNumInput);
            document.getElementById('shebaNum').value = formattedSheba;
            document.getElementById('shebaNumber').textContent =convertToPersianNumbers(formattedSheba);
        }
    });



</script>
@endsection
@endif
