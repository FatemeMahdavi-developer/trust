@extends("site.layout.base")
@section('head')
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-11.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/pages/page-11-01.css')}}">
    <style>
        .legal_information.disabled {
    opacity: 0.5;
    pointer-events: none;
}
    </style>
@endsection
@section('content')
    <div class="page-profile">
        <!-- bread crumb -->
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
        <!--/ bread crumb -->
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
                                @if(session()->has('success'))
                                    <div class="alert alert-success">{{session()->get('success')}}</div>
                                @endif
                                <form action="{{route("user.change_profile_store")}}" method="post" class="form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="input-box">
                                                        <input placeholder="نام(اجباری)" type="text" name="name" value="{{auth()->user()->name ?? old("name")}}" class="form-input">
                                                        @error("name")<span class="text text-danger">{{$errors->first('name')}}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="input-box">
                                                        <input placeholder="نام خانوادگی(اجباری)" type="text" name="lastname" value="{{auth()->user()->lastname ?? old("lastname")}}" class="form-input">
                                                        @error("lastname")<span class="text text-danger">{{$errors->first('lastname')}}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="input-box">
                                                        <input placeholder="کد ملی (اجباری)" type="text" name="national_code" value="{{auth()->user()->national_code ?? old("national_code")}}" class="form-input">
                                                        @error("national_code")<span class="text text-danger">{{$errors->first('national_code')}}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="input-box">
                                                        <select name="gender" class="form-control select2" id="">
                                                            <option value="">جنسیت</option>
                                                            @foreach($genders as $key => $value)
                                                                <option value="{{$key}}">{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error("gender")<span class="text text-danger">{{$errors->first('gender')}}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="input-box input-box-date">
                                                        <input placeholder="تاریخ تولد (اختیاری)" type="text" name="date_birth" class="form-input datepicker-input" value="{{auth()->user()->date_birth_convert ?? old("date_birth")}}" autocomplete="off" >
                                                        @error("date_birth")<span class="text text-danger">{{$errors->first('date_birth')}}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="input-box">
                                                        <input placeholder="شماره تلفن همراه (اجباری)" type="text" class="form-input" name="mobile" value="{{auth()->user()->mobile ?? old("mobile")}}">
                                                        @error("mobile")<span class="text text-danger">{{$errors->first('mobile')}}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="input-box">
                                                        <input placeholder="ایمیل (اجباری)" type="text" class="form-input" name="email" value="{{auth()->user()->email ?? old("email")}}">
                                                        @error("email")<span class="text text-danger">{{$errors->first('email')}}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="input-box">
                                                        <input placeholder="کدپستی (اختیاری)" type="text" class="form-input" name="postal_code" value="{{auth()->user()->postal_code ?? old("postal_code")}}">
                                                        @error("postal_code")<span class="text text-danger">{{$errors->first('postal_code')}}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="input-box">
                                                        <select name="province" class="form-control select2" id="province">
                                                            <option value="">استان</option>
                                                            @foreach($provinces as $province)
                                                                <option
                                                                    value="{{$province["id"]}}">{{$province["name"]}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error("province")<span class="text text-danger">{{$errors->first('province')}}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="input-box">
                                                        <select name="city" class="form-control select2" id="">
                                                            <option value="">انتخاب کنید</option></select>
                                                        @error("city")<span class="text text-danger">{{$errors->first('city')}}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm- col-12">
                                                    <div class="input-box">
                                                        <input placeholder="تلفن ثابت (اختیاری)" type="text" name="tell" value="{{auth()->user()->tell ?? old("tell")}}" class="form-input">
                                                        @error("tell")<span class="text text-danger">{{$errors->first('tell')}}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="input-box">
                                                        <textarea name="address" class="form-textarea" rows="3" placeholder="نشانی (اجباری)">{{auth()->user()->address ?? old("address")}}</textarea>
                                                        @error("address")<span class="text text-danger">{{$errors->first('address')}}</span>@enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="legal_information_content">
                                                @if(auth()->user()->locker_bank_owner==1 && auth()->user()->legal_information_check==1)
                                                    <div class="alert alert-warning showDate text-center">
                                                        درصورتی که احراز هویت شما جهت اجاره لاکر تایید شده باشد امکان ویرایش اطلاعات حقوقی وجود ندارد
                                                    </div>
                                                @endif
                                                <div class="row m-0">
                                                    <div class="col-xs-12 col-sm-12">
                                                        <div class="chb legal_information_check">
                                                            <label>
                                                                <input type="checkbox" name="legal_information_check" value="1" id="legal_information_check" @if(old('legal_information_check', auth()->user()->legal_information_check) == 1) checked @endif ><span class="focused"></span>
                                                                مایل به تکمیل اطلاعات
                                                                حقوقی برای رزرو لاکر سازمانی هستم.
                                                            </label>
                                                        </div>
                                                        <p>
                                                            <br>
                                                            با تکمیل اطلاعات حقوقی سازمان مورد نظر خود می توانید اقدام به اجاره لاکر بانک
                                                            سازمانی با دریافت فاکتور و گواهی ارزش افزوده نمایید
                                                        </p>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                        <div class="legal_information">
                                                            <div class="over_area" style="display: none;"></div>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                                    <div class="input-box">
                                                                        <input placeholder="نام شرکت" type="text" name="company" value="{{old("company") ?? auth()->user()->company}}" class="form-input">
                                                                        @error("company")<span class="text text-danger">{{$errors->first('company')}}</span>@enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                                    <div class="input-box">
                                                                        <input placeholder="کد اقتصادی" type="text" name="economic_code" value="{{old("economic_code") ?? auth()->user()->economic_code}}" class="form-input">
                                                                        @error("economic_code")<span class="text text-danger">{{$errors->first('economic_code')}}</span>@enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                                    <div class="input-box">
                                                                        <input placeholder="شناسه ملی" type="text" name="national_id" value="{{ old("national_id") ?? auth()->user()->national_id}}" class="form-input">
                                                                        @error("national_id")<span class="text text-danger">{{$errors->first('national_id')}}</span>@enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                                    <div class="input-box">
                                                                        <input placeholder="شماره تلفن ثابت" type="text" name="tell2" value="{{old("tell2") ?? auth()->user()->tell2}}" class="form-input">
                                                                        @error("tell2")<span class="text text-danger">{{$errors->first('tell2')}}</span>@enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                                    <div class="input-box">
                                                                        <input placeholder="شماره ثبت" type="text" name="registration_number" value="{{old("registration_number") ?? auth()->user()->registration_number}}" class="form-input">
                                                                        @error("registration_number")<span class="text text-danger">{{$errors->first('registration_number')}}</span>@enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                                    <div class="input-box">
                                                                        <select name="province2" class="form-control select2" id="province2">
                                                                            <option value="">استان</option>
                                                                            @foreach($provinces as $province)
                                                                                <option
                                                                                    value="{{$province["id"]}}">{{$province["name"]}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error("province2")<span class="text text-danger">{{$errors->first('province2')}}</span>@enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                                    <div class="input-box">
                                                                        <select name="city2" class="form-control select2" id="city2">
                                                                            <option value="">انتخاب کنید</option></select>
                                                                        @error("city2")<span class="text text-danger">{{$errors->first('city2')}}</span>@enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12 text-left">
                                            <button type="submit" name="form-profile-submit" class="btn-custom">تکمیل
                                                اطلاعات
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("footer")
    <script>
        $(document).ready(function () {
            $("[name='province']").val("{{auth()->user()->province ?? old("province")}}")
            $("[name='province2']").val("{{auth()->user()->province2 ?? old("province2")}}")
            $("[name='gender']").val("{{auth()->user()->gender ?? old("gender")}}")
            $("[name='province']").on('change', function () {
                if ($(this).val().length > 0) {
                    $.ajax({
                        url: "{{route("admin.province_city")}}",
                        method: "post",
                        dataType: "json",
                        data: {
                            '_token': $("input[name='_token']").val(),
                            'province_id': $(this).val()
                        },
                        success: function (result) {
                            if (result.length > 0) {
                                var html = '<option value="">انتخاب کنید</option>';
                                $(result).each(function (index, element) {
                                    var selected = '';
                                    if (element['id'] == "{{auth()->user()->city}}") {
                                        selected = 'selected'
                                    }
                                    html += "<option value=" + element['id'] + " " + selected + ">" + element['name'] + "</option>"
                                })
                                $("[name='city']").html(html)
                                $("[name='city']").select2({
                                    placeholder: "شهر",
                                    theme: "default",
                                    dir: "rtl",
                                    language: "fa"
                                })
                            } else {
                                $("[name='city']").append("<option value=''>نتیجه ای یافت نشد</option>")
                            }
                        },
                        error: function () {
                            toaste("error", "خطا در برقراری ارتباط")
                        }
                    })
                }
            }).trigger("change");
            $("[name='province2']").on('change', function () {
                if ($(this).val().length > 0) {
                    $.ajax({
                        url: "{{route("admin.province_city")}}",
                        method: "post",
                        dataType: "json",
                        data: {
                            '_token': $("input[name='_token']").val(),
                            'province_id': $(this).val()
                        },
                        success: function (result) {
                            if (result.length > 0) {
                                var html = '<option value="">انتخاب کنید</option>';
                                $(result).each(function (index, element) {
                                    var selected = '';
                                    if (element['id'] == "{{auth()->user()->city2}}") {
                                        selected = 'selected'
                                    }
                                    html += "<option value=" + element['id'] + " " + selected + ">" + element['name'] + "</option>"
                                })
                                $("[name='city2']").html(html)
                                $("[name='city2']").select2({
                                    placeholder: "شهر",
                                    theme: "default",
                                    dir: "rtl",
                                    language: "fa"
                                })
                            } else {
                                $("[name='city2']").append("<option value=''>نتیجه ای یافت نشد</option>")
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
            dateFormat: "yy-mm-dd",
            changeYear : true,
            changeMonth : true,
            yearRange: '1300:1400',
            prevHTML: '<i class="zmdi zmdi-caret-right-circle"></i>',
            nextHTML: '<i class="zmdi zmdi-caret-left-circle"></i>',
            onSelect: function(dateText, inst) {
                $(this).parent().addClass('visited');
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById('legal_information_check');
            const legalInfo = document.querySelector('.legal_information');
            function toggleLegalInfo() {
                if ({{ (int) auth()->user()->locker_bank_owner}} === 1 && {{ (int) auth()->user()->legal_information_check}} === 1) {
                    legalInfo.classList.add('disabled'); // همیشه غیرفعال
                    checkbox.disabled = true; // حتی اجازه تغییر هم نداره
                } else {
                    if (checkbox.checked) {
                        legalInfo.classList.remove('disabled');
                    } else {
                        legalInfo.classList.add('disabled');
                    }
                }
            }
            toggleLegalInfo();
            checkbox.addEventListener('change', toggleLegalInfo);
        });
    </script>
@endsection
