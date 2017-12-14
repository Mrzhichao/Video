@section('head')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="OrcasThemes">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<title>@yield('title')</title>

<link rel="stylesheet" href="{{asset('Home/common/css/style.css')}}">
<link rel="stylesheet" href="{{asset('Home/common/css/comment.css')}}">

<!-- Bootstrap core CSS -->
<link href="{{url('Home/css/bootstrap.css')}}" rel="stylesheet">
<!-- Custom styles for this template -->
<link rel="stylesheet" href="{{url('Home/css/screen.css')}}">
<link rel="stylesheet" href="{{url('Home/css/animation.css')}}">
<link rel="stylesheet" href="{{url('Home/css/shutter.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('hivideo/assets/hivideo.css')}}">
<!--[if IE 7]>

<![endif]-->
<link rel="stylesheet" href="{{url('Home/css/font-awesome.css')}}">
<!--[if lt IE 8]>
<link rel="stylesheet" href="/Home/css/ie.css" type="text/css" media="screen, projection">
<![endif]-->
<link href="{{url('Home/css/lity.css')}}" rel="stylesheet">

<!-- <link href="{{asset('Home/css/lity.css')}}" rel="stylesheet"> -->
<link rel="stylesheet" id="main-css" href="http://www.ff6.wang/static/style.css" type="text/css" media="all">
<link rel="stylesheet" href="{{ asset('Home/jd/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('Home/jd/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('Home/jd/css/style.css') }}"> 

<script src="{{ asset('Home/jd/js/jquery.min.js') }}"></script>
<script src="{{asset('Layer/layer.js')}}"></script>

<script type="text/javascript" src="{{asset('Home/common/js/jquery-1.12.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('Home/common/js/jquery.flexText.js')}}"></script>

</head>
@show

<body>
@section('menu')
 <!-- MENU -->
 <div class="row home-mega-menu " >
   <div class="col-md-12">
      <nav class="navbar navbar-default">
        <div class="navbar-header">
          <button class="navbar-toggle" type="button" data-toggle="collaps.e" data-target=".js-navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse js-navbar-collapse megabg dropshd " >
          <ul class="nav navbar-nav">
          <li><a href="{{url('/')}}">首页</a></li>
            @foreach($nav as $k=>$v)
            <li><a href="{{$v->resourceSrc}}?pid={{$v->pid}}">{{$v->nname}}</a></li>
            @endforeach
            <li><a href="{{url('home/video/status')}}">视频搜索页</a></li>
            <li><a href="contact.html">更多</a></li>
          </ul>
          <ul class="social">
            <li class="social-facebook"><a href="#" class="fa fa-upload social-icons"></a></li>
            <li class="social-google-plus"><a href="#" class="fa fa-download social-icons"></a></li>
            <li  class="social-youtube" >  <a target="_self" href="http://wpa.qq.com/msgrd?v=3&uin=1239099896&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1239099896:52" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></li>
            <li class="social-youtube"><a href="#" class="fa fa-youtube social-icons"></a></li>
            <li class="social-rss"><a href="{{url('home/userinfo')}}" class="fa fa-user social-icons"></a></li>
          </ul>
          <div class="search-block">
            <form action="{{url('home/search')}}" method="get">
               <input type="search" name="wordskey" placeholder="Search">
            </form>
          </div>
        </div>
        <!-- /.nav-collapse -->
      </nav>
   </div>
 </div>


<!-- 广告 -->
<div style="position: fixed; z-index: 10001; bottom: 0;right:0;" id="ad_rightBottom"><a onclick="document.getElementById('ad_rightBottom').style.display='none'" href="javascript:void(0);" style="position:absolute;top:-15px;left:0;">关闭</a><a target="_blank" href="http://www.jiang.com/?pid=10038"><img src="http://gg.kkcaicai.com:8080/300x250-4.gif"></a></div>

@show



<!-- 头部残余 -->
@yield('content')

@show

<!-- 主题部分 -->
@yield('main')



@show



@section('footer')
<!-- FOOTER -->
<div id="channels-block" class="container-fluid channels-bg">
      <div id="footer" class="container-fluid footer-background">
       <div class="container">
         <footer>
            <!-- SECTION FOOTER -->
            <div class="row">
              <!-- SOCIAL -->
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="row auto-clear">
                  <div class="col-md-12">
                  </div>
                  
                  
                </div>
              </div>
              <!-- TAGS -->
              
              <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12">
                <h2 class="">友情链接</h2>
                <ul class="footer-tags">
                @foreach($link as $v)
                  <li><a title="{{$v->title}}" href="{{$v->link_url}}">{{ $v->link_name }}</a></li>
                @endforeach
                </ul>
              </div>
            
              <!-- LINKS -->
              
            <div class="row copyright-bottom text-center">
              <div class="col-md-8 text-center">
                <a href="" class="footer-logo" title="Video Magazine Bootstrap HTML5 template">
               <img src="/banner-xl.jpg" style="width: 520px; height: 100px;">
                </a>
                </div>
                
            </div>
             <div class="col-md-12 text-center">
                <p>Copyright &copy; 2017.ActiveVideo name All rights reserved.</p>
              </div>
         </footer>
       </div>
      </div>
</div>
<!-- JAVA SCRIPT -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{url('Home/js/jquery-1.12.1.min.js')}}"></script>
<script src="{{url('Home/js/bootstrap.min.js')}}"></script>
<script src="{{url('Home/js/lity.js')}}"></script>
<script src="{{url('Home/js/velocity.js')}}"></script>
<script src="{{url('Home/js/shutter.js')}}"></script>
<script type="text/javascript" src="{{url('hivideo/assets/hivideo.js')}}"></script>
<script>
 $(".nav .dropdown").hover(function() {
   $(this).find(".dropdown-toggle").dropdown("toggle");
 });
</script>
<script>
      $(function () {
        $('.shutter').shutter({
         shutterW: 1200, // 容器宽度
         shutterH: 450, // 容器高度
         isAutoPlay: true, // 是否自动播放
         playInterval: 3000, // 自动播放时间
         curDisplay: 3, // 当前显示页
         fullPage: false // 是否全屏展示
        });
      });
</script>
<!-- MODAL -->
<div id="enquirypopup" class="modal fade in " role="dialog">
 <div class="modal-dialog">
   <!-- Modal content-->
   <div class="modal-content row">
      <div class="modal-header custom-modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h2 class="icon"><i class="fa fa-television" aria-hidden="true"></i>free access</h2>
      </div>
      <div class="modal-body">
        <form name="info_form" class="form-inline" action="#" method="post">
          <div class="form-group col-sm-12">
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
          </div>
          <div class="form-group col-sm-12">
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
          </div>
          <div class="form-group col-sm-12">
            <button class="subscribe-btn pull-right" type="submit" title="Subscribe">Subscribe</button>
          </div>
        </form>
      </div>
   </div>
 </div>
</div>
</body>
</html>
@show
