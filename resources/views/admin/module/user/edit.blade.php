@extends("admin.layout.base")
@php $module_name= " ویرایش ".  $module_title @endphp
@section("title")
    {{$module_name}}
@endsection
@section("head")
  <style>
    .card-container {
        perspective: 1000px;
        width: 400px;
        height: 250px;
    }
    .bank-card {
        width: 100%;
        height: 100%;
        position: relative;
        background: linear-gradient(102deg, #302c83 0%, #637cae 50%, #302c83 100%);
        border-radius: 15px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        transition: transform 0.3s ease;
        cursor: pointer;
    }

    .card-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 250"><defs><pattern id="circuit" patternUnits="userSpaceOnUse" width="40" height="40"><path d="M0 20h40M20 0v40" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="400" height="250" fill="url(%23circuit)"/></svg>');
        opacity: 0.3;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px 10px;
        color: white;
    }

    .bank-logo {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .bank-logo i {
        font-size: 24px;
        color: #fff;
    }

    .bank-name {
        font-size: 14px;
        font-weight: 600;
        color: white;
    }

    .card-type {
        font-size: 12px;
        background: rgba(255, 255, 255, 0.2);
        padding: 4px 12px;
        border-radius: 20px;
        color: white;
    }

    .card-number {
        padding: 0 25px;
        margin: 20px 0;
    }

    .card-number-display {
        font-family: 'Courier New', monospace;
        font-size: 22px;
        font-weight: 600;
        color: white;
        letter-spacing: 3px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        margin-bottom: 5px;
        text-align: center;
    }

    .sheba-number-display {
        font-family: 'Courier New', monospace;
        font-size: 11px;
        font-weight: 600;
        color: white;
        letter-spacing: 3px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        margin-bottom: 5px;
        text-align: center;
    }

    .card-holder-name {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
    }

    .card-bottom {
        position: absolute;
        bottom: 20px;
        left: 25px;
        right: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: white;
    }

    .card-info {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .card-info-label {
        font-size: 10px;
        color: rgba(255, 255, 255, 0.7);
        text-transform: uppercase;
    }

    .card-info-value {
        font-size: 14px;
        font-weight: 600;
        color: white;
    }

    .card-chip {
        width: 45px;
        height: 35px;
        background: linear-gradient(45deg, #ffd700, #ffed4e);
        border-radius: 5px;
        position: relative;
        margin: 10px 0;
    }

    .card-chip::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 35px;
        height: 25px;
        background: linear-gradient(45deg, #f39c12, #e67e22);
        border-radius: 3px;
    }

    .card-wave {
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 60%);
        border-radius: 50%;
    }

    .form-container {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        margin-top: 30px;
        width: 100%;
        max-width: 400px;
    }

    .form-group label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .form-control {
        border: 2px solid #ecf0f1;
        border-radius: 8px;
        padding: 12px;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #e74c3c;
        box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
    }

    .btn-update {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
        border: none;
        color: white;
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
    }
    .contactless-icon {
        position: absolute;
        top: 20px;
        right: 80px;
        color: rgba(255, 255, 255, 0.7);
        font-size: 20px;
    }

    @media (max-width: 768px) {
        .card-container {
            width: 350px;
            height: 220px;
        }
        .card-number-display {
            font-size: 20px;
        }
    }
  </style>
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
                                    @component($prefix_component."navtab",['number'=>3,'titles'=>['مشخصات کاربر','اطلاعات حقوقی','شماره حساب']])
                                        @slot("tabContent0")
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
                                        @endslot
                                        @slot("tabContent1")
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
                                        @endslot
                                        @slot("tabContent2")
                                            <div class="row justify-content-center mb-5">
                                                <div class="card-container">
                                                    <div class="bank-card" id="bankCard">
                                                        <div class="card-background"></div>
                                                        <div class="card-wave"></div>
                                                        <div class="card-header" style="border-bottom-color:transparent !important">
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
                                    @endslot

                                    @endcomponent
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
                                $("[name='city']").html("<option value=''>نتیجه ای یافت نشد</option>")
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
                                $("[name='city2']").html("<option value=''>نتیجه ای یافت نشد</option>")
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

