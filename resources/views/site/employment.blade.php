@extends("site.layout.base")
@section('seo')
    @include("site.layout.partials.seo",["seo"=>$seo,"module"=>$module])
@endsection
@section('head')
    <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=fa"></script>
@endsection
@section('content')
    <div class="container-fluid container-bread-crumb" @if($module_pic) style="background-image:url({{asset("upload/".$module_pic)}})" @endif>
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            @if(isset($pages_employment_title))
                <div class="col" style="margin-bottom:25px">
                    <h2 class="title" >{{$pages_employment_title}}</h2>
                    @if(isset($pages_employment_title))
                        <div class="des note_employment">{!! $pages_employment_note !!}</div>
                    @endif
                </div>
            @endif
            @if(session()->has('success'))
                <div class="alert alert-success">{{session()->get('success')}}</div>
            @elseif(session()->has('fail_action'))
                <div class="alert alert-danger">{{session()->get('fail_action')}}</div>
            @endif
            <form action="{{route("employment.store")}}" method="post" class="form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    @component('site.components.input',['name'=>'name','placeholder'=>'* نام و نام خانوادگی','value'=>old('name')])@endcomponent
                    @component('site.components.input',['name'=>'middle_name','placeholder'=>'* نام پدر','value'=>old('middle_name')])@endcomponent
                    @component("site.components.select",['name'=>'province','items'=>$provinces,'value_old'=>old('province'),'key'=>'id','value'=>'name','placeholder'=>'* استان'])@endcomponent
                    @component("site.components.select",['name'=>'city','value_old'=>old('city'),'placeholder'=>'* شهر'])@endcomponent
                    @component('site.components.input',['name'=>'date_birth','placeholder'=>'* تاریخ تولد','class'=>'datepicker-input','value'=>old('date_birth'),'autocomplete'=>'off'])@endcomponent
                    @component('site.components.input',['name'=>'place_issue','placeholder'=>'* محل صدور','value'=>old('place_issue')])@endcomponent
                    @component('site.components.input',['name'=>'national_code','placeholder'=>'* کد ملی','value'=>old('national_code')])@endcomponent
                    @component('site.components.input',['name'=>'religion','placeholder'=>'* دین','value'=>old('religion')])@endcomponent
                    @component('site.components.input',['name'=>'mobile','placeholder'=>'* شماره تلفن همراه (09...)','value'=>old('mobile')])@endcomponent
                    @component('site.components.input',['name'=>'tell','placeholder'=>'* شماره تلفن ثابت','value'=>old('tell')])@endcomponent
                    @component('site.components.input',['name'=>'tell2','placeholder'=>'* شماره تلفن اضطراری','value'=>old('tell2')])@endcomponent
                    @component('site.components.input',['name'=>'email','placeholder'=>'* ایمیل','value'=>old('email')])@endcomponent
                    @component('site.components.textarea',['name'=>'address','placeholder'=>'* آدرس','value'=>old('address')])@endcomponent
                    @component('site.components.radio_button',['name'=>'gender','title'=>'* جنسیت','value'=>old('gender'),'loop_lang'=>__("employment.gender")])@endcomponent
                    @component('site.components.radio_button',['name'=>'military','title'=>'* وضعیت نظام وظیفه','value'=>old('military'),'loop_lang'=>__("employment.military")])@endcomponent
                    @component('site.components.input',['name'=>'military_title','placeholder'=>'نوع معافیت','value'=>old('military_title')])@endcomponent
                    @component('site.components.radio_button',['name'=>'married','title'=>'* وضعیت تأهل','value'=>old('married'),'loop_lang'=>__("employment.married")])@endcomponent
                    @component('site.components.input',['name'=>'married_title','placeholder'=>'تعداد افراد تحت تکفل','value'=>old('married_title')])@endcomponent
                    @component('site.components.radio_button',['name'=>'condemnation','title'=>'* سابقه محکومیت کیفری','value'=>old('condemnation'),'loop_lang'=>__("employment.yes_or_no")])@endcomponent
                    @component('site.components.radio_button',['name'=>'illness','title'=>'* سابقه بیماری','value'=>old('illness'),'loop_lang'=>__("employment.yes_or_no")])@endcomponent
                    <h2>شغل مورد تقاضا</h2>
                    <br>
                    <div class="row" style="margin-top: 20px">
                        @component('site.components.radio_button',['name'=>'work_type','title'=>'* متقاضی چه نوع کاری هستید؟','value'=>old('work_type'),'loop_lang'=>__("employment.work_type")])@endcomponent
                        @component('site.components.radio_button',['name'=>'work_evening','title'=>'* آیا می توانید در ساعات غروب نیز کار کنید؟','value'=>old('work_evening'),'loop_lang'=>__("employment.yes_or_no")])@endcomponent
                        @component('site.components.radio_button',['name'=>'work_operant','title'=>'* آیا در حال حاضر مشغول به کار هستید؟','value'=>old('work_operant'),'loop_lang'=>__("employment.yes_or_no")])@endcomponent
                        @component('site.components.radio_button',['name'=>'work_cooperate','title'=>'* در کدام زمینه تمایل به همکاری دارید؟','value'=>old('work_cooperate'),'loop_lang'=>$employment_section])@endcomponent
                        @component('site.components.radio_button',['name'=>'work_holidays','title'=>'* آیا می توانید در ایام پایان هفته یا روزهای تعطیل نیز کار کنید؟','value'=>old('work_holidays'),'loop_lang'=>__("employment.yes_or_no")])@endcomponent
                        @component('site.components.radio_button',['name'=>'insurance_history','title'=>'* آیا سابقه پرداخت بیمه دارید؟','value'=>old('insurance_history'),'loop_lang'=>__("employment.yes_or_no")])@endcomponent
                        @component('site.components.input',['name'=>'work_insurance','placeholder'=>'مدت پرداخت بیمه؟ (سال)','value'=>old('work_insurance')])@endcomponent
                        @component('site.components.input',['name'=>'insurance_number','placeholder'=>'شماره بیمه','value'=>old('insurance_number')])@endcomponent
                        @component('site.components.input',['name'=>'work_salary','placeholder'=>'حقوق درخواستی','value'=>old('work_salary')])@endcomponent
                    </div>
                    @component('site.components.clone',
                    [
                        'name'=>'resume',
                        'title'=>'سوابق شغلی ( به ترتیب از آخرین محل خدمت)',
                        'class_clear'=>'form-control',
                        'kinds'=>[
                            ['type'=>'input','name'=>'resume_organization','placeholder'=>'نام سازمان'],
                            ['type'=>'input','name'=>'resume_last_side','placeholder'=>'آخرین سمت'],
                            ['type'=>'input','name'=>'resume_cooperation','placeholder'=>'مدت همکاری (سال)'],
                            ['type'=>'input','name'=>'resume_cooperation_end','placeholder'=>'تاریخ پایان همکاری'],
                            ['type'=>'input','name'=>'resume_cooperation_reason','placeholder'=>'دلیل قطع همکاری'],
                        ]
                    ])
                    @endcomponent
                    @component('site.components.clone',
                    [
                        'name'=>'studdies',
                        'title'=>'سوابق تحصیلی',
                        'class_clear'=>'form-control',
                        'kinds'=>[
                            ['type'=>'input','name'=>'studdies_grade','placeholder'=>'مقطع تحصیلی'],
                            ['type'=>'input','name'=>'studdies_string','placeholder'=>'رشته'],
                            ['type'=>'input','name'=>'studdies_name_training','placeholder'=>'نام مرکز آموزشی'],
                            ['type'=>'input','name'=>'studdies_year_graduation','placeholder'=>'سال اخذ مدرک']
                        ]
                    ])
                    @endcomponent
                    @component('site.components.clone',
                    [
                        'name'=>'languages',
                        'title'=>'زبان های خارجی',
                        'class_clear'=>'form-control',
                        'kinds'=>[
                            ['type'=>'input','name'=>'languages_name','placeholder'=>'عنوان زبان'],
                            ['type'=>'select','name'=>'languages_writing','placeholder'=>'سطح مهارت نگارش','items'=>__("employment.grade_knowledge")],
                            ['type'=>'select','name'=>'languages_conversation','placeholder'=>'سطح مهارت مکالمه','items'=>__("employment.grade_knowledge")],
                            ['type'=>'select','name'=>'languages_read','placeholder'=>'سطح مهارت خواندن','items'=>__("employment.grade_knowledge")],
                        ]
                    ])
                    @endcomponent
                    <h2>آشنایی با کامپیوتر، نرم افزار و شبکه های اجتماعی</h2>
                    <br>
                    <div class="row" style="margin-top: 20px">
                        @component("site.components.select",['name'=>'it_office','title'=>'مجموعه آفیس شامل Word، Excel و PowerPoint :','items'=>__("employment.grade_knowledge"),'value_old'=>old('it_office')])@endcomponent
                        @component("site.components.select",['name'=>'it_accounting','title'=>'نرم افزارهای تخصصی حسابداری :','items'=>__("employment.grade_knowledge"),'value_old'=>old('it_accounting')])@endcomponent
                        @component("site.components.select",['name'=>'it_internet','title'=>'ویندوز، اینترنت و ایمیل :','items'=>__("employment.grade_knowledge"),'value_old'=>old('it_internet')])@endcomponent
                        @component("site.components.select",['name'=>'it_social','title'=>'شبکه های اجتماعی :','items'=>__("employment.grade_knowledge"),'value_old'=>old('it_social')])@endcomponent
                        @component("site.components.select",['name'=>'it_designing','title'=>'نرم افزارهای طراحی :','items'=>__("employment.grade_knowledge"),'value_old'=>old('it_designing')])@endcomponent
                        @component("site.components.select",['name'=>'it_it','title'=>'نرم افزارهای تخصصی حوزه IT :','items'=>__("employment.grade_knowledge"),'value_old'=>old('it_it')])@endcomponent
                        @component('site.components.input',['name'=>'it_note','title'=>'فهرست نرم افزارهایی که به آنها تسلط دارید:','col_class'=>'col-xs-12','value'=>old('it_note')])@endcomponent
                    </div>
                    @component('site.components.textarea',['name'=>'note_more','title'=>'سایر توضیحات','placeholder'=>'چنانچه علاوه بر موارد درج شده، مطلبی وجود دارد که تمایل به عنوان کردن آن دارید، قید بفرمایید :','value'=>old('note_more')])@endcomponent
                    <h2>مشخصات معرف</h2>
                    <br>
                    <div class="row" style="margin-top:20px">
                        @component('site.components.input',['name'=>'reagent_name','placeholder'=>'نام و نام خانوادگی','value'=>old('reagent_name')])@endcomponent
                        @component('site.components.input',['name'=>'reagent_job','placeholder'=>'شغل','value'=>old('reagent_job')])@endcomponent
                        @component('site.components.input',['name'=>'reagent_relativity','placeholder'=>'نسبت یا نوع آشنایی','value'=>old('reagent_relativity')])@endcomponent
                        @component('site.components.input',['name'=>'reagent_year','placeholder'=>'مدت آشنایی (سال)','value'=>old('reagent_year')])@endcomponent                        
                        @component('site.components.input',['name'=>'reagent_tell','placeholder'=>'شماره تماس','value'=>old('reagent_tell')])@endcomponent
                    </div>
                    <h2>آپلود تصویر و رزومه</h2>
                    <br>
                    <div class="row" style="margin-top:20px">
                        @component("site.components.upload_file",['name'=>'cv_file'])@endcomponent
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="g-recaptcha" data-sitekey="{{env("GOOGLE_RECAPTCHA_SITE_KEY")}}"></div>
                    </div>
                    @error('g-recaptcha-response')
                        <span class="text text-danger">
                            {{$errors->first('g-recaptcha-response')}}
                        </span>
                    @enderror
                    @component('site.components.button',['title'=>'ارسال پیام'])@endcomponent
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
@endsection
@section("footer")
<script>
    $(document).ready(function(){
        $("select[name='province']").on("change",function(){
            $.ajax({
                'url':'{{route("province_city")}}',
                'type':"post",
                'dataType':"json",
                'data':{'province_id':$(this).val(),'_token': $("input[name='_token']").val()},
                success:function(res){
                    if(res.length > 0){
                        var html="<option></option>";
                        $(res).each(function($index,$elm){
                            var selected='';
                            // if(elm['id']=="{{old('city')}}"){
                            //     selected='selected'
                            // }
                            html+="<option value="+$elm['id']+" "+selected+">"+$elm['name']+"</option>";
                        })
                        $("select[name='city']").html(html);
                    }else{
                        $("select[name='city']").append("<option value=''>نتیجه ای یافت نشد</option>")
                    }
                },error:function(){
                    $("select[name='city']").append("<option value=''>نتیجه ای یافت نشد</option>")
                }
            });
        }).trigger("change");
    });
