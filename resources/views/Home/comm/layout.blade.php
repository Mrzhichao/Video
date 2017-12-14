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


<script type="text/javascript" src="{{asset('Home/common/js/jquery-1.12.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('Home/common/js/jquery.flexText.js')}}"></script>

<script src="{{ asset('Home/jd/js/jquery.min.js') }}"></script>
<script src="{{asset('Layer/layer.js')}}"></script>



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
                @if($v->nname == 'Vip')
                  <li><a href="{{$v->resourceSrc}}">{{$v->nname}}</a></li>
                @else
                  <li><a href="{{$v->resourceSrc}}?pid={{$v->pid}}">{{$v->nname}}</a></li>
                @endif
              @endforeach
            <li><a href="{{url('home/video/status')}}">视频搜索页</a></li>
            <li><a href="contact.html">更多</a></li>
          </ul>
          <ul class="social">
            <li class="social-facebook" id="up"><a href="javascript:;" class="fa fa-upload social-icons"></a></li>
            <!-- 上传按钮 -->
            <li class="social-google-plus"  ><a href="#" class="fa fa-download social-icons"></a></li>
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
<script src="{{asset('layer/layer.js')}}"></script>
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




<!--textarea高度自适应-->
<script type="text/javascript">
    $(function () {
        $('.content').flexText();
    });
</script>
<!--textarea限制字数-->
<script type="text/javascript">
    function keyUP(t){
        var len = $(t).val().length;
        if(len > 139){
            $(t).val($(t).val().substring(0,140));
        }
    }
</script>
<!--点击评论创建评论条-->
<script type="text/javascript">
    $('.commentAll').on('click','.plBtn',function(){
        var myDate = new Date();
        //获取当前年
        var year=myDate.getFullYear();
        //获取当前月
        var month=myDate.getMonth()+1;
        //获取当前日
        var date=myDate.getDate();
        var h=myDate.getHours();       //获取当前小时数(0-23)
        var m=myDate.getMinutes();     //获取当前分钟数(0-59)
        if(m<10) m = '0' + m;
        var s=myDate.getSeconds();
        if(s<10) s = '0' + s;
        var now=year+'-'+month+"-"+date+" "+h+':'+m+":"+s;
        //获取输入内容
        var oSize = $(this).siblings('.flex-text-wrap').find('.comment-input').val();
        console.log(oSize);
        //动态创建评论模块
        oHtml = '<div class="comment-show-con clearfix"><div class="comment-show-con-img pull-left"><img src="images/header-img-comment_03.png" alt=""></div> <div class="comment-show-con-list pull-left clearfix"><div class="pl-text clearfix"> <a href="#" class="comment-size-name">David Beckham : </a> <span class="my-pl-con">&nbsp;'+ oSize +'</span> </div> <div class="date-dz"> <span class="date-dz-left pull-left comment-time">'+now+'</span> <div class="date-dz-right pull-right comment-pl-block"><a href="javascript:;" class="removeBlock">删除</a> <a href="javascript:;" class="date-dz-pl pl-hf hf-con-block pull-left">回复</a> <span class="pull-left date-dz-line">|</span> <a href="javascript:;" class="date-dz-z pull-left"><i class="date-dz-z-click-red"></i>赞 (<i class="z-num">666</i>)</a> </div> </div><div class="hf-list-con"></div></div> </div>';
        if(oSize.replace(/(^\s*)|(\s*$)/g, "") != ''){
            $(this).parents('.reviewArea ').siblings('.comment-show').prepend(oHtml);
            $(this).siblings('.flex-text-wrap').find('.comment-input').prop('value','').siblings('pre').find('span').text('');
        }
    });
</script>
<!--点击回复动态创建回复块-->
<script type="text/javascript">
    $('.comment-show').on('click','.pl-hf',function(){
        //获取回复人的名字
        var fhName = $(this).parents('.date-dz-right').parents('.date-dz').siblings('.pl-text').find('.comment-size-name').html();
        //回复@
        var fhN = '回复@'+fhName;
        //var oInput = $(this).parents('.date-dz-right').parents('.date-dz').siblings('.hf-con');
        var fhHtml = '<div class="hf-con pull-left"> <textarea class="content comment-input hf-input" placeholder="" onkeyup="keyUP(this)"></textarea> <a href="javascript:;" class="hf-pl">评论</a></div>';
        //显示回复
        if($(this).is('.hf-con-block')){
            $(this).parents('.date-dz-right').parents('.date-dz').append(fhHtml);
            $(this).removeClass('hf-con-block');
            $('.content').flexText();
            $(this).parents('.date-dz-right').siblings('.hf-con').find('.pre').css('padding','6px 15px');
            //console.log($(this).parents('.date-dz-right').siblings('.hf-con').find('.pre'))
            //input框自动聚焦
            $(this).parents('.date-dz-right').siblings('.hf-con').find('.hf-input').val('').focus().val(fhN);
        }else {
            $(this).addClass('hf-con-block');
            $(this).parents('.date-dz-right').siblings('.hf-con').remove();
        }
    });
