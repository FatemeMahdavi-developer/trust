<?php

return [
    'module_name' => [
        'news_cat' => 'دسته بندی خبر',
        'news' => 'خبر',
        'content' => 'محتوی',
        'manager' => 'مدیران',
        'permission' => 'گروه دسترسی',
        'comment' => 'نظر',
        'product' => 'محصول',
        'product_cat' => 'دسته بندی محصول',
        'banner' => 'بنر',
        'instagram' => 'اینستاگرام',
        'menu' => 'منو',
        'user'=>'کاربران',
        'page'=>'صفحه',
        'role'=>'سطح دسترسی',
        'setting'=>'تنظیمات',
        'contactmap'=>'نقشه تماس با ما',
        'message_cat'=>'دسته بندی تماس با ما',
        'message'=>'پیام ها',
        'photo_cat' => 'دسته بندی تصویر',
        'photo' => 'تصویر',
        'video_cat' => 'دسته بندی ویدیو',
        'video' => 'ویدیو',
        'employment_section'=>'بخش استخدام',
        'employment'=>'استخدام'
    ],
    'module_name_site' => [
        'news' => 'اخبار',
        'home' => 'پنبه',
        'about' => 'درباره ما',
        'product' => 'محصولات',
        'multimedia' => 'چندرسانه ای',
        'photo' => 'گالری',
        'video' => 'ویدیوها',
        'register' => 'ثبت نام',
        'login' => 'ورود',
        'active' => 'فعال سازی کد عضویت',
        'forgot-password'=>'فراموشی رمز عبور',
        'confirm'=>'رمز یک بار مصرف',
        'change_profile'=>'ویرایش اطلاعات کاربری',
        'panel'=>'پنل کاربری',
        'like'=>'لیست علاقه مندی ها',
        'contact'=>'تماس با ما',
        'employment'=>'استخدام',
    ],
    'crud'=>[
        "create"=>"ایجاد",
        "read"=>"خواندن",
        "update"=>"ویرایش",
        "delete"=>"حذف",
    ],


    'crud_authorize'=>[
        "create"=>["create","store"],
        "read"=>["index","action_all"],
        "update"=>["update","edit"],
        "delete"=>["destroy"],
    ],

];
