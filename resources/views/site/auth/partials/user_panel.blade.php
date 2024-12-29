<div class="col-side-bar-menu">
    <div class="user-data-box">
        <div class="image-box">
            <img src="{{asset('site/assets/image/user.png')}}">
        </div>
        <div class="content-box">
            <div class="name-family">{{auth()->user()->fullname}}</div>
            <div class="des">{{__("msg.panel.welcome")}}</div>
        </div>
    </div>
    <ul class="menu">
        <li><a href="{{route('user.panel')}}" @if(str_contains($view_name,"-user-panel"))class="active"@endif><i class="fi fi-rr-apps icon"></i>{{__("msg.panel.dashbord")}}</a></li>
        <li><a href="#"><i class="fi fi-rr-heart icon"></i>{{__("msg.panel.favorites_list")}}</a></li>
        <li><a href="{{route('user.comment')}}" @if(str_contains($view_name,"-user-comment"))class="active"@endif><i class="fi fi-rr-comment icon"></i> {{__("msg.panel.comment")}}</a></li>
        <li><a href="#" data-bs-toggle="modal" data-bs-target="#change-password"><i class="fi fi-rr-edit icon"></i>{{__("msg.panel.change_password")}}</a></li>
        <li><a href="{{route('user.logout')}}" class="sign-out"><i class="fi fi-rr-sign-out icon"></i> {{__("msg.panel.logout")}}</a></li>
    </ul>
</div>