</script>
<!--评论回复块创建-->
<script type="text/javascript">
    $('.comment-show').on('click','.hf-pl',function(){
        var oThis = $(this);
        var myDate = new Date();
        //获取当前年
        var year=myDate.getFullYear();
        //获取当前月
        var month=myDate.getMonth()+1;
        //获取当前日
        var date=myDate.getDate();
        var h=myDate.getHours();       //获取当前小时数(0-23)
        var m=myDate.getMinutes();     //获取当前分钟数(0-59)
        if(m<10) m = '0' + m;
        var s=myDate.getSeconds();
        if(s<10) s = '0' + s;
        var now=year+'-'+month+"-"+date+" "+h+':'+m+":"+s;
        //获取输入内容
        var oHfVal = $(this).siblings('.flex-text-wrap').find('.hf-input').val();
        console.log(oHfVal)
        var oHfName = $(this).parents('.hf-con').parents('.date-dz').siblings('.pl-text').find('.comment-size-name').html();
        var oAllVal = '回复@'+oHfName;
        if(oHfVal.replace(/^ +| +$/g,'') == '' || oHfVal == oAllVal){

        }else {
            $.getJSON("json/pl.json",function(data){
                var oAt = '';
                var oHf = '';
                $.each(data,function(n,v){
                    delete v.hfContent;
                    delete v.atName;
                    var arr;
                    var ohfNameArr;
                    if(oHfVal.indexOf("@") == -1){
                        data['atName'] = '';
                        data['hfContent'] = oHfVal;
                    }else {
                        arr = oHfVal.split(':');
                        ohfNameArr = arr[0].split('@');
                        data['hfContent'] = arr[1];
                        data['atName'] = ohfNameArr[1];
                    }

                    if(data.atName == ''){
                        oAt = data.hfContent;
                    }else {
                        oAt = '回复<a href="#" class="atName">@'+data.atName+'</a> : '+data.hfContent;
                    }
                    oHf = data.hfName;
                });

                var oHtml = '<div class="all-pl-con"><div class="pl-text hfpl-text clearfix"><a href="#" class="comment-size-name">我的名字 : </a><span class="my-pl-con">'+oAt+'</span></div><div class="date-dz"> <span class="date-dz-left pull-left comment-time">'+now+'</span> <div class="date-dz-right pull-right comment-pl-block"> <a href="javascript:;" class="removeBlock">删除</a> <a href="javascript:;" class="date-dz-pl pl-hf hf-con-block pull-left">回复</a> <span class="pull-left date-dz-line">|</span> <a href="javascript:;" class="date-dz-z pull-left"><i class="date-dz-z-click-red"></i>赞 (<i class="z-num">666</i>)</a> </div> </div></div>';
                oThis.parents('.hf-con').parents('.comment-show-con-list').find('.hf-list-con').css('display','block').prepend(oHtml) && oThis.parents('.hf-con').siblings('.date-dz-right').find('.pl-hf').addClass('hf-con-block') && oThis.parents('.hf-con').remove();
            });
        }
    });
</script>
<!--删除评论块-->
<script type="text/javascript">
    $('.commentAll').on('click','.removeBlock',function(){
        var oT = $(this).parents('.date-dz-right').parents('.date-dz').parents('.all-pl-con');
        if(oT.siblings('.all-pl-con').length >= 1){
            oT.remove();
        }else {
            $(this).parents('.date-dz-right').parents('.date-dz').parents('.all-pl-con').parents('.hf-list-con').css('display','none')
            oT.remove();
        }
        $(this).parents('.date-dz-right').parents('.date-dz').parents('.comment-show-con-list').parents('.comment-show-con').remove();

    })
</script>
<!--点赞-->
<script type="text/javascript">
    $('.comment-show').on('click','.date-dz-z',function(){
        var zNum = $(this).find('.z-num').html();
        if($(this).is('.date-dz-z-click')){
            zNum--;
            $(this).removeClass('date-dz-z-click red');
            $(this).find('.z-num').html(zNum);
            $(this).find('.date-dz-z-click-red').removeClass('red');
        }else {
            zNum++;
            $(this).addClass('date-dz-z-click');
            $(this).find('.z-num').html(zNum);
            $(this).find('.date-dz-z-click-red').addClass('red');
        }
    })
</script>

@show
