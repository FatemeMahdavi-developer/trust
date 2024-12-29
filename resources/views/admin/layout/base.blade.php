<!DOCTYPE html>
<html lang="en">
<head>
    @include("admin.layout.partials.head")
    <title> پنل مدیریت |@yield("title")</title>
    @yield("head")


</head>

<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        @include("admin.layout.partials.navbar")
        @include("admin.layout.partials.sidebar")
        <div class="main-content">
            @yield("content")
            @include("admin.layout.partials.setting_sidebar")
        </div>
    </div>
</div>

@include("admin.layout.partials.footer")
@yield("footer")

</body>
</html>
