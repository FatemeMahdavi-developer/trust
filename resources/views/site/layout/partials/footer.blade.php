<div class="container-fluid container-footer">
    <div class="container-custom">
        <div class="row">
            <div class="col">
                <div class="row row-logo-social">
                    <div class="col-12 col-sm-12 col-md-5 col-xl-5 col-logo">
                        <a href="{{asset("/")}}"><img src="{{asset('site/assets/image/logoo.png')}}" alt="" /></a>
                    </div>

                    <div class="col-12 col-sm-12 col-md-7 col-xl-7 col-social">
                        <span class="title">ما را دنبال کنید</span>
                        <ul>
                            <li><a href="#"><i class="fi fi-brands-twitter icon"></i></a></li>
                            <li><a href="#"><i class="fi fi-brands-linkedin icon"></i></a></li>
                            <li><a href="#"><i class="fi fi-brands-instagram icon"></i></a></li>
                            <li><a href="#"><i class="fi fi-brands-facebook icon"></i></a></li>
                            <li><a href="#"><i class="fi fi-brands-telegram icon"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-4 col-md-3 col-xl-4 col-contact-data">
                        <div class="col-title">اطلاعات تماس</div>
                        <ul>
                            <li>آدرس: تهران ، بلوار آفریقا ( جردن ) ، خیابان دستگردی ، ساختمان یاس ، طبقه دو</li>
                            <li>تلفن تماس: <a href="tel:+982122334455" class="tel">22334455-021</a></li>
                            <li>ایمیل: <a href="mailto:info@cotton.ir">info@cotton.ir</a></li>
                            <li><a href="mailto:info@cotton.ir"><img src="{{asset('site/assets/image/waze.png')}}" alt="" /> مسیریابی با waze</a></li>
                        </ul>
                    </div>

                    @if(isset($footer_menu) && !empty($footer_menu))
                    @foreach($footer_menu as $item)
                    <div class="col-6 col-sm-4 col-md-3 col-xl-2 col-links">
                        <div class="col-title">{{$item->title}}</div>
                        @if($item->sub_menus_site->count())
                        <ul>
                            @foreach($item->sub_menus_site as $item2) 
                            <li><a href="{{$item2->link}}" {{OpenNeweTab($item2['link'],$item['open_type'])}} >{{$item2->title}}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    @endforeach
                    @endif

                    <div class="col-12 col-sm-12 col-md-3 col-xl-4 col-newsletter">
                        <div class="col-title">عضویت در خبرنامه</div>
                        <form class="form-newsletter-mail">
                            <input type="text" placeholder="آدرس ایمیل خود را وارد کنید" />
                            <button type="button" class=""><i class="fi fi-rr-angle-left"></i></button>
                        </form>

                        <form class="form-newsletter-mobile">
                            <input type="text" placeholder="شماره همراه خود را وارد کنید" />
                            <button type="button" class=""><i class="fi fi-rr-angle-left"></i></button>
                        </form>
                    </div>
                </div>

                <div class="copy-right-designer">
                    <div class="designer">
                        <a href="#"><img src="{{asset('site/assets/image/hamed.png')}}" alt="" /></a>
                        <div class="designer-des"><a href="">طراحی سایت</a> و <a href="">برنامه نویسی</a>: <a href="">حامد پردازش</a></div>
                    </div>
                    <div class="copy-right"><a href="https://www.cotton.ir">www.cotton.ir</a> - Copyright © 2022 - All rights reserved.</div>
                </div>
            </div>
        </div>
    </div>
</div>
