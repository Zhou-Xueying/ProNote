<!DOCTYPE html>
<html lang="zh-CN"><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://v3.bootcss.com/favicon.ico">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('/static/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    {{--<link href="{{ URL::asset('/static/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">--}}
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <!--<script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>-->
    <!--<script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>-->
    <!--[endif]-->

    {{--<link href='http://designmodo.github.io/Flat-UI/dist/css/flat-ui.min.css' rel="stylesheet">--}}
    <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' rel="stylesheet">
    <link href='https://daneden.github.io/animate.css/animate.min.css' rel="stylesheet">

    @yield('css_extra_file')

</head>

<body>

@include('common/header')

<div class="content container" style="margin-top: 65px;margin-bottom: 60px;">
    @yield('content')
</div>

@include('common/footer')

<!-- Bootstrap core JavaScript-->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ URL::asset('/static/jquery/jquery.js')}}" type="text/javascript"></script>
<script>window.jQuery || document.write('<script src="{{URL::asset('/static/jquery/jquery.js')}}"><\/script>')</script>
<script src="{{ URL::asset('/static/bootstrap/js/bootstrap.js')}}"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
{{--<script src="{{ URL::asset('/static/js/ie10-viewport-bug-workaround.js') }}"></script>--}}

@yield('js_extra_text')

</body>
</html>