</script>
<script>
    function cloneField03(elm) {
        var fistClone = elm.parents('.clone_03').find('.addField_03').eq(0);
        var noOfDivs = elm.parents('.clone_03').find('.addField_03').length;
        // destroy ---
        $("select.select2-hidden-accessible").select2('destroy');
        fistClone.find(".select2").removeAttr('data-select2-id').removeAttr('tabindex').removeAttr('aria-hidden');
        fistClone.find(".select2 option").removeAttr('data-select2-id');
        // clone ---
        var clonedDiv = fistClone.clone();
        clonedDiv.append('<a class="removeFields" href="javascript:void(0)" style="width:80px; height:40px; color:red;">- حذف</a>')
        clonedDiv.find(".form-control").val("");
        clonedDiv.find(".datepicker-input").removeClass("hasDatepicker").removeAttr('id');
        clonedDiv.insertBefore(elm);
        $(".select2").select2({
            theme: "default",
            dir: "rtl",
            language: "fa"
        });
        $(".datepicker-input").datepicker({
            dateFormat: "yy-mm-dd",
            changeYear: true,
            changeMonth: true,
            yearRange: '1300:1400',
            prevHTML: '<i class="zmdi zmdi-caret-right-circle"></i>',
            nextHTML: '<i class="zmdi zmdi-caret-left-circle"></i>',
        });
        // remove ---
        $(".removeFields").click(function (e) {
            e.preventDefault();
            $(this).parent().remove();
        });
    }
    $(".addField03").click(function (e) {
        e.preventDefault();
        cloneField03($(this));
    });
    $(".datepicker-input").datepicker({
        dateFormat: "yy/mm/dd",
        changeYear : true,
        changeMonth : true,
        yearRange: '1300:1400',
        prevHTML: '<i class="zmdi zmdi-caret-right-circle"></i>',
        nextHTML: '<i class="zmdi zmdi-caret-left-circle"></i>',
        onSelect: function(dateText, inst) {
            $(this).parent().addClass('visited');
        }
    });

</script>
@endsection