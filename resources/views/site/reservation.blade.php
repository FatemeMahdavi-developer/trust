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
        {{-- <div class="row">
            <div class="col-12">
                <div class="contact-data">
                    <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="contact-data-box">
                                    <img src="/site/assets/image/icon-phone.png">
                                    <div class="des">
                                        <a href="tel:۰۲۱-۸۸۰۵۷۱۵۲" style="color: #fff">۰۲۱-۸۸۰۵۷۱۵۲</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="contact-data-box">
                                    <img src="/site/assets/image/icon-marker.png">
                                    <div class="des">فرشته - ادرس تست در این قسمت نوشته می شود</div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="contact-data-box last">
                                    <img src="/site/assets/image/icon-envelope.png">
                                    <div class="des">
                                        <a href="mailto:fateme.mahdavi.it@gmail.com" style="color: #fff"> fateme.mahdavi.it@gmail.com</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-12 show_here">
                <form action="{{route("reservation.store")}}" method="post" class="form">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="title">فرم درخواست کمد هوشمند</div>
                        </div>
                    </div>
                    @if(session()->has('order_error'))
                        <div class="alert alert-danger">{{session()->get('order_error')}}</div>
                    @endif
                    <div class="row">
                        @component("site.components.select",['name'=>'branch_id','title'=>'شعبه','items'=>$branches,'value_old'=>old('branch_id')])@endcomponent
                        @component("site.components.select",['name'=>'locker_bank_id','title'=>'سایز','items'=>[]])@endcomponent
                        @component("site.components.select",['name'=>'box_id','title'=>'باکس','items'=>[]])@endcomponent
                        @component("site.components.datepicker",['name'=>'expired_at','title'=>'تاریخ تحویل','value'=>old('expired_at')])@endcomponent
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-btn">
                            <button type="submit" class="btn-custom">پرداخت</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form">
                    <div class="row">
                        <div class="col">
                            <div class="title"> راهنمای اجاره کمد 📋</div>
                        </div>
                    </div>
                    <div class="rowGrid basketLastStepRow">
                    <div class="colGrid2" class="#">
                        <ul class="list-unstyled basketFinalBill text-center"  style="background: #f2f2f2">
                            <li>
                                <div lass="basketFinalBill__title">امکان تمدید آنلاین</div>
                            </li>
                            <li>
                                <div lass="basketFinalBill__title">دسترسی ۲۴ ساعته </div>
                            </li>
                            <li>
                                <div lass="basketFinalBill__title">مناسب برای همه اقلام</div>
                            </li>
                        </ul>
                        {{-- در صورتی ک اجاره کمد با توحه به شعبه انتخابی ماهانه باشد کمترین زمان همان یه ماه می باشد --}}
                        <div class="text-center" style="margin: 15px">
                            <div lass="basketFinalBill__title">
                                هزینه نهایی بر اساس مدت اجاره و شعبه محاسبه می‌شود
                            </div>
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

@section('footer')
<script>
    $(document).ready(function () {
        let sizes = @json($sizes);

        $("[name='branch_id']").on('change', function () {
            $("[name='box_id']").html("<option value=''>انتخاب کنید</option>");
            if ($(this).val().length > 0) {
                $.ajax({
                    url: "{{route("select_size")}}",
                    method: "post",
                    dataType: "json",
                    data: {
                        '_token': $("input[name='_token']").val(),
                        'branch_id': $(this).val()
                    },
                    success: function (result) {
                        if (result.length > 0) {
                            var html='<option value="">انتخاب کنید</option>';
                            $(result).each(function (index, element) {
                                var selected='';
                                if(element['id'] == "{{old("locker_bank_id")}}"){
                                    selected='selected'
                                }
                                html+="<option value=" + element['id'] + " "+selected   +">" +sizes[element['size']] + "</option>"
                            })
                            $("[name='locker_bank_id']").html(html)

                            if("{{old("locker_bank_id")}}" !== "") {
                                $("[name='locker_bank_id']").trigger("change");
                            }

                        } else {
                            $("[name='locker_bank_id']").html("<option value=''>نتیجه ای یافت نشد</option>")
                        }
                    },
                    error: function () {
                        toaste("error", "خطا در برقراری ارتباط")
                    }
                })
            }
        }).trigger("change");

        $("[name='locker_bank_id']").on('change', function () {
            if($(this).val().length > 0){
                $.ajax({
                    url: "{{route('select_box')}}",
                    method: "post",
                    dataType: "json",
                    data: {
                        '_token': $("input[name='_token']").val(),
                        'locker_bank_id': $(this).val()
                    },
                    success: function (result) {
                        if (result.length > 0) {
                            var html='<option value="">انتخاب کنید</option>';
                            $(result).each(function (index, element) {
                                var selected='';
                                if(element['id'] == "{{old("box_id")}}"){
                                    selected='selected'
                                }
                                html+="<option value=" + element['id'] + " "+selected   +">" +element['title'] + "</option>"
                            })
                            $("[name='box_id']").html(html)
                        } else {
                            $("[name='box_id']").html("<option value=''>نتیجه ای یافت نشد</option>")
                        }
                    },
                    error: function () {
                        toaste("error", "خطا در برقراری ارتباط");
                    }
                })
            }
        });
    })

    $(".datepicker-input").datepicker({
        dateFormat: "yy/mm/dd",
        changeYear : true,
        changeMonth : true,
        yearRange: '1403:1500',
        prevHTML: '<i class="zmdi zmdi-caret-right-circle"></i>',
        nextHTML: '<i class="zmdi zmdi-caret-left-circle"></i>',
        onSelect: function(dateText, inst) {
            $(this).parent().addClass('visited');
        }
    });
</script>
@endsection
