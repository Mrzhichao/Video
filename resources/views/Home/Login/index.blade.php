@extends('Home.footer')
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="OrcasThemes">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
      <title>{{ $title }}</title>
      <!-- Bootstrap core CSS -->
      <link href="{{asset('Home/css/bootstrap.css') }}" rel="stylesheet">
      <!-- Custom styles for this template -->
      <link rel="stylesheet" href="{{asset('Home/css/screen.css') }}">
      <link rel="stylesheet" href="{{asset('Home/css/animation.css') }}">
      <!--[if IE 7]>
      
      <![endif]-->
      <link rel="stylesheet" href="{{asset('Home/css/font-awesome.css') }}">
      <!--[if lt IE 8]>
      <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen, projection">
      <![endif]-->
      <link href="{{asset('Home/css/lity.css') }}" rel="stylesheet">
      <script src="{{asset('Home/js/jquery-1.12.1.min.js') }}"></script>
      <script src="{{asset('Home/js/bootstrap.min.js') }}"></script>
      <script type="text/javascript">
         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
      </script>
      <script src="{{asset('Layer/layer.js')}}"></script>
   </head>
   <body>
      <!-- LOGIN -->
      <div id="login" class="container-fluid standard-bg">
         <!-- HEADER -->
         <div class="row header-top">
            <div class="col-lg-3 col-md-6 col-sm-5">
               <a class="main-logo" href="#"><img src="{{asset('Home/img/main-logo.png') }}" class="main-logo" alt="Muvee Reviews" title="Muvee Reviews"></a>
            </div>
            <div class="col-lg-6 hidden-md text-center hidden-sm hidden-xs">
               <img src="{{asset('Home/img/banners/banner-sm.jpg') }}" class="img-responsive" alt="Buy Now">
            </div>
      </div>
@section('content')
            
         <!-- MENU -->
         <div class="row home-mega-menu ">
            <div class="col-md-12">
               <nav class="navbar navbar-default">
                  <div class="navbar-header">
                     <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                     <span class="sr-only">Toggle navigation</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     </button>
                  </div>
                        <!--注册fa fa-facebook-->
                              <div class="col-lg-10 col-md-6 col-sm-7 hidden-xs">
                                 <div class="right-box">
                                    <a href="{{ url('home/phoneregister')}}" class="access-btn" data-toggle="modal" >注册</a>
                                 </div>
                              </div>
                    

                  <!-- /.nav-collapse -->
               </nav>
            </div>
         </div>
         <!-- LOGIN -->
         <div class="row">
            <div class="container">
               <section class="registration col-lg-12 col-md-12">
                  <div class="row secBg">
                     <div class="large-12 columns">
                        <div class="login-register-content">
                           <div class="row" data-equalizer data-equalize-on="medium" id="test-eq">
                              <div class="col-md-12 text-center login-header">
                                 <h2 class="title main-head-title">用 户 登 录</h2>
                                 
                              </div>
                              <div class="clearfix spacer"></div>
                              <div class="col-md-5 social-login">
                                 <div class="social-login" data-equalizer-watch>
                                    <h2 class="title main-head-title">第三方登录</h2>
                                    <div class="social-login-btn social-facebook">
                                       <a href="#"><i class="fa fa-qq"></i>QQ登录</a>
                                    </div>
                                    <div class="social-login-btn social-twitter">
                                       <a href="#"><i class="fa  fa-weixin"></i>微信登录</a>
                                    </div>
                                    <div class="social-login-btn social-twitter">
                                       <a href="#"><i class="fa  fa-weibo"></i>微博登录</a>
                                    </div>
                                 
                                 </div>
                              </div>
                              <div class="col-md-2">
                                 <div class="middle-sep">
                                    <i class="fa fa-arrow-left arrow-left"></i>
                                    <span>OR</span>
                                    <i class="fa fa-arrow-right arrow-right"></i>
                                 </div>
                              </div>
                              <div class="col-md-5">
                                 <div class="register-form">
                                    <h2 class="title main-head-title">登 录</h2>
                                    <form action="{{url('home/dologin')}}" method="post" data-abide novalidate >

                                       {{ csrf_field() }}

                                        @if (count($errors) > 0)
                                             <div class="alert alert-danger">
                                                 <ul>
                                                     @if(is_object($errors))
                                                         @foreach ($errors->all() as $error)
                                                             <li style="color:red">{{ $error }}</li>
                                                         @endforeach
                                                     @else
                                                         <li style="color:red">{{ $errors }}</li>
                                                     @endif
                                                 </ul>
                                             </div>
                                         @endif

                                         <div id='msg' class="am-btn-group am-btn-group-xs">
                                             @if(session('msg'))
                                                <li style="color:red">{{session('msg')}}</li>
                                            @endif
                                        </div>

                                       <div class="input-group">
                                          <span class="fa fa-user login-inputicon"></span>
                                          <input id="user" type="text" name="user" onkeydown="qingkong()"  placeholder="用户名|手机号|邮箱"  required>
                                       </div>
                                       <div class="input-group">
                                          <span class="fa fa-lock login-inputicon"></span>
                                          <input type="password" name = 'upwd' id="password" placeholder="密码"   required> 
                                       </div>
                                       <div class="checkbox">
                                          <input id="remember" type="checkbox" name="remember">
                                          <label class="customLabel" for="remember">记住密码</label>
                                       </div>

                                        <div class="checkbox"  style="float:right; right:20px">
                                            <a href="{{url('home/forget')}}" >忘记密码</a>
                                        </div>
                                       <div class="login-btn-box">
                                          <button class="access-btn" id="button" onclick="ok()">登录</button>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
            </div>
           <script>
            function ok(){
               if($('#user').val().trim()==''||$('#password').val().trim()=='')
               {
                  // alert("用户名或密码不能为空");
                  return false;
               }
               if($('#remember').prop('checked')&&$('#user').val().trim()!=''&&$('#password').val().trim()!='')
               {
                  var myDate = new Date();
                  var time=myDate.getYear()*365*24+myDate.getMonth()*30*24+myDate.getDate()*24+myDate.getHours()+3*24;
                  window.localStorage['time']=time;
                  window.localStorage['user']=$('#user').val();
                  window.localStorage['password']=$('#password').val();
               }else{
                  window.localStorage.removeItem('user');
                  window.localStorage.removeItem('password');
               }
            }
            $(function(){
               var myDate = new Date();
               var timeNow=myDate.getYear()*365*24+myDate.getMonth()*30*24+myDate.getDate()*24+myDate.getHours();
               var time=window.localStorage['time'];
               var user=window.localStorage['user'];
               var password=window.localStorage['password'];
               if(user!=null&&password!=null&&time>=timeNow){
                  // alert('过期时间:'+time+'现在时间:'+timeNow);
                  $('#user').val(user);
                  $('#password').val(password);
                  $('#remember').attr('checked','true');
               }
            });
            function qingkong(){
               $('#pwd').val('');
            }


        //提示信息消失
        
        $("#msg").fadeOut(6000, 'linear' ,function(){
  
        });

      </script>
 @stop