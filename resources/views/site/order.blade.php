@extends("site.layout.base")

@section("head")
<link rel="stylesheet" href="{{asset("site/assets/css/pages/page-04.css")}}" >
@endsection

@section("content")
<div class="page-contact">
<div class="container-fluid container-bread-crumb" @if($module_pic) style="background-image:url({{asset("upload/".$module_pic)}})" @endif >
    <div class="container-custom">
        <div class="row">
            <div class="col">
                <h1 class="page-title">{{$module_title}}</h1>
                <ul class="bread-crumb">
                    @include('site.layout.partials.breadcrumb')
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid container-contact">
    <div class="container-custom">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                <form action="{{route("order.store")}}" method="post" class="form">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="title">فرم درخواست کمد آنلاین</div>
                        </div>
                    </div>
                    <div class="row">
                        @component("site.components.select",['name'=>'kind_payment','placeholder'=>'نوع پرداخت','items'=>$kind_payment,'value_old'=>old('kind_payment')])@endcomponent
                    </div>
                    <div class="online_payment">
                        <div class="row">
                            <ul class="list-unstyled payTypeInBank">
                                <li>
                                    <div class="rdl">
                                        <label>
                                            <input type="radio" name="bank" id="pay_online" value="zarinpal" checked="">
                                            <span>
                                                <img src="{{asset("site/assets/image/zarinpal.jpeg")}}" style="width:40px"><b>زرین پال</b>
                                            </span>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="bank_fish">
                        <div class="row">
                            @component('site.components.input',['name'=>'name','placeholder'=>'نام واریز کننده','value'=>old('name')])@endcomponent
                            @component('site.components.input',['name'=>'bank','placeholder'=>'نام بانک','value'=>old('bank')])@endcomponent
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                @component("site.components.select",['name'=>'account_number_id','class'=>'col-12','placeholder'=>'شماره حساب','items'=>$account_numbers,'value_old'=>old('account_number_id')])@endcomponent
                                <div id="bankacount_info"></div>
                            </div>
                            @component('site.components.input',['name'=>'fish_number','placeholder'=>'شماره فیش','value'=>old('fish_number')])@endcomponent
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-btn">
                            <button type="submit" class="btn-custom">ارسال</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form">
                    <div class="row">
                        <div class="col">
                            <div class="title">صورتحساب نهایی</div>
                        </div>
                    </div>
                    <div class="rowGrid basketLastStepRow">
                    <div class="colGrid2">
                        <ul class="list-unstyled basketFinalBill">
                            <li>
                                <div class="basketFinalBill__title">خرید شما</div>
                                <div class="basketFinalBill__value">{{number_format($price)}} <span> تومان </span></div>
                            </li>
                            <li class="basketFinalBill3">
                                <div class="basketFinalBill__title">مجموع کل پرداختی شما</div>
                                <div class="basketFinalBill__value">{{number_format($price)}}<span> تومان </span></div>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('footer')
<script>
    $(document).ready(function() {
        $("[name='kind_payment']").on('change', function () {
            $(".online_payment,.bank_fish").toggleClass("d-none",true);
            if($(this).val() == 1) {
                $(".online_payment").toggleClass("d-none",false);
            }else if($(this).val() == 2) {
                $(".bank_fish").toggleClass("d-none",false);
            }
        }).trigger("change");

        $("#bankacount_info").html('');
        $("[name='account_number_id']").on('change', function () {
            if($(this).val().length > 0) {
                $.ajax({
                    url: "{{route("bank_account")}}",
                    method: "post",
                    dataType: "json",
                    data: {
                        '_token': $("input[name='_token']").val(),
                        'account_number_id': $(this).val()
                    },
                    success: function (result) {
                        $("#bankacount_info").html(`شماره حساب : <span dir="ltr"> `+result['account_number']+` </span>
                        <br>شماره کارت : <span dir="ltr"> `+result['card_number']+`
                        </span> <br>بانک : `+result['bank'])
                    }
                })
            }else{
                $("#bankacount_info").html('');
            }
        }).trigger("change");
    })
</script>
@endsection

