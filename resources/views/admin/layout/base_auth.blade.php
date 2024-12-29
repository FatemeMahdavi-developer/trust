<!DOCTYPE html>
<html lang="en">
<head>
    @include("admin.layout.partials.auth.head")
    <title>@yield("title")</title>
    @yield("head")
</head>
<body>
    <div id="app">
        @yield("content")
    </div>
    @include("admin.layout.partials.auth.footer")
    @yield("footer")
</body>
</html>
