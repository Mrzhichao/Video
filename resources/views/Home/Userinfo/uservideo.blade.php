<!DOCTYPE html>
<html>

   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

      <title>个人资料</title>
      <link rel="stylesheet" href="{{url('Home/css/screen.css')}}">
      <link href="{{ asset('/userinfo/AmazeUI-2.4.2/assets/css/admin.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ asset('/userinfo/AmazeUI-2.4.2/assets/css/amazeui.css') }}" rel="stylesheet" type="text/css">

      <link href="{{ asset('/userinfo/css/personal.css')}}" rel="stylesheet" type="text/css">
      <link href="{{ asset('/userinfo/css/infstyle.css')}}" rel="stylesheet" type="text/css">
      <script src="{{ asset('userinfo/AmazeUI-2.4.2/assets/js/jquery.min.js') }}" type="text/javascript'"></script>
      <script src="{{ asset('userinfo/AmazeUI-2.4.2/assets/js/amazeui.js') }}" type="text/javascript"></script>

      <link href="{{url('Home/css/bootstrap.css')}}" rel="stylesheet">
      
      <link rel="stylesheet" href="{{url('Home/css/animation.css')}}">
      <link rel="stylesheet" href="{{url('Home/css/shutter.css')}}">
      <link rel="stylesheet" type="text/css" href="{{url('hivideo/assets/hivideo.css')}}">
      <link rel="stylesheet" href="{{url('Home/css/font-awesome.css')}}">
      <link href="{{url('Home/css/lity.css')}}" rel="stylesheet">
   </head>

   <body>
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
          <li><a href="{{url('home/index')}}">首页</a></li>
            @foreach($nav as $k=>$v)
            <li><a href="{{$v->resourceSrc}}/{{$v->pid}}">{{$v->nname}}</a></li>
            @endforeach
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

      <div class="center">
         <div class="col-main">
            <div class="main-wrap">

               <div class="user-info">
                  <!--标题 -->
                  <div class="am-cf am-padding">
                     <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">播放记录</strong> </div>
                  </div>
                  <hr/>

                  <!--头像 -->
                  <form class="am-form am-form-horizontal" action="" method="post" enctype="multipart/form-data">

                   
                     
                  <!--个人信息 -->
                  <div class="info-main">
                     

                     </form>
                  </div>

               </div>

            </div>
               <!-- //底部 -->
         </div>

         <aside class="menu">
            <ul>
               <li class="person">
                  <a href="javascript:;">个人中心</a>
               </li>
               <li class="person">
                  <a href="javascript:;">个人资料</a>
                  <ul>
                     <li class="active"> <a href="{{url('home/userinfo')}}">个人信息</a></li>
                     <li> <a href="{{url('home/video/add')}}">上传视频</a></li>
                     <li> <a href="{{url('home/uservideo')}}">播放记录</a></li>
                     <li> <a href="address.html">订阅</a></li>
                     <li> <a href="address.html">我的消息 </a></li>
                  </ul>
               </li>
              
               

            </ul>

         </aside>
      </div>

      <script type="text/javascript">

         //提示信息消失
        
        $("#msg").fadeOut(6000, 'linear' ,function(){
  
        });

      </script>

   </body>

</html>