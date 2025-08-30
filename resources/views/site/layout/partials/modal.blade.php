<div class="offcanvas offcanvas-start mobile-side-menu" tabindex="-1" id="mobile-side-menu">
    <div class="offcanvas-header">
        <div class="offcanvas-title">منو موبایل</div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav-links">
            <li><a href="#">صفحه اصلی</a></li>
            <li><a href="#">درباره ما</a></li>
            <li><a href="#">تماس با ما</a></li>

            <li>
                <a class="nav-dropdown-toggle" href="#">محصولات</a>
                <ul>
                    <li><a href="#">گروه محصول ۱</a></li>
                    <li><a href="#">گروه محصول ۲</a></li>

                    <li>
                        <a class="nav-dropdown-toggle" href="#">گروه محصول ۳</a>

                        <ul>
                            <li><a href="#">گروه محصول ۳ - زیر گروه ۱</a></li>
                            <li><a href="#">گروه محصول ۳ - زیر گروه ۲</a></li>
                            <li><a href="#">گروه محصول ۳ - زیر گروه ۳</a></li>

                            <li>
                                <a class="nav-dropdown-toggle" href="#">گروه محصول ۳ - زیر گروه ۴</a>

                                <ul>
                                    <li><a href="#">گروه ۱</a></li>
                                    <li><a href="#">گروه ۲</a></li>
                                    <li><a href="#">گروه ۳</a></li>
                                </ul>
                            </li>

                            <li><a href="#">گروه محصول ۳ - زیر گروه ۵</a></li>
                        </ul>
                    </li>

                    <li><a href="#">گروه محصول ۴</a></li>
                </ul>
            </li>

            <li><a href="#">بلاگ</a></li>
        </ul>
    </div>
</div>

<div class="modal fade modal-video" id="modal-video" tabindex="-1" aria-labelledby="modal-video" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">پخش ویدئو</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <video controls preload="none" poster="{{asset('site/assets/image/home-about-video-poster.jpg')}}">
                    <source src="{{asset('site/assets/video/about-us.mp4')}}" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</div>


@auth
    <div class="modal fade change-password" id="change-password" tabindex="-1" aria-labelledby="change-password"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">بازیابی رمز عبور</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('user.change_pass')}}" method="post" class="form form_change_pass">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="input-box">
                                    <label for="form-comment-message">رمز قبلی</label>
                                    <input type="text" name="before_password" class="form-control">
                                </div>
                                <div class="input-box">
                                    <label for="form-comment-message">رمز جدید</label>
                                    <input type="text" name="new_password" class="form-control">
                                </div>
                                <div class="input-box">
                                    <label for="form-comment-message">تکرار رمز جدید</label>
                                    <input type="text" name="new_password_confirmation" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-custom-cancel" data-bs-dismiss="modal">انصراف و بازگشت</button>
                        <button type="submit" class="btn-custom change_passes">تغییر رمز</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endauth
