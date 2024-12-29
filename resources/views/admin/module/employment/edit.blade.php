@extends("admin.layout.base")
@php $module_name=" مشاهده فرم ". $module_title .' '.$employment['name']  @endphp
@section("title")
    {{$module_name}}
@endsection
@section("content")
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{$module_name}}</h4>
                        </div>
                        <div class="card-body">
                            <div style="padding: 15px;"> 
                                <h4>مشخصات</h4>
                                <table class="table text-center contact_table">
                                    <tr>
                                        <td width="200px"> نام و نام خانوادگی</td>
                                        <td>{{$employment['name']}}</td>
                                    </tr>
                                    <tr>
                                        <td>نام پدر</td>
                                        <td>{{$employment['middle_name']}}</td>
                                    </tr>
                                    <tr>
                                        <td>استان</td>
                                        <td>{{$employment->provinces->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>شهر</td>
                                        <td>{{$employment->cities->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>تاریخ تولد</td>
                                        <td>{{$employment->date_convert('date_birth')}}</td>
                                    </tr>
                                    <tr>
                                        <td>محل صدور</td>
                                        <td>{{$employment['place_issue']}}</td>
                                    </tr>
                                    <tr>
                                        <td>کد ملی</td>
                                        <td>{{$employment['national_code']}}</td>
                                    </tr>
                                    <tr>
                                        <td>دین</td>
                                        <td>{{$employment['religion']}}</td>
                                    </tr>
                                    <tr>
                                        <td>شماره تلفن همراه</td>
                                        <td>{{$employment['mobile']}}</td>
                                    </tr>
                                    <tr>
                                        <td>شماره تلفن ثابت</td>
                                        <td>{{$employment['tell']}}</td>
                                    </tr>

                                    <tr>
                                        <td>شماره تلفن اضطراری</td>
                                        <td>{{$employment['tell2']}}</td>
                                    </tr>
                                    <tr>
                                        <td>ایمیل</td>
                                        <td>{{$employment['email']}}</td>
                                    </tr>
                                    <tr>
                                        <td>آدرس</td>
                                        <td>{{$employment['address']}}</td>
                                    </tr>
                                    <tr>
                                        <td>جنسیت</td>
                                        <td>{{__('employment.gender.'.$employment['gender'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>وضعیت نظام وظیفه</td>
                                        <td>{{__('employment.military.'.$employment['military'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>نوع معافیت</td>
                                        <td>{{$employment['military_title'] ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>وضعیت تأهل</td>
                                        <td>{{__('employment.married.'.$employment['married'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>تعداد افراد تحت تکفل</td>
                                        <td>{{$employment['married_title'] ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>سابقه محکومیت کیفری</td>
                                        <td>{{__('employment.yes_or_no.'.$employment['condemnation'])}}</td>
                                     </tr>
                                    <tr>
                                        <td>سابقه بیماری</td>
                                        <td>{{__('employment.yes_or_no.'.$employment['illness'])}}</td>
                                    </tr>
                                </table>
                                <h4>شغل مورد تقاضا</h4>
                                <table class="table text-center contact_table">
                                    <tr>
                                        <td width="350px">متقاضی چه نوع کاری هستید؟</td>
                                        <td>{{__('employment.work_type.'.$employment['work_type'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>آیا می توانید در ساعات غروب نیز کار کنید؟</td>
                                        <td>{{__('employment.yes_or_no.'.$employment['work_evening'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>آیا در حال حاضر مشغول به کار هستید؟</td>
                                        <td>{{__('employment.yes_or_no.'.$employment['work_operant'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>در کدام زمینه تمایل به همکاری دارید؟</td>
                                        <td>{{$employment->employment_section->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>آیا می توانید در ایام پایان هفته یا روزهای تعطیل نیز کار کنید؟</td>
                                        <td>{{__('employment.yes_or_no.'.$employment['work_holidays'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>آیا سابقه پرداخت بیمه دارید؟</td>
                                        <td>{{__('employment.yes_or_no.'.$employment['insurance_history'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>مدت پرداخت بیمه؟ (سال)</td>
                                        <td>{{$employment['work_insurance'] ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>شماره بیمه</td>
                                        <td>{{$employment['insurance_number'] ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>حقوق درخواستی</td>
                                        <td>{{$employment['work_salary']}}</td>
                                    </tr>
                                </table>
                                <h4>سوابق شغلی ( به ترتیب از آخرین محل خدمت)</h4>
                               @if(@$employment->organization[0])
                                    @foreach ($employment->organization as $item)
                                    <table class="table text-center contact_table">
                                        <tr>
                                            <td width="200px">نام سازمان</td>
                                            <td>{{$item['name']}}</td>
                                        </tr>
                                        <tr>
                                            <td>آخرین سمت</td>
                                            <td>{{$item['last_side']}}</td>
                                        </tr>
                                        <tr>
                                            <td>مدت همکاری (سال)</td>
                                            <td>{{$item['cooperation_time']}}</td>
                                        </tr>
                                        <tr>
                                            <td>تاریخ پایان همکاری</td>
                                            <td>{{$item['cooperation_end']}}</td>
                                        </tr>
                                        <tr>
                                            <td>دلیل قطع همکاری</td>
                                            <td>{{$item['cooperation_reason']}}</td>
                                        </tr>
                                    </table>
                                    @endforeach
                                @else
                                <div class="alert alert-danger alert-not-found">نتیجه ای یافت نشد</div>
                                @endif
                                <h4>سوابق تحصیلی</h4>
                                @if(@$employment->studdies[0])
                                    @foreach ($employment->studdies as $item)
                                    <table class="table text-center contact_table">
                                        <tr>
                                            <td width="200px">مقطع تحصیلی</td>
                                            <td>{{$item['title']}}</td>
                                        </tr>
                                        <tr>
                                            <td>رشته</td>
                                            <td>{{$item['field_study']}}</td>
                                        </tr>
                                        <tr>
                                            <td>نام مرکز آموزشی</td>
                                            <td>{{$item['name_training']}}</td>
                                        </tr>
                                        <tr>
                                            <td>سال اخذ مدرک</td>
                                            <td>{{$item['year_graduation']}}</td>
                                        </tr>
                                    </table>
                                    @endforeach
                                @else
                                <div class="alert alert-danger alert-not-found">نتیجه ای یافت نشد</div>
                                @endif
                                <h4>زبان های خارجی</h4>
                                @if(@$employment->languages[0])
                                    @foreach ($employment->languages as $item)
                                    <table class="table text-center contact_table">
                                        <tr>
                                            <td width="200px">عنوان زبان</td>
                                            <td>{{$item['title']}}</td>
                                        </tr>
                                        <tr>
                                            <td>سطح مهارت نگارش</td>
                                            <td>{{__('employment.grade_knowledge.'.$item['write'])}}</td>
                                        </tr>
                                        <tr>
                                            <td>سطح مهارت مکالمه</td>
                                            <td>{{__('employment.grade_knowledge.'.$item['conversation'])}}</td>
                                        </tr>
                                        <tr>
                                            <td>سطح مهارت خواندن</td>
                                            <td>{{__('employment.grade_knowledge.'.$item['read'])}}</td>
                                        </tr>
                                    </table>
                                    @endforeach
                                @else
                                <div class="alert alert-danger alert-not-found">نتیجه ای یافت نشد</div>
                                @endif
                                <h4>آشنایی با کامپیوتر، نرم افزار و شبکه های اجتماعی</h4>
                                <table class="table text-center contact_table">
                                    <tr>
                                        <td width="350px">مجموعه آفیس شامل Word، Excel و PowerPoint</td>
                                        <td>{{__('employment.grade_knowledge.'.$employment['it_office'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>نرم افزارهای تخصصی حسابداری</td>
                                        <td>{{__('employment.grade_knowledge.'.$employment['it_accounting'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>ویندوز، اینترنت و ایمیل</td>
                                        <td>{{__('employment.grade_knowledge.'.$employment['it_internet'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>شبکه های اجتماعی</td>
                                        <td>{{__('employment.grade_knowledge.'.$employment['it_social'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>نرم افزارهای طراحی</td>
                                        <td>{{__('employment.grade_knowledge.'.$employment['it_designing'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>نرم افزارهای تخصصی حوزه IT</td>
                                        <td>{{__('employment.grade_knowledge.'.$employment['it_it'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>فهرست نرم افزارهایی که به آنها تسلط دارید</td>
                                        <td>{{$employment['it_note'] ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>سایر توضیحات</td>
                                        <td>{{$employment['note_more'] ?? '-'}}</td>
                                    </tr>
                                </table>
                                <h4>مشخصات معرف</h4>
                                <table class="table text-center contact_table">
                                    <tr>
                                        <td width="350px">نام و نام خانوادگی</td>
                                        <td>{{$employment['reagent_name'] ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>شغل</td>
                                        <td>{{$employment['reagent_job'] ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>نسبت یا نوع آشنایی</td>
                                        <td>{{$employment['reagent_relativity'] ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>مدت آشنایی (سال)</td>
                                        <td>{{$employment['reagent_year'] ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>شماره تماس</td>
                                        <td>{{$employment['reagent_tell'] ?? '-'}}</td>
                                    </tr>
                                </table>
                                <h4>آپلود تصویر و رزومه</h4>
                                @if(@$employment->cv_file)
                                <table class="table text-center contact_table">
                                    <tr>
                                        <td width="350px">رزومه</td>
                                        <td><a href="{{asset('/upload/'.$employment->cv_file->file)}}" target="_blank">دانلود</a></td>
                                    </tr>
                                </table>
                                @else
                                <div class="alert alert-danger alert-not-found">نتیجه ای یافت نشد</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection