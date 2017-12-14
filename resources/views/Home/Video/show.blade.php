<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="OrcasThemes">
      <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
      <title></title>
      <!-- Bootstrap core CSS -->
      <link href="{{asset('Home/css/bootstrap.css')}}" rel="stylesheet">
      <!-- Custom styles for this template -->
      <link rel="stylesheet" href="{{asset('Home/css/screen.css')}}">
      <link rel="stylesheet" href="{{asset('Home/css/animation.css')}}">
      <!--[if IE 7]>
      
      <![endif]-->
      <link rel="stylesheet" href="{{asset('Home/css/font-awesome.css')}}">
      <!--[if lt IE 8]>
      <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen, projection">
      <![endif]-->

    <!-- <link href="{{asset('Home/css/lity.css')}}" rel="stylesheet"> -->
    <link rel="stylesheet" id="main-css" href="http://www.ff6.wang/static/style.css" type="text/css" media="all">

  <link rel="stylesheet" href="{{ asset('Home/jd/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('Home/jd/css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('Home/jd/css/style.css') }}"> 
  <script src="{{ asset('Home/jd/js/jquery.min.js') }}"></script>

    <style> 
    
    
    #href{
        color: white;
    }
    
    #href:hover{
        color:orange;
    }
    
    </style>
   </head>
   <body>

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
            <li><a href="{{$v->resourceSrc}}/{{$v->pid}}">{{$v->nname}}</a></li>
            @endforeach
            <li><a href="{{url('home/video/status')}}">返回</a></li>
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

      <!-- GALLERY VIDEO GRID BOXED -->
      <div id="single-video-right-sidebar" class="container-fluid standard-bg">
         <!-- HEADER -->
         
         <!-- GALLERY VIDEO GRID BOXED -->
         <div class="row">
            <div class="container">
               <div class="row">
                  <!-- VIDEO POSTS -->  
                  <div class="col-lg-12 col-md-12">
                     <!-- GALLERY VIDEO GRID SECTION -->
                     <section id="gallery-video-section">
                        <div class="row">
                           <!-- RELATED VIDEOS -->
                           <div class="col-lg-12 col-md-12 col-sm-12 category-video-grid video-info dropshd">
                              
                              <!-- VIDEO POSTS ROW -->

                              <div class="row clear-auto">

                                 @foreach($data as $k=>$vv)         
                                    <div class="col-lg-3 col-md-3 col-sm-3 filter tutorial">
                                       <!-- POST L size -->
                                       <div class="post post-medium">
                                          <div class="thumbr">
                                             <a class="post-thumb" href="" data-lity>
                                                <span class="play-btn-border" title="Play">
                                                   <i class="fa fa-play-circle headline-round" aria-hidden="true"></i>
                                                </span>
                                                <div class="cactus-note ct-time font-size-1"><span>02:02</span></div>
                                                <img class="img-responsive" src="{{ asset('/Uploads/Video/'.$vv['logo']) }}" alt="#" />
                                             <a>
                                          </div>
                                       </div>
                                    </div>
                                 @endforeach      
                           </div>
                        </div>
                     </section>
                    </section>        
                  </div>
              </div>
            </div>
         </div>
      </div>

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


    <script src="{{asset('Layer/layer.js')}}"></script>

<script>
    $(function(){

        $(".shaixuan-tj span.crumb-select-item").live('hover',function(event){
            if(event.type=='mouseenter'){ 
            $(this).addClass("crumb-select-itemon");
            }else{ 
            $(this).removeClass("crumb-select-itemon");
            } 
        });

        $(".shaixuan-tj span.crumb-select-item").live('click', function(event){
            event.preventDefault();
            $(this).remove();
            var TTR = $(this).find("em").text();
            $(".show-con a").each(function(){
                var TT = $(this).text();
                    THI = $(this);
                    THIPP = $(this).parents("dl");
                if(TTR==TT){
                    THI.removeClass("nzw12");
                    THIPP.css("display","block");
                }
            })
        });

        $(".show-con a").click(function(event){
            event.preventDefault();
                 THIP = $(this).parents("dl");
            if($(this).hasClass("nzw12")){
            }else{
                $(this).addClass("nzw12");
                var zhiclass = $(this).parents("dd").siblings("dt").find("a").text();
                    zhicon = $(this).text();
                    tianjaneir="<span class='crumb-select-item'><a href='/'><b>"+zhiclass+"</b><em>"+zhicon+"</em><i class='icon-remove'></i></a></span>"
                $(".shaixuan-tj").children().last().after(tianjaneir);
                THIP.css("display","none");
            }
        });

        $(".show-more").click(function(event){
            event.preventDefault();
            var ticon = $(this).find("i");
                tspan = $(this).find("span");
                if($(this).hasClass("zk")){
                    $(this).siblings(".show-con").css("height","30px");
                    ticon.removeClass("icon-angle-up");
                    ticon.addClass("icon-angle-down");
                    tspan.html("更多");
                    $(this).removeClass("zk")
                }else{
                    $(this).siblings(".show-con").css("height","auto");
                    ticon.removeClass("icon-angle-down");
                    ticon.addClass("icon-angle-up");
                    tspan.html("收起");
                    $(this).addClass("zk")
                }
        });

        $("#sxbtn").click(function(event){
            event.preventDefault();
            var xicon = $(this).find("span i");
                xspan = $(this).find("span em");
            if($(this).hasClass("zkon")){
                xspan.text("收起筛选");
                xicon.removeClass("icon-angle-down");
                xicon.addClass("icon-angle-up");
                $(".sxcon").slideDown();
                $(this).removeClass("zkon")
            }else{
                xspan.text("查看筛选");
                xicon.removeClass("icon-angle-up");
                xicon.addClass("icon-angle-down");
                $(".sxcon").slideUp();
                $(this).addClass("zkon")
            }
        })

    })

    function sou($id){
       // 搜索的值    
      // var type=$(".crumb-select-item").first().find("b").html(); 
      // alert(type);

      var type =[];
      var value=[];
      $(".crumb-select-item").each(function(i){
            type[i] =  $(this).find("b").html(); 
            value[i] =  $(this).find("em").html(); 
       });

      $.ajax({
         type: "POST",
         url: "/home/video/type/ajax",
         data:{'type':type,'value':value,'_token':"{{csrf_token()}}"},
         async: true,
         cache: false,
         success: function(data) {
            // console.log(data);
            if(data.status==0){
                layer.msg(data.msg,{icon: 6});
                location.href = location.href;
            }else{
                layer.msg(data.msg,{icon: 5});
                location.href = location.href;
            }
         },
         error: function(XMLHttpRequest, textStatus, errorThrown) {
             alert("努力加载中");
             }
         });
   }
</script>