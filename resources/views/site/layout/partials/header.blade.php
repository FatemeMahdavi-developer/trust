<div class="container-fluid container-header">
    <div class="container-custom">
        <div class="row">
            <div class="col">
                <header class="page-header">
                    <div class="col-right">
                        <a href="{{asset("/")}}" class="logo"><img src="{{asset('site/assets/image/logoo.png')}}"  @if($site_title) alt="{{$site_title}}" @endif/></a>
                    </div>
                    <div class="col-left">
                        <button class="link-box btn-mobile-menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobile-side-menu" aria-controls="mobile-side-menu"><span class="icon fi fi-rr-menu-burger"></span></button>
                        {{-- <div class="dropdown link-box">
                            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="icon fi fi-rr-world"></span>
                            </button>
                            <ul class="dropdown-menu language-dropdown-menu">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div> --}}
                        <a href="javascript:void(0);" class="link-box" data-bs-toggle="modal" data-bs-target="#modal-search"><span class="icon fi fi-rr-search"></span></a>
                        <div class="dropdown link-box link-box-user">
                            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fi fi-rr-user sign-in-up-icon"></i><span class="sign-in-up-title">ورود | ثبت نام</span></button>
                            <ul class="dropdown-menu">
                                @auth
                                    <li><a class="dropdown-item" href="{{route('user.panel')}}"><i class="fi fi-rr-sign-in icon"></i>پنل کاربری</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{route('auth.login')}}"><i class="fi fi-rr-sign-in icon"></i>ورود</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{route('auth.register')}}"><i class="fi fi-rr-user-add icon"></i>ثبت نام</a></li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </header>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid container-menu">
    <div class="container-custom">
        <div class="row">
            @if(isset($header_menu[0]))
            <div class="col">
                <ul class="menu">
                    @foreach($header_menu as $item)
                    <li class="level-1">
                        <a href="{{$item['link']}}" {{OpenNeweTab($item['link'],$item['open_type'])}}  @if($item->sub_menus_site->count()) class="has-level-2" @endif >{{$item['title']}}</a>
                        @if($item['title']=='محصولات' && $procat_submenu->count())
                            <div class="level-2">
                                <div class="container-fluid">
                                    <div class="container-custom">
                                        <div class="row">
                                            <div class="col">
                                                <div class="col-link">
                                                    <ul class="link-box">
                                                        @foreach($procat_submenu as $submenu1)
                                                        <li><a class="head" href="{{$submenu1['url']}}" >{{$submenu1['title']}}</a></li>
                                                        @if($submenu1->sub_cats_site->count())
                                                            @foreach($submenu1->sub_cats_site as $submenu2)
                                                            <li><a href="{{$submenu2['url']}}" >{{$submenu2['title']}}</a></li>
                                                            @endforeach
                                                        @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col-image">
                                                    <a class="link" href="{{$item['link']}}" {{OpenNeweTab($item['link'],$item['open_type'])}} ><img @if($item['pic']) src="{{asset("upload/thumb1/".$item['pic'])}}" @else src="{{asset("site/img/no_image/no_image(380x380).jpg")}}" @endif alt="{{$item['alt_image']}}" /></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @if($item->sub_menus_site->count())
                            <div class="level-2">
                                <div class="container-fluid">
                                    <div class="container-custom">
                                        <div class="row">
                                            <div class="col">
                                                <div class="col-link">
                                                    <ul class="link-box">
                                                        @foreach($item->sub_menus_site as $item2)
                                                        <li><a class="head" href="{{$item2['link']}}" {{OpenNeweTab($item['link'],$item2['open_type'])}} >{{$item2['title']}}</a></li>
                                                        @if($item2->sub_menus_site->count())
                                                            @foreach($item2->sub_menus_site as $item3)
                                                            <li><a href="{{$item3->link}}" {{OpenNeweTab($item3['link'],$item['open_type'])}} >{{$item3['title']}}</a></li>
                                                            @endforeach
                                                        @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col-image">
                                                    <a class="link" href="{{$item['link']}}" {{OpenNeweTab($item['link'],$item['open_type'])}} ><img @if($item['pic']) src="{{asset("upload/thumb1/".$item['pic'])}}" @else src="{{asset("site/img/no_image/no_image(380x380).jpg")}}" @endif alt="{{$item['alt_image']}}" /></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>
