@extends("admin.layout.base")
@php $module_name= $module_title @endphp
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
                            @component($prefix_component."navtab",['number'=>7,'titles'=>['اصلی','فرعی','بلوک','عناوین ماژول','ماژول ها در مدیریت','پیامک','ایمیل']])
                                @slot("tabContent0")
                                    @component($prefix_component."form",["action"=>route('admin.setting.store')])
                                        @slot("content")
                                            @component($prefix_component."input",['name'=>'site_title','title'=>'عنوان سایت','value'=>app('setting')['site_title'] ?? "",'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."input",['name'=>'site_title_en','title'=>'عنوان سایت انگلیسی','value'=>app('setting')['site_title_en'] ?? "",'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."input",['name'=>'email_manager','title'=>'ایمیل مدیریت','value'=>app('setting')['email_manager'] ?? "",'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."input",['name'=>'mobile_manager','title'=>'موبایل مدیریت','value'=>app('setting')['mobile_manager'] ?? "",'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."input",['name'=>'tell_manager','title'=>'تلفن','value'=>app('setting')['tell_manager'] ?? "",'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."input",['name'=>'postal_code','title'=>'کد پستی','value'=>app('setting')['postal_code'] ?? "",'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."textarea",['name'=>'address','title'=>'نشانی','value'=>app('setting')['address'] ?? "",'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."button",['title'=>'ارسال'])@endcomponent
                                        @endslot
                                    @endcomponent
                                @endslot
                                @slot("tabContent1")
                                    @component($prefix_component."form",["action"=>route('admin.setting.store')])
                                        @slot("content")
                                            @component($prefix_component."input",['name'=>'google_analytics_code','title'=>'کد گوگل آنالیتیکس','value'=>app('setting')['google_analytics_code'] ?? "",'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."card",["title"=>"آیتم های فوتر سایت"])
                                                @slot("card_content")
                                                    @component($prefix_component."input",['name'=>'tell_footer','title'=>'تلفن','value'=>app('setting')['tell_footer'] ?? "",'class'=>'w-50'])@endcomponent
                                                    @component($prefix_component."input",['name'=>'email_footer','title'=>'ایمیل','value'=>app('setting')['email_footer'] ?? "",'class'=>'w-50'])@endcomponent
                                                    @component($prefix_component."textarea_variable",['name'=>'address_footer','title'=>'آدرس','value'=>app('setting')['address_footer'] ?? ""])@endcomponent
                                                @endslot
                                            @endcomponent
                                            @component($prefix_component."card",["title"=>"آیتم های تماس با ما"])
                                            @slot("card_content")
                                                @component($prefix_component."input",['name'=>'tell_contact','title'=>'تلفن','value'=>app('setting')['tell_contact'] ?? "",'class'=>'w-50'])@endcomponent
                                                @component($prefix_component."input",['name'=>'email_contact','title'=>'ایمیل','value'=>app('setting')['email_contact'] ?? "",'class'=>'w-50'])@endcomponent
                                                @component($prefix_component."textarea_variable",['name'=>'address_contact','title'=>'آدرس','value'=>app('setting')['address_contact'] ?? ""])@endcomponent
                                            @endslot
                                        @endcomponent
                                            @component($prefix_component."button",['title'=>'ارسال'])@endcomponent
                                        @endslot
                                    @endcomponent
                                @endslot
                                @slot("tabContent2")
                                    @component($prefix_component."form",["action"=>route('admin.setting.store')])
                                        @slot("content")
                                            @component($prefix_component."input",['name'=>'main_slider_count','title'=>'تعداد اسلایدر صفحه اصلی','value'=>app('setting')['main_slider_count'] ?? "",'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."input",['name'=>'news_count','title'=>'تعداد اخبار','value'=>app('setting')['news_count'] ?? "",'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."input",['name'=>'product_count','title'=>'تعداد محصولات','value'=>app('setting')['product_count'] ?? "",'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."button",['title'=>'ارسال'])@endcomponent
                                        @endslot
                                    @endcomponent
                                @endslot
                                @slot("tabContent3")
                                    @component($prefix_component."form",["action"=>route('admin.setting.store'),'upload_file'=>true])
                                        @slot("content")
                                            @foreach(trans("modules.module_name_site") as $module_key => $module_value)
                                                @component($prefix_component."card",["title"=>$module_value])
                                                    @slot("card_content")
                                                        @component($prefix_component."input",['name'=>$module_key.'_title','title'=>"عنوان",'value'=>app('setting')[$module_key.'_title'] ?? "",'class'=>'w-50'])@endcomponent
                                                        @component($prefix_component."upload_file",['name'=>$module_key.'_pic','title'=>'تصویر ','value'=>app('setting')[$module_key.'_pic'] ?? "",'class'=>'w-50'])@endcomponent 
                                                        @component($prefix_component."upload_file",['name'=>$module_key.'_pic_mobile','title'=>'تصویر موبایل (310x300)','value'=>app('setting')[$module_key.'_pic_mobile'] ?? "",'class'=>'w-50'])@endcomponent
                                                        {{-- @component($prefix_component."upload_file",['name'=>$module_key.'_video','title'=>'ویدیو','value'=>app('setting')[$module_key.'_video'] ?? "",'class'=>'w-50'])@endcomponent --}}
                                                        {{-- @component($prefix_component."upload_file",['name'=>$module_key.'_video_mobile','title'=>'ویدیو موبایل','value'=>app('setting')[$module_key.'_video_mobile'] ?? "",'class'=>'w-50'])@endcomponent --}}
                                                        @component($prefix_component."tagsinput",['name'=>$module_key.'_keyword','title'=>'کلمات کلیدی','class'=>'w-50','value'=>app('setting')[$module_key.'_keyword'] ?? "" ])@endcomponent
                                                        @component($prefix_component."textarea",['name'=>$module_key.'_description','title'=>"نوضیحات",'value'=>app('setting')[$module_key.'_description'] ?? ""])@endcomponent
                                                    @endslot
                                                @endcomponent
                                            @endforeach
                                            @component($prefix_component."button",['title'=>'ارسال'])@endcomponent

                                        @endslot
                                    @endcomponent
                                @endslot
                                @slot("tabContent4")
                                    @component($prefix_component."form",["action"=>route('admin.setting.store'),'upload_file'=>true])
                                        @slot("content")
                                            @foreach(trans("modules.module_name") as $key => $value)
                                            @component($prefix_component."input",['name'=>"admin_module_".$key,'title'=>"عنوان " . $value,'value'=>app('setting')["admin_module_".$key] ?? $value,'class'=>'w-50'])@endcomponent
                                            @endforeach
                                            @component($prefix_component."button",['title'=>'ارسال'])@endcomponent
                                        @endslot
                                    @endcomponent
                                @endslot
                                @slot("tabContent5")
                                    @component($prefix_component."form",["action"=>route('admin.setting.store')])
                                        @slot("content")
                                            @component($prefix_component."input",['name'=>"address_mobile_sms",'title'=>"آدرس ارسال خط",'value'=>app('setting')["address_mobile_sms"] ?? "",'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."input",['name'=>"mobile_sms",'title'=>"شماره خط",'value'=>app('setting')["mobile_sms"] ?? "",'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."input",['name'=>"user_address_sms",'title'=>"شناسه کاربری",'value'=>app('setting')["user_address_sms"] ?? "",'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."input",['name'=>"user_password_sms",'title'=>"رمز عبور",'value'=>app('setting')["user_password_sms"] ?? "",'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."textarea_variable",['name'=>'confirm_msg_pattern_sms','title'=>'ارسال پیامک کد فعال سازی عضویت ','value'=>app('setting')['confirm_msg_pattern_sms']??''])
                                                @slot("variable")
                                                    <a href="javascript:void(0)" class="text-decoration-none">#fullname#</a>
                                                    <a href="javascript:void(0)" class="text-decoration-none">#code#</a>
                                                @endslot
                                            @endcomponent
                                            @component($prefix_component."textarea_variable",['name'=>'before_active_msg_pattern_sms','title'=>'ارسال پیامک پس از تایید عضویت','value'=>app('setting')['before_active_msg_pattern_sms']??''])
                                                @slot("variable")
                                                    <a href="javascript:void(0)" class="text-decoration-none">#fullname#</a>
                                                @endslot
                                            @endcomponent
                                            @component($prefix_component."textarea_variable",['name'=>'after_active_msg_sms','title'=>'ارسال پیامک فراموشی رمز عبور کاربران','value'=>app('setting')['after_active_msg_sms']??''])
                                                @slot("variable")
                                                    <a href="javascript:void(0)" class="text-decoration-none">#fullname#</a>
                                                    <a href="javascript:void(0)" class="text-decoration-none">#code#</a>
                                                @endslot
                                            @endcomponent
                                            @component($prefix_component."button",['title'=>'ارسال'])@endcomponent
                                        @endslot
                                    @endcomponent
                                @endslot
                                @slot("tabContent6")
                                    @component($prefix_component."form",["action"=>route('admin.setting.store')])
                                        @slot("content")
                                            @component($prefix_component."input",['name'=>"address_email",'title'=>"آدرس ایمیل smtp",'value'=>app('setting')["address_email"] ?? "",'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."input",['name'=>"address_user_name_email",'title'=>"شناسه کاربری",'value'=>app('setting')["address_user_name_email"] ?? "",'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."input",['name'=>"address_password_email",'title'=>"رمز عبور",'value'=>app('setting')["address_password_email"] ?? "",'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."card",["title"=>"ایمیل تغییر رمز عبور"])
                                                @slot("card_content")
                                                    @component($prefix_component."input",['name'=>"title_change_password_email",'title'=>"عنوان",'value'=>app('setting')["title_change_password_email"] ?? "",'class'=>'w-50'])@endcomponent
                                                    @component($prefix_component."textarea_variable",['name'=>'change_password_email','title'=>'پترن تغییر رمز عبور','value'=>app('setting')['change_password_email']??''])
                                                        @slot("variable")
                                                            <a href="javascript:void(0)" class="text-decoration-none">#code#</a>
                                                            <a href="javascript:void(0)" class="text-decoration-none">#email#</a>
                                                            <a href="javascript:void(0)" class="text-decoration-none">#new_password#</a>
                                                            <a href="javascript:void(0)" class="text-decoration-none">#name#</a>
                                                            <a href="javascript:void(0)" class="text-decoration-none">#lastname#</a>
                                                        @endslot
                                                    @endcomponent
                                                @endslot
                                            @endcomponent
                                            @component($prefix_component."card",["title"=>"ایمیل تایید عضویت"])
                                                @slot("card_content")
                                                    @component($prefix_component."input",['name'=>"title_active_password_email",'title'=>"عنوان",'value'=>app('setting')["title_active_password_email"] ?? "",'class'=>'w-50'])@endcomponent
                                                    @component($prefix_component."textarea_variable",['name'=>'active_password_email','title'=>'پترن ایمیل تایید عضویت','value'=>app('setting')['active_password_email']??''])
                                                        @slot("variable")
                                                            <a href="javascript:void(0)" class="text-decoration-none">#email#</a>
                                                            <a href="javascript:void(0)" class="text-decoration-none">#name#</a>
                                                            <a href="javascript:void(0)" class="text-decoration-none">#lastname#</a>
                                                            <a href="javascript:void(0)" class="text-decoration-none">#password#</a>
                                                            <a href="javascript:void(0)" class="text-decoration-none">#site_url#</a>
                                                            <a href="javascript:void(0)" class="text-decoration-none">#code#</a>
                                                        @endslot
                                                    @endcomponent
                                                @endslot
                                            @endcomponent
                                            @component($prefix_component."card",["title"=>"ایمیل فراموش کردن رمز عبور کاربران"])
                                                @slot("card_content")
                                                    @component($prefix_component."input",['name'=>"title_forgot_password_email",'title'=>"عنوان",'value'=>app('setting')["title_forgot_password_email"] ?? "",'class'=>'w-50'])@endcomponent
                                                    @component($prefix_component."textarea_variable",['name'=>'forgot_password_email','title'=>'پترن ایمیل فراموش کردن رمز عبور کاربران','value'=>app('setting')['forgot_password_email']??''])
                                                        @slot("variable")
                                                            <a href="javascript:void(0)" class="text-decoration-none">#email#</a>
                                                            <a href="javascript:void(0)" class="text-decoration-none">#name#</a>
                                                            <a href="javascript:void(0)" class="text-decoration-none">#password#</a>
                                                            <a href="javascript:void(0)" class="text-decoration-none">#site_url#</a>
                                                        @endslot
                                                    @endcomponent
                                                @endslot
                                            @endcomponent
                                            @component($prefix_component."card",["title"=>"ایمیل پس از تایید عضویت"])
                                                @slot("card_content")
                                                    @component($prefix_component."input",['name'=>"title_before_password_email",'title'=>"عنوان",'value'=>app('setting')["title_before_password_email"] ?? "",'class'=>'w-50'])@endcomponent
                                                    @component($prefix_component."textarea_variable",['name'=>'before_password_email','title'=>'پترن ایمیل پس از تایید عضویت','value'=>app('setting')['before_password_email']??''])
                                                        @slot("variable")
                                                            <a href="javascript:void(0)" class="text-decoration-none">#email#</a>
                                                            <a href="javascript:void(0)" class="text-decoration-none">#name#</a>
                                                            <a href="javascript:void(0)"class="text-decoration-none">#password#</a>
                                                            <a href="javascript:void(0)" class="text-decoration-none">#site_url#</a>
                                                        @endslot
                                                    @endcomponent
                                                @endslot
                                            @endcomponent
                                            @component($prefix_component."card",["title"=>"ایمیل ارسال به دوستان"])
                                                @slot("card_content")
                                                    @component($prefix_component."input",['name'=>"title_share_to_friend",'title'=>"عنوان",'value'=>app('setting')["title_share_to_friend"] ?? "",'class'=>'w-50'])@endcomponent
                                                    @component($prefix_component."textarea_variable",['name'=>'title_share_to_friend','title'=>'پترن ایمیل ارسال به دوستان','value'=>app('setting')['title_share_to_friend']??''])
                                                        @slot("variable")
                                                            <a href="javascript:void(0)" class="text-decoration-none">#email#</a>
                                                            <a href="javascript:void(0)" class="text-decoration-none">#site_url#</a>
                                                        @endslot
                                                    @endcomponent
                                                @endslot
                                            @endcomponent
                                            @component($prefix_component."button",['title'=>'ارسال'])@endcomponent
                                        @endslot
                                    @endcomponent
                                @endslot
                            @endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

