<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="robots" content="noindex,nofollow">
    <link rel="stylesheet" href="">
    <style>
        body {
            direction: rtl !important;
            margin-bottom: 30px;
        }

        .prints {
            width: 600px;
            margin: auto;
            text-align: right;
            border: 1px solid #ddd;
            padding: 5px 0;
        }
         h1{
            line-height: 30px !important;
            color: #000000 !important;
            font-size: 31px !important;
            font-weight: 700 !important;
        }
    </style>
    <link rel="stylesheet" href="{{asset('site/assets/css/libs/bootstrap.rtl.min.css')}}" >
    <link rel="stylesheet" href="{{asset('site/assets/css/inner-style.css')}}" >
</head>
<body onload="window.print();">
    <div class="prints">
        @yield('content')
    </div>
</body>
</html>
