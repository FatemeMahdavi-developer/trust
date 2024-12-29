@extends("admin.layout.base")
@php $module_name= $module_title . " جدید "@endphp
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
                            @component($prefix_component."form",['action'=>route('admin.manager.store'),'upload_file'=>true])
                                @slot("content")
                                    @component($prefix_component."input",['name'=>'fullname','title'=>'نام و نام خانوادگی','value'=>old('fullname'),'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'mobile','title'=>'موبایل','value'=>old('mobile'),'class'=>'w-50','placeholder'=>'091********','dir'=>'ltr'])@endcomponent
                                    @component($prefix_component."input",['name'=>'email','title'=>'ایمیل','value'=>old('email'),'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'username','title'=>'نام کاربری','value'=>old('username'),'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'password','title'=>'پسورد','value'=>old('password'),'class'=>'w-50','type'=>'password'])@endcomponent
                                    @component($prefix_component."input",['name'=>'password_confirmation','title'=>'تکرار رمز عبور','value'=>old('password_confirmation'),'class'=>'w-50','type'=>'password'])@endcomponent
                                    @component($prefix_component."select",['name'=>'role_id','title'=>'سطح دسترسی','class'=>'w-50','items'=>$roles,'value_old'=>old('role_id'),'key'=>'id','value'=>'title'])@endcomponent
                                    @component($prefix_component."upload_file",['name'=>'pic','title'=>'تصویر','class'=>'w-50','module'=>$module])@endcomponent
                                    @component($prefix_component."select",['name'=>'province','title'=>'استان','class'=>'w-50','items'=>$provinces,'value_old'=>old('province'),'key'=>'id','value'=>'name'])@endcomponent
                                    @component($prefix_component."select",['name'=>'city','title'=>'شهر','class'=>'w-50','items'=>[]])@endcomponent
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
                                var html='<option value="">انتخاب کنید</option>';
                                $(result).each(function (index, element) {
                                    var selected='';
                                    if(element['id'] == "{{old("city")}}"){
                                        selected='selected'
                                    }
                                    html+="<option value=" + element['id'] + " "+selected   +">" + element['name'] + "</option>"
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
