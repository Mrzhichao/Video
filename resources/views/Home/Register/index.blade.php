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
            
      <!-- CONTACT -->
      <div id="contact" class="container-fluid review-bg">
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
              
                  <!-- /.nav-collapse -->
               </nav>
            </div>
         </div>
         <!-- CONTACT -->
         <div class="row auto-clear">
            <!-- CONTACT PAGE -->	
            <div class="col-lg-4 col-md-4">
            </div>
            <div class="col-lg-4 col-md-8">
                     <div class="content-box-opa dark-bg">
                        <article>
                              <div class="col-lg-12 col-md-12 col-sm-12 post post-medium">
                                    <center><h2>用 户 注 册</h2></center>
                                    <br>
                                     
                                    <form name="comment-form1" method="post" action="{{url('home/dophoneregister')}}" id="comment-form1" enctype="multipart/form-data">
                                       <fieldset>
                                       {{csrf_field()}}

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
                                          <div class="row">
                                             <div class="col-md-12">
                                                <input type="text" name="uname" id="contactname" value="{{old('')}}" placeholder="用户名" onfocus="if (this.value=='Your name') this.value = ''">
                                             </div>
                                             <div class="col-md-12" style="height:20px">
                                                
                                             </div>
                                             <div class="col-md-12">
                                                <input type="password" name="upwd" id="contactemail"  placeholder="密码"  onfocus="if (this.value=='Enter your email address') this.value = ''">
                                             </div>
                                             <div class="col-md-12" style="height:20px">
                                                
                                             </div>
                                             <div class="col-md-12">
                                                <input type="password" name="re_upwd" id="contactemail"  placeholder="确认密码">
                                             </div>
                                             <div class="col-md-12" style="height:20px">
                                                
                                             </div>

                                             <div class="col-md-12">
                                                <input type="email" name="email" id="contactemail" value="{{old('')}}" placeholder="邮箱 " >
                                             </div>
                                             <div class="col-md-12" style="height:20px">
                                                
                                             </div>
                                             <div class="col-md-12">
                                                <input type="tel" name="phone" id="contactemail" value="{{old('')}}" placeholder="手机号">
                                             </div>
                                             <div class="col-md-12" style="height:20px">
                                                
                                             </div>
                                             <div class="col-md-12">
                                                <input type="text" style="width:350px" name="code" value="{{old('')}}" id="contactemail" placeholder="手机验证码">
                                                <!-- <button   type="button"  >发送验证码</button> -->
                                                <input type="button" id="btnSendCode" class="subscribe-btn"  value="发送验证码" onclick="sendcode(this)" style="width:150px"   /> 
                                             </div>
                                             <div class="col-md-12" style="height:50px">
                                                
                                             </div>
                                             <div class="col-md-12">
                                                <button class="subscribe-btn" >注册</button>
                                             </div>
                                          </div>

                                       </fieldset>
                                    </form>
                              </div>
                                 <!-- COMMENT FORM END -->
                           <div class="clearfix spacer"></div>
                        </article>
                     </div>
               <div class="clearfix spacer"></div>
            </div>
             <div class="col-lg-4 col-md-2">
            </div>
         </div>
      </div>

      <script>
   
         var InterValObj; //timer变量，控制时间
         var count = 60; //间隔函数，1秒执行
         var curCount;//当前剩余秒数

         function sendcode(){

          // alert(11111);
            curCount = count;
   //      　　//设置button效果，开始计时
             $("#btnSendCode").attr("disabled", "true");
             $("#btnSendCode").val( curCount + "秒内验证码有效");
             InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
   // //        1. 获取要发送的手机号
            var phone = $('[name="phone"]').val();
            // alert($phone);
   // //       2. 向服务器的发送短信的接口发送ajax请求

            $.post("{{url('home/sendcode')}}",{'phone':phone,'_token':'{{csrf_token()}}'},function(data){
               console.log(data);
               var obj = JSON.parse(data);
               if(obj.status == 0){
                       layer.msg(obj.message, {icon: 6,area: ['100px', '80px']});
               }else{
                       layer.msg(obj.message, {icon: 5,area: ['100px', '80px']});
               }
            });
         }
          //timer处理函数
         function SetRemainTime() {
            if (curCount == 0) {               
                window.clearInterval(InterValObj);//停止计时器
                $("#btnSendCode").removeAttr("disabled");//启用按钮
                $("#btnSendCode").val("重新发送验证码");
            }
            else {
                curCount--;
                $("#btnSendCode").val( curCount + "秒内验证码有效");
            }
        }


        //提示信息消失
        
        $("#msg").fadeOut(6000, 'linear' ,function(){
  
        });
   </script>
@stop
