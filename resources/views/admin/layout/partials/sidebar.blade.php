<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand" style="height:40px">
            {{-- <a href="javascript:void(0)"> 
                <img alt="تصویر" src="{{asset("admin/assets/img/logo.png")}}" class="header-logo"> 
                <span class="logo-name">اجیس</span>
            </a> --}}
        </div>

        {{-- <div class="sidebar-user">
            <div class="sidebar-user-picture">
                @if(auth()->user()->pic)
                <img alt="{{auth()->user()->fullname}}" src="{{asset("upload/thumb1/".auth()->user()->pic)}}">
                @else
                <img src="{{asset("admin/assets/img/userbig.jpg")}}"  style="border: 1px solid #ddd">
                @endif
            </div>
            <div class="sidebar-user-details">
                <div class="user-name">{{auth()->user()->fullname}}</div>
                @if(auth()->user()->id=='1')
                    <div class="user-role">دسترسی کل</div>
                @else
                    <div class="user-role">{{auth()->user()->role['title']}}</div>
                @endif
            </div>
        </div> --}}
        <ul class="sidebar-menu">
            {{-- <li class="menu-header">آمار و گزارشات</li> --}}
            @if(auth()->user()->id=='1')
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-v"></i><span>تنظیمات</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'setting')) d-block @endif">
                    <li><a class="nav-link" href="{{route("admin.setting")}}">تنظیمات اصلی</a></li>
                </ul>
            </li>
            @endif
            @canany(permission_access("role"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-shield"></i><span>گروه دسترسی مدیران</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'role')) d-block @endif">
                    @can("create_role")
                    <li><a class="nav-link" href="{{route('admin.role.create')}}">گروه دسترسی جدید</a></li>
                    @endcan
                    @can("read_role")
                    <li><a class="nav-link" href="{{route('admin.role.index')}}">لیست گروه دسترسی</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(permission_access("manager"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-friends"></i><span>مدیران</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'manager')) d-block @endif">
                    @can("create_manager")
                    <li><a class="nav-link" href="{{route("admin.manager.create")}}">مدیر جدید</a></li>
                    @endcan
                    @can("read_manager")
                        <li><a class="nav-link" href="{{route("admin.manager.index")}}">لیست مدیران</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(permission_access("contactmap"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-map-marker-alt"></i><span>محل شما روی نقشه</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'contactmap')) d-block @endif">
                    @can("update_contactmap")
                    <li><a class="nav-link" href="{{route("admin.contactmap.edit")}}">لوکیشن</a></li> 
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(permission_access("message"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-phone"></i><span>تماس با ما</span></a>
                <ul class="dropdown-menu">
                    @can("create_message_cat")
                        <li><a class="nav-link" href="{{route("admin.message_cat.create")}}">دسته بندی جدید</a></li>
                    @endcan
                    @can("read_message_cat")
                    <li><a class="nav-link" href="{{route("admin.message_cat.index")}}">لیست دسته بندی ها</a></li>
                    @endcan
                    @can("read_message")
                    <li><a class="nav-link" href="{{route("admin.message.index")}}">لیست پیام ها</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(permission_access("banner"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-images"></i><span>بنر</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'banner')) d-block @endif">
                    @can("create_banner")
                    <li><a class="nav-link" href="{{route("admin.banner.create")}}">بنر جدید</a></li>
                    @endcan
                    @can("read_banner")
                    <li><a class="nav-link" href="{{route("admin.banner.index")}}">لیست بنر ها</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(permission_access("user"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-edit"></i><span>کاربران</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'user')) d-block @endif">
                    @can("read_user")
                    <li><a class="nav-link" href="{{route("admin.user.index")}}">لیست کاربران</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(permission_access("menu"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-list-ul"></i><span>منو</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'menu')) d-block @endif">
                    @can("create_menu")
                    <li><a class="nav-link" href="{{route("admin.menu.create")}}">منو جدید</a></li>
                    @endcan
                    @can("read_menu")
                    <li><a class="nav-link" href="{{route("admin.menu.index")}}">لیست منو ها</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(permission_access("page"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-list-alt"></i><span>صفحات</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'page')) d-block @endif">
                    @can("create_page")
                    <li><a class="nav-link" href="{{route("admin.page.create")}}">صفحه جدید</a></li>
                    @endcan
                    @can("read_page")
                    <li><a class="nav-link" href="{{route("admin.page.index")}}">لیست صفحه ها</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(permission_access("news_cat"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-copy"></i><span>دسته بندی اخبار</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'news_cat')) d-block @endif">
                    @can("create_news_cat")
                        <li><a class="nav-link" href="{{route("admin.news_cat.create")}}">دسته بندی اخبار جدید</a></li>
                    @endcan
                    @can("read_news_cat")
                        <li><a class="nav-link" href="{{route("admin.news_cat.index")}}">لیست دسته بندی اخبار</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(permission_access("news"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-edit"></i><span>اخبار</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'news')) d-block @endif">
                    @can("create_news")
                        <li><a class="nav-link" href="{{route("admin.news.create")}}">اخبار جدید</a></li>
                    @endcan
                    @can("read_news")
                        <li><a class="nav-link" href="{{route("admin.news.index")}}">لیست اخبار</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(permission_access("comment"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-comment-dots"></i><span>نظرات</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'comment')) d-block @endif">
                    @can("read_comment")
                    <li><a class="nav-link" href="{{route("admin.comment.index")}}">لیست نظرات</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(permission_access("instagram"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fab fa-instagram"></i><span>اینستاگرام</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'instagram')) d-block @endif">
                    @can("create_instagram")
                    <li><a class="nav-link" href="{{route("admin.instagram.create")}}">اینستاگرام جدید</a></li>
                    @endcan
                    @can("read_instagram")
                    <li><a class="nav-link" href="{{route("admin.instagram.index")}}">لیست اینستاگرام</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(permission_access("product_cat"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-layer-group"></i><span>دسته بندی محصولات</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'product_cat')) d-block @endif">
                    @can("create_product_cat")
                    <li><a class="nav-link" href="{{route("admin.product_cat.create")}}">دسته بندی محصول جدید</a></li>
                    @endcan
                    @can("read_product_cat")
                    <li><a class="nav-link" href="{{route("admin.product_cat.index")}}">لیست دسته بندی محصولات</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(permission_access("product"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-clipboard-list"></i><span> محصولات</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'product')) d-block @endif">
                    @can("create_product")
                    <li><a class="nav-link" href="{{route("admin.product.create")}}">محصول جدید</a></li>
                    @endcan
                    @can("read_product")
                    <li><a class="nav-link" href="{{route("admin.product.index")}}">لیست محصولات</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(permission_access("photo_cat"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-images"></i><span>دسته بندی تصاویر</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'photo_cat')) d-block @endif">
                    @can("create_photo_cat")
                        <li><a class="nav-link" href="{{route("admin.photo_cat.create")}}">دسته بندی جدید تصویر</a></li>
                    @endcan
                    @can("read_photo_cat")
                        <li><a class="nav-link" href="{{route("admin.photo_cat.index")}}">لیست دسته بندی تصاویر</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(permission_access("photo"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-image"></i><span>تصاویر</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'photo')) d-block @endif">
                    @can("create_photo")
                        <li><a class="nav-link" href="{{route("admin.photo.create")}}">تصویر جدید </a></li>
                    @endcan
                    @can("read_photo")
                        <li><a class="nav-link" href="{{route("admin.photo.index")}}">لیست تصاویر </a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(permission_access("video_cat"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-video"></i><span>دسته بندی ویدیو</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'video_cat')) d-block @endif">
                    @can("create_video_cat")
                        <li><a class="nav-link" href="{{route("admin.video_cat.create")}}">دسته بندی جدید </a></li>
                    @endcan
                    @can("read_video_cat")
                        <li><a class="nav-link" href="{{route("admin.video_cat.index")}}">لیست دسته بندی ویدیوها </a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(permission_access("video"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-video"></i><span>ویدیو ها</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'video')) d-block @endif">
                    @can("create_video")
                        <li><a class="nav-link" href="{{route("admin.video.create")}}">ویدیو جدید</a></li>
                    @endcan
                    @can("read_video")
                        <li><a class="nav-link" href="{{route("admin.video.index")}}">لیست ویدیوها </a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(permission_access("employment_section"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-video"></i><span>بخش استخدام</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'employment_section')) d-block @endif">
                    @can("create_employment_section")
                        <li><a class="nav-link" href="{{route("admin.employment_section.create")}}">بخش جدید</a></li>
                    @endcan
                    @can("read_employment_section")
                        <li><a class="nav-link" href="{{route("admin.employment_section.index")}}">لیست بخش های استخدام </a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(permission_access("employment"))
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-video"></i><span>استخدام</span></a>
                <ul class="dropdown-menu @if(str_contains(request()->route()->getName(),'employment')) d-block @endif">
                    @can("read_employment")
                        <li><a class="nav-link" href="{{route("admin.employment.index")}}">لیست استخدام </a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
        </ul>
    </aside>
</div>
