<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
                    <i data-feather="align-justify"></i>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link nav-link-lg fullscreen-btn">
                    <i data-feather="maximize"></i>
                </a>
            </li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg nav-link-use">
                @if(auth()->user()->pic)
                <img src="{{asset("upload/thumb2/".auth()->user()->pic)}}" class="user-img-radious-style">
                @else
                <img src="{{asset("admin/assets/img/user.jpg")}}" class="user-img-radious-style" style="border: 1px solid #acacac">
                @endif
            </a>
          <div class="dropdown-menu  dropdown-menu-right pullDown" style="width:100px">
                <a href="{{route("admin.auth.logout")}}" class="dropdown-item has-icon text-danger">
                     <i class="fas fa-sign-out-alt"></i>
                  خروج
                </a>
          </div>
        </li>
    </ul>
</nav>
