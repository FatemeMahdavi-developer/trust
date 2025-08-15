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
            <div class="col-lg-8 col-md-8 col-sm-12 col-12 show_here">
                <form action="{{route("reservation.store")}}" method="post" class="form">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="title">فرم درخواست کمد آنلاین</div>
                        </div>
                    </div>
                    @if(session()->has('order_error'))
                        <div class="alert alert-danger">{{session()->get('order_error')}}</div>
                    @endif
                    <div class="row">
                        @component("site.components.select_recursive",['name'=>'size_id','placeholder'=>'سایز','options'=>$sizes,'value'=>old('size_id'),'choose'=>true])@endcomponent
                        @component("site.components.select",['name'=>'box_id','placeholder'=>'باکس','items'=>[]])@endcomponent
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
                @if(isset($prices[0]))
                <div class="form">
                    <div class="row">
                        <div class="col">
                            <div class="title">جدول تعرفه قیمت ساعتی </div>
                        </div>
                    </div>
                    <div class="rowGrid basketLastStepRow">
                    <div class="colGrid2">
                        <ul class="list-unstyled basketFinalBill"  style="background: #c0e6d3">
                            @foreach($prices as $price)
                            <li>
                                <div class="basketFinalBill__title">سایز {{$price->title}}</div>
                                <div class="basketFinalBill__value">{{$price->price}} <span>تومان</span></div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('footer')
<script>
    $(document).ready(function () {
        $("[name='size_id']").on('change', function () {
            if ($(this).val().length > 0) {
                $.ajax({
                    url: "{{route("select_box")}}",
                    method: "post",
                    dataType: "json",
                    data: {
                        '_token': $("input[name='_token']").val(),
                        'size_id': $(this).val()
                    },
                    success: function (result) {
                        if (result.length > 0) {
                            var html='<option value="">انتخاب کنید</option>';
                            $(result).each(function (index, element) {
                                var selected='';
                                if(element['id'] == "{{old("box_id")}}"){
                                    selected='selected'
                                }
                                html+="<option value=" + element['id'] + " "+selected   +">" + element['title'] + "</option>"
                            })
                            $("[name='box_id']").html(html)
                        } else {
                            $("[name='box_id']").append("<option value=''>نتیجه ای یافت نشد</option>")
                        }
                    },
                    error: function () {
                        toaste("error", "خطا در برقراری ارتباط")
                    }
                })
            }
        }).trigger("change");
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
