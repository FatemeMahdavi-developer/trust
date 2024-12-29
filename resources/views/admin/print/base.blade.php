<!DOCTYPE html>
<html>
<head>
    <title>{{app('setting')['site_title'] ?? ''}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="robots" content="noindex,nofollow">
    <link rel="stylesheet" href="{{asset("admin/assets/css/app.min.css")}}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset("admin/assets/css/style.css")}}">
    <link rel="stylesheet" href="{{asset("admin/assets/boundles/pretty-checkbox/pretty-checkbox.min.css")}}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{asset("admin/assets/css/custom.css")}}">
    <script src="{{asset("admin/assets/js/app.min.js")}}"></script>
</head>
<body onload="window.print();">
    <div style="width:700px;margin:auto;">
         @yield("content")
    </div>
</body>
<script src="{{asset("admin/assets/js/app.min.js")}}"></script>
<script src="{{asset("admin/assets/js/scripts.js")}}"></script>
<script src="{{asset("admin/assets/js/custom.js")}}"></script>
</html>
