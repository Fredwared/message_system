<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="zh-cn" xml:lang="zh-cn">
<head>
    <title>多用户留言系统</title>
    <link rel="stylesheet" type="text/css" href="/css/moodle.css" />
    <link rel="stylesheet" type="text/css" href="/css/moodle2.css" />
    <link rel="stylesheet" type="text/css" href="/css/pagestyle.css" />
    <script type="text/javascript" src="/js/script.js"></script>
    <script type="text/javascript" src="/js/jquery-3.2.1.js"></script>
    <style>
       
        .pagination>li{margin-left:20px;float:left;list-style:none;position:relative;left:25%;bottom:15px;}
    </style>
</head>
 
<body  class="login course-1 notloggedin dir-ltr lang-zh_cn_utf8" id="login-index"> 
    <div id="page">
        <div id="header" class="clearfix"> 
            <h1 class="headermain">多用户留言系统</h1> 
            <div class="headermenu">
                <div class="logininfo">

                @if(session('user'))
                    欢迎您，{{session('user')}}！ | <a href="{{url('msg/user/logout')}}">注销</a> | <a href="{{url('msg/user/resetpwd')}}">重置密码</a>
                @else
                    您尚未登录(<a  href='{{url("msg/user/login")}}'>登录</a>)&nbsp;
                    还没有用户名(<a href='{{url("msg/user/register")}}'>注册</a>)
                @endif
                </div>
            </div> 
        </div>      

        <!-- 面包屑（即“留言板->登录”之类的内容）-->
        <div class="navbar clearfix"> 
            <div class="breadcrumb"> 
                <ul> 
                    <li class="first"><a href="{{url('msg/msg')}}">多用户留言系统</a></li>
                    <!-- <li> <span class="arrow sep">&#x25BA;</span></li> -->
                </ul>
            </div>          
        </div> 

        <!-- START OF CONTENT --> 
        <div id="content">
            @yield('content')
        </div> 
        <!-- END OF CONTENT --> 

        
        <!-- START OF FOOTER -->
        <div id="footer">
            &copy;2018
        </div>
        <!-- END OF FOOTER -->
    </div>
</body>
</html>






