@extends("admin.layout.base")
@php $module_name= " ویرایش ".  $module_title @endphp
@section("title")
    {{$module_name}}
@endsection
@section("content")
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{$module_name}}</h4>
                            @if($user['locker_bank_owner'])
                                <div class="alert-success p-1">تایید برای اجاره لاکر بانک</div>
                            @endif
                        </div>
                        <div class="card-body">
                            @component($prefix_component."form",['action'=>route('admin.user.update',['user'=>$user["id"]]),'upload_file'=>true])
                                @slot("content")
                                    @method("put")
                                    @component($prefix_component."input_hidden",['value'=>$user['id']])@endcomponent
                                    <div class="d-flex">
                                        @component($prefix_component."input",['name'=>'name','title'=>'نام','value'=>old('name') ?? $user["name"],'class'=>'w-50 p-10'])@endcomponent
                                        @component($prefix_component."input",['name'=>'lastname','title'=>'نام خانوادگی','value'=>old('lastname') ?? $user["lastname"],'class'=>'w-50 p-10'])@endcomponent
                                    </div>
                                    <div class="d-flex">
                                        @component($prefix_component."input",['name'=>'national_code','title'=>'کد ملی','value'=>old('national_code') ?? $user["national_code"],'class'=>'w-50 p-10'])@endcomponent
                                        @component($prefix_component."select",['name'=>'gender','title'=>'جنسیت','class'=>'w-50 p-10','items'=>trans("common.gender"),'value_old'=>$user['gender']])@endcomponent
                                    </div>
                                    <div class="d-flex">
                                        @component($prefix_component."datepicker",['name'=>'date_birth','title'=>'تاریخ نمایش','value'=>[0=>str_replace("-","/",$user["date_birth_convert"])],'class'=>'w-50 p-10','hour_minute'=>false])@endcomponent
                                        @component($prefix_component."input",['name'=>'mobile','title'=>'موبایل','value'=>old('mobile') ?? $user["mobile"],'class'=>'w-50 p-10'])@endcomponent
                                    </div>
                                    <div class="d-flex">
                                        @component($prefix_component."input",['name'=>'email','title'=>'ایمیل','value'=>old('email') ?? $user["email"],'class'=>'w-50 p-10'])@endcomponent
                                        @component($prefix_component."input",['name'=>'password','title'=>'رمز عبور','type'=>'password','placeholder'=>"اگر رمز عبور را وارد کنید رمز عبور قبلی تغییر میکند...",'class'=>'w-50 p-10'])@endcomponent
                                    </div>
                                    <div class="d-flex">
                                        @component($prefix_component."select",['name'=>'province','title'=>'استان','class'=>'w-50 p-10','items'=>$provinces,'value_old'=>$user['province'],'key'=>'id','value'=>'name'])@endcomponent
                                        @component($prefix_component."select",['name'=>'city','title'=>'شهر','class'=>'w-50 p-10','items'=>[]])@endcomponent
                                    </div>
                                    <div class="d-flex">
                                        @component($prefix_component."input",['name'=>'postal_code','title'=>'کد پستی','value'=>old('postal_code') ?? $user["postal_code"],'class'=>'w-50 p-10'])@endcomponent
                                        @component($prefix_component."input",['name'=>'tell','title'=>'تلفن','value'=>old('tell') ?? $user["tell"],'class'=>'w-50 p-10'])@endcomponent
                                    </div>
                                    @component($prefix_component."textarea",['name'=>'address','class'=>'my-2 ','title'=>'آدرس','value'=>old('address') ?? $user["address"]])@endcomponent

                                    @component($prefix_component."checkbox",['name'=>'locker_bank_owner','value'=>old('locker_bank_owner') ?? $user["locker_bank_owner"],'title'=>'تایید برای اجاره لاکر','class'=>'w-50 m-10'])@endcomponent

                                    <div style="border: 1px solid #eee; padding:15px; background:#f3f3f3; margin-top:30px">
                                        @component($prefix_component."checkbox",['name'=>'legal_information_check','value'=>old('legal_information_check') ?? $user["legal_information_check"],'title'=>'اطلاعات حقوقی','class'=>'w-50'])@endcomponent
                                        <div class="d-flex">
                                            @component($prefix_component."input",['name'=>'company','title'=>'نام شرکت','value'=>old('company') ?? $user["company"],'class'=>'w-50 p-10'])@endcomponent
                                            @component($prefix_component."input",['name'=>'economic_code','title'=>'کد اقتصادی','value'=>old('economic_code') ?? $user["economic_code"],'class'=>'w-50 p-10'])@endcomponent
                                        </div>
                                        <div class="d-flex">
                                            @component($prefix_component."input",['name'=>'national_id','title'=>'شناسه ملی','value'=>old('national_id') ?? $user["national_id"],'class'=>'w-50 p-10'])@endcomponent
                                            @component($prefix_component."input",['name'=>'tell2','title'=>"شماره تلفن ثابت",'value'=>old('tell2') ?? $user["tell2"],'class'=>'w-50 p-10'])@endcomponent
                                        </div>
                                        <div class="d-flex">
                                            @component($prefix_component."select",['name'=>'province2','title'=>'استان','class'=>'w-50 p-10','items'=>$provinces,'value_old'=>$user['province2'],'key'=>'id','value'=>'name'])@endcomponent
                                            @component($prefix_component."select",['name'=>'city2','title'=>'شهر','class'=>'w-50 p-10','items'=>[]])@endcomponent
                                        </div>
                                        @component($prefix_component."input",['name'=>'registration_number','title'=>"شماره ثبت",'value'=>old('registration_number') ?? $user["registration_number"],'class'=>'w-50 p-10'])@endcomponent
                                    </div>
                                    @component($prefix_component."button",['title'=>'ارسال'])@endcomponent
                                @endslot
                            @endcomponent
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection
@section("footer")
    <script>
        $(document).ready(function () {
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
                                    if (element['id'] == "{{$user["city"]}}") {
                                        selected = 'selected'
                                    }
                                    html += "<option value=" + element['id'] + " " + selected + ">" + element['name'] + "</option>"
                                })
                                $("[name='city']").html(html)
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
                                    if (element['id'] == "{{$user["city2"]}}") {
                                        selected = 'selected'
                                    }
                                    html += "<option value=" + element['id'] + " " + selected + ">" + element['name'] + "</option>"
                                })
                                $("[name='city2']").html(html)
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

    </script>
@endsection

