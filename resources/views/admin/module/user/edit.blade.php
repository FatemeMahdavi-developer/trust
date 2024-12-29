@extends("admin.layout.base")
@php $module_name= $module_title . " ویرایش "@endphp
@section("title")
    {{$module_name}}
@endsection
@section("content")
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between  ">
                            <h4>{{$module_name}}</h4>
                        </div>
                        <div class="card-body">
                            @component($prefix_component."form",['action'=>route('admin.user.update',['user'=>$user["id"]]),'upload_file'=>true])
                                @slot("content")
                                    @method("put")
                                    @component($prefix_component."input_hidden",['value'=>$user['id']])@endcomponent
                                    @component($prefix_component."input",['name'=>'name','title'=>'نام','value'=>$user["name"],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'lastname','title'=>'نام خانوادگی','value'=>$user["lastname"],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'national_code','title'=>'کد ملی','value'=>$user["national_code"],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."select",['name'=>'gender','title'=>'جنسیت','class'=>'w-50','items'=>trans("common.gender"),'value_old'=>$user['gender']])@endcomponent
                                    @component($prefix_component."datepicker",['name'=>'date_birth','title'=>'تاریخ نمایش','value'=>[0=>str_replace("-","/",$user["date_birth_convert"])],'class'=>'w-50','hour_minute'=>false])@endcomponent
                                    @component($prefix_component."input",['name'=>'mobile','title'=>'موبایل','value'=>$user["mobile"],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'email','title'=>'ایمیل','value'=>$user["email"],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'password','title'=>'رمز عبور','type'=>'password','placeholder'=>"اگر رمز عبور را وارد کنید رمز عبور قبلی تغییر میکند...",'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'postal_code','title'=>'کد پستی','value'=>$user["postal_code"],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."select",['name'=>'province','title'=>'استان','class'=>'w-50','items'=>$provinces,'value_old'=>$user['province'],'key'=>'id','value'=>'name'])@endcomponent
                                    @component($prefix_component."select",['name'=>'city','title'=>'شهر','class'=>'w-50','items'=>[]])@endcomponent
                                    @component($prefix_component."input",['name'=>'tell','title'=>'تلفن','value'=>$user["tell"],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."textarea",['name'=>'address','class'=>'my-2 ','title'=>'آدرس','value'=>$user["address"]])@endcomponent
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
        })

    </script>
@endsection

