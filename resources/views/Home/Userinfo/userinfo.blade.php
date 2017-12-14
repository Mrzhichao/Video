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
                     <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
                  </div>
                  <hr/>

                  <!--头像 -->
                  <form class="am-form am-form-horizontal" action="{{ url('home/userinfo') }}/{{$data ->uid}}" method="post" enctype="multipart/form-data">

                   {{ method_field('put') }}
                    {{ csrf_field() }}
                                    
                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li style="color:red">{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                    @endif
                                    <div id='msg' class="am-form-group">
                                        @if(session('msg'))
                                            <li style="color:red">{{session('msg')}}</li>
                                         @endif
                                    </div>                
         

                  <div class="user-infoPic">
                     <div class="filePic">

                        <input type="file" name="avatar"  class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
                        @if($data ->avatar == 'default.jpg' || !empty($data -> avater))
                           <img src="{{ asset('./uploads/user/default.jpg') }}"  class="tpl-table-line-img" alt="">
                        @else
                           <img src="{{ asset('./uploads/user/s_') }}{{ $data->avatar }}"  class="tpl-table-line-img" alt="">
                        @endif
                     </div>

                     <p class="am-form-help">头像</p>

                     <div class="info-m">
                        <div><b>用户名：<i>{{ $data -> uname}}</i></b></div>
                        <div class="u-level">
                           <span class="rank r2">
                                  <s class="vip1"></s><a class="classes" >
                                    @if( $data ->roleid == 3)
                                       普通用户
                                    @elseif( $data ->roleid == 4)
                                       Vip用户
                                    @else
                                       广告商
                                    @endif
                                  </a>
                              </span>
                        </div>
                        <div class="u-safety">
                           <a href="javascript:;">
                              用户积分
                           <span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0">{{ $data ->integral}}</i></span>
                           </a>
                        </div>
                     </div>
                  </div>

                  <!--个人信息 -->
                  <div class="info-main">
                     

                        <div class="am-form-group">
                           <label for="user-name2" class="am-form-label">昵称</label>
                           <div class="am-form-content">
                              <input type="text" name="nickname" id="user-name2"  value="@if($data -> userinfo){{$data -> userinfo ->nickname}}@endif">

                           </div>
                        </div>

                        <div class="am-form-group">
                           <label for="user-name" class="am-form-label">姓名</label>
                           <div class="am-form-content">
                              <input type="text" name="realname" id="user-name2"  value="@if($data -> userinfo){{$data -> userinfo ->realname}}@endif">

                           </div>
                        </div>

                        <div class="am-form-group">
                           <label class="am-form-label">性别</label>
                           <div class="am-form-content sex">
                              <label class="am-radio-inline">
                                 <input type="radio" name="sex" value="男" @if($data -> sex == '男') checked @endif   data-am-ucheck> 男
                              </label>
                              <label class="am-radio-inline">
                                 <input type="radio" name="sex" value="女" @if($data -> sex == '女') checked @endif data-am-ucheck> 女
                              </label>
                           </div>
                        </div>

                        
                        <div class="am-form-group">
                           <label for="user-phone" class="am-form-label">电话</label>
                           <div class="am-form-content">
                              <input id="user-phone" name= "phone" type="tel" value="{{ $data->phone }}">

                           </div>
                        </div>
                        <div class="am-form-group">
                           <label for="user-email" class="am-form-label">电子邮件</label>
                           <div class="am-form-content">
                              <input id="user-email" name="email" placeholder="Email" type="email" value="{{ $data->email }}">

                           </div>
                        </div>
                       
                        <div class="info-btn">
                           <button class="am-btn am-btn-danger">保存修改</button>
                        </div>

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