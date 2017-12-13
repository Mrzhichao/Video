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

                              <div style="width:946px; margin:0 auto;">
                                 <div class="clearfix">
                                    <p class="shaixuan-tj floatLeft clearfix">
                                       <span><a href="/" id='href'>全部结果</a></span>
                                       <i class="icon-angle-right"></i>
                                       <span><strong id='href'>所有条件</strong></span>
                                       <i class="icon-angle-right"></i>
                                    </p>
                                    <p id="sxbtn" class="shaixuan-btn clearfix">
                                       <span><em>收起筛选</em><i class="icon-angle-up"></i></span>  
                                    </p>
                                    <button onclick='sou(1)'>搜索</button>
                                  </div>

                                  <div id="page-search-store" class="mb10 border sxcon">
                                      <div class="search-by by-category relative">

                                          <dl class="relative clearfix">
                                             <dt class="floatLeft">
                                                <a href="/">类型:</a>
                                             </dt>
                                             <dd class="floatLeft show-con">

                                                   @foreach($data as $k=>$v)    
                                                      <a href="/" class="" id='href'>{{$v['vtname']}}</a>
                                                   @endforeach

                                                   <a href="/" class="" id='href'>其他</a>
                                              </dd>
                                              <dd class="floatLeft show-more">
                                                 <h3 class="pointer clearfix">
                                                   <span id="href">更多</span>
                                                   <i class="icon-angle-down"></i>
                                                 </h3>
                                              </dd>
                                          </dl>

                                          <dl class="relative clearfix">
                                             <dt class="floatLeft">
                                                <a href="/">年代:</a>
                                             </dt>
                                             <dd class="floatLeft show-con">

                                                @foreach($years as $year)  
                                                   <a href="/" class="" id='href'>{{$year}}</a>
                                                @endforeach

                                                   <a href="/" class="" id='href'>其他</a>
                                             </dd>
                                             <dd class="floatLeft show-more">
                                                <h3 class="pointer clearfix">
                                                   <span id="href">更多</span>
                                                   <i class="icon-angle-down"></i>
                                                </h3>
                                             </dd>
                                          </dl>

                                          <dl class="relative clearfix" style="border-bottom:0">
                                             <dt class="floatLeft"><a href="/">地区:</a></dt>
                                             <dd class="floatLeft show-con">

                                                @foreach($areas as $k=>$area)
                                                      <a href="/" class="" id='href'>{{$area}}</a> 
                                                @endforeach  
                                                   <a href="/" class="" id='href'>其他</a>
                                             </dd>
                                             <dd class="floatLeft show-more">
                                                <h3 class="pointer clearfix">
                                                   <span id="href">更多</span>
                                                   <i class="icon-angle-down"></i>
                                                </h3>
                                             </dd>
                                          </dl>

                                    </div>
                                 </div>
                              </div>

                              <div class="row clear-auto">

                                 @foreach($data as $k=>$v)         
                                    @foreach($v['video'] as $k=>$vv)  
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
                                 @endforeach      

                              <div class="clearfix spacer"></div>
                              <!-- VIDEO POSTS ROW -->
                              <div class="row clear-auto">

                                 @foreach($data as $k=>$v)         
                                    @foreach($v['video'] as $k=>$vv)   <!--$data=$data[0]['video'][0]['area']-->
                                    <div class="col-lg-2 col-md-6 col-sm-4 filter css">
                                       <!-- POST L size -->
                                       <div class="post post-medium">
                                          <div class="thumbr">
                                             <a class="post-thumb" href="" data-lity>
                                                <span class="play-btn-border" title="Play"><i class="fa fa-play-circle headline-round" aria-hidden="true"></i></span>
                                                <div class="cactus-note ct-time font-size-1"><span>02:02</span></div>
                                                <img class="img-responsive" src="{{ asset('/Uploads/Video/'.$vv['logo']) }}" alt="#">
                                             <a>
                                          </div>
                                       </div>
                                    </div>   
                                    @endforeach   
                                 @endforeach 
                                 
                              </div>
                              <div class="clearfix spacer"></div>
                           </div>
                        </div>
                     </section>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- BOTTOM BANNER -->
      <div id="bottom-banner" class="container text-center">
         <!-- BOTTOM ADVERTISE BOX -->
         <a id='ahref' href="" class="banner-xl">
         <img src="img/banners/banner-xl.jpg" class="img-responsive" alt="Buy Now Muvee Reviews Bootstrap HTML5 Template" title="Buy Now Muvee Reviews Bootstrap HTML5 Template">
         <a>&nbsp		
      </div>

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