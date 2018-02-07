
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

    <title>欢迎来到社区</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

    <![endif]-->
    <style>
        body {
            min-height: 2000px;
            padding-top: 70px;
        }
    </style>
</head>
<body>
    <h1>Hello Confirm Your Email</h1>
    <a href="{{ url('verify/' . $confirm_code) }}"> Click To Confirm</a>




</body>
</html>
