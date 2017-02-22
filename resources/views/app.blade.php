<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Blog</title>
  <link href="/css/bootstrap.css" rel="stylesheet">
	<link href="/css/font-awesome.min.css" rel="stylesheet">
  <link href="/css/style_v1.css" rel="stylesheet">
	<link href="/css/jquery.Jcrop.css" rel="stylesheet">
  <script src="/js/jquery-3.1.1.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/jquery.form.js"></script>
  <script src="/js/jquery.Jcrop.js"></script>
  <script src="/js/avatar.js"></script>
  <script src="/js/vue.js"></script>
  <script src="/js/vue-resource.js"></script>
  <meta id="token" name="token" value="{{ csrf_token() }}">
</head>
<body>
	<nav class="navbar navbar-default navbar-static-top navbar-wrap" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Blog</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/">首页</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          @if (Auth::check())
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuDivider">
                <li><a href="/user/avatar"><i class="fa fa-user"></i> 更换头像</a></li>
                <li><a href=""><i class="fa fa-cog"></i> 更换密码</a></li>
                <li><a href=""><i class="fa fa-heart"></i> 特别感谢</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/user/logout"><i class="fa fa-sign-out"></i> 退出登录</a></li>
              </ul>
            </li>
            <li><a href="#" class="nav-avatar-info"><img src="{{ Auth::user()->avatar }}" class="img-circle" width="50"></a></li>
          @else
            <li><a href="/user/login">登录</a></li>
            <li><a href="/user/register">注册</a></li>
          @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	@yield('content')
</body>
</html>