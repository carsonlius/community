
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    {{--<link rel="icon" href="../../favicon.ico">--}}

    <title>欢迎来到laravel社区</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css?v=1.13" rel="stylesheet">
    <link href="/css/jquery.Jcrop.min.css?v=1.01" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/ie-emulation-modes-warning.js"></script>
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="/js/jquery.form.js?version=1.01"></script>
    <script src="/js/jquery.Jcrop.min.js?version=1.01"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body {
            min-height: 2000px;
            padding-top: 70px;
        }
    </style>
</head>

<body>

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top navbar ">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">{{ env('APP_NAME') }}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse navbar" style="margin-bottom: 0px">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">首页</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            @if(\Auth::check())
                    <li style="">
                        <img src="{{ \Auth::user()->avatar }}" style="width: 24px;height: 24px;margin-top: 50%" alt="" id="avatar-login">
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="/user/showAvatar"><i class="icon-user"></i> 更换头像</a></li>
                            <li><a href="#"><i class="icon-lock"></i> 更换密码</a></li>
                            <li><a href="#"><i class="icon-heart"></i> 特别感谢</a></li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="javascript:void(0);" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="icon-signout"></i> 退出登录</a>
                                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>

            @else
                 <li><a href="/login">登录</a></li>
                 <li><a href="/user/register">注册</a></li>
            @endif
            </ul>
            {{-- 登录返回之前浏览的页面, --}}
            @if (!\Auth::check() && strpos(\Request::getRequestUri(), 'discussions')!==false)
                {!! \Session::put('redirect_url', \Request::getRequestUri()) !!}
            @endif

        </div><!--/.nav-collapse -->
    </div>
</nav>

@yield('content')


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
