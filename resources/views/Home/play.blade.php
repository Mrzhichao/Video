
@extends('Home.comm.layout')
@section('title')
 @parent
   播放页
@stop
 <style type="text/css">
        .main-wrap{
            margin: 0 auto;
            min-width: 720px;
            min-height: 530px;
            max-height: 1080px;
            max-width: 1080px;

        }

        .main-wrap video{
            width: 100%;
            height: 78%;
        }
 
    </style>
@section('main')
         <!-- SINGLE VIDEO -->
         <div class="row">
            <!-- SIDEBAR -->
            <div class="col-lg-2 col-md-4 hidden-sm hidden-xs">
              @include('Home.comm.zuoce')
            </div>
            <!-- SINGLE VIDEO -->   
            <div id="single-video-wrapper" class="col-lg-10 col-md-8">
               <div class="row">
                  <!-- VIDEO SINGLE POST -->
                  <div class="col-lg-8 col-md-12 col-sm-12">
                     <!-- POST L size -->
                     <article class="post-video">
                        <!-- VIDEO INFO -->
                        <div class="video-info">
                           <!-- 16:9 aspect ratio -->
                           
                    <!--  <div class="main-wrap ">
                       <video ishivideo="true" autoplay="false" isrotate="false" autoHide="true">
                           <source src="{{url('/uploads/Video/')}}/{{$data['resourceSrc']}}" type="video/mp4">
                       </video>

                   </div> -->
                   

                         
<script type="text/javascript" src="{{url('ckplayer/ckplayer/ckplayer.js')}}" charset="utf-8"></script>

                         <div id="video" style="width: 700px; height: 500px;"></div>

                        <script type="text/javascript">
                        var videoObject = {
                        container: '#video', //容器的ID或className
                        variable: 'player',//播放函数名称
                        //是否自动播放
                        autoplay: true,
                        flashplayer: false,
                        
                        // adfront: "{{ url('uploads/Video') }}/{{ $vad['vpath'] }}", //前置广告
                        // adfronttime: "{{$vad['vtime']}}",
                        // adfrontlink: "{{$vad['vredirect']}}",
                      adfront: '/uploads/Video/V15132577064043', //前置广告
        adfronttime: '15',
        adfrontlink: '',
                        
                        video: [//视频地址列表形式
                          ["{{url('uploads/Video')}}/{{$data['resourceSrc']}}", 'video/mp4', '中文标清', 0],
                          ],


                      };
                    var player = new ckplayer(videoObject);
                  </script>


                   </div>
                           

                           <h2 class="title main-head-title">{{$data['vname']}}</h2>
                           <div class="metabox">
                              <span class="meta-i">
                              <i class="fa fa-user"></i><a href="#" class="author" title="John Doe">{{$data['uname']}}</a>
                              </span>
                              <span class="meta-i">
                              <i class="fa fa-clock-o"></i>{{ date('Y-m-d',$data['projectionTime']) }}
                              </span>
                              <span class="meta-i">
                              <i class="fa fa-eye"></i>{{$data['numOfViewed']}}
                              </span>
                              <div class="ratings">
                                 @if($data['vscores'] < 2 )
                        <div class="ratings">

                          <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star-o"></i>
                           <i class="fa fa-star-o"></i>
                           <i class="fa fa-star-o"></i>
                          
                        </div>
                        @elseif($data['vscores'] >=2 && $data['vscores'] < 5)
                         <div class="ratings">

                          <i class="fa fa-star" aria-hidden="true"></i>
                          <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star-o"></i>
                          <i class="fa fa-star-o"></i>
                         
                        </div>
                        @elseif($data['vscores'] >=5 && $data['vscores'] < 7)
                         <div class="ratings">

                          <i class="fa fa-star" aria-hidden="true"></i>
                          <i class="fa fa-star" aria-hidden="true"></i>
                          <i class="fa fa-star-half-o" aria-hidden="true"></i>
                          <i class="fa fa-star-o"></i>
                        </div>
                         @elseif($data['vscores'] >=7 && $data['vscores'] < 9)
                         <div class="ratings">

                          <i class="fa fa-star" aria-hidden="true"></i>
                          <i class="fa fa-star" aria-hidden="true"></i>
                          <i class="fa fa-star-half-o" aria-hidden="true"></i>
                          <i class="fa fa-star-half"></i>
                        </div>
                         @elseif($data['vscores'] > 9 )
                         <div class="ratings">

                          <i class="fa fa-star" aria-hidden="true"></i>
                          <i class="fa fa-star" aria-hidden="true"></i>
                          <i class="fa fa-star-half-o" aria-hidden="true"></i>
                          <i class="fa fa-star-half-o" aria-hidden="true"></i>
                          <i class="fa fa-star-half-o" aria-hidden="true"></i>
                        </div>
                        @endif
                              </div>
                           </div>
                           <ul class="social">
                              <li class="social-facebook"><a href="#" class="fa fa-facebook social-icons"></a></li>
                              <li class="social-google-plus"><a href="#" class="fa fa-google-plus social-icons"></a></li>
                              <li class="social-twitter"><a href="#" class="fa fa-twitter social-icons"></a></li>
                              <li class="social-youtube"><a href="#" class="fa fa-youtube social-icons"></a></li>
                              <li class="social-rss"><a href="#" class="fa fa-rss social-icons"></a></li>
                           </ul>
                           <ul class="footer-tags">
                              <li><a href="#">videos</a></li>
                              <li><a href="#">premium</a></li>
                              <li><a href="#">hair</a></li>
                              <li><a href="#">beauty</a></li>
                              <li><a href="#">ranking</a></li>
                              <li><a href="#">lifestyle</a></li>
                              <li><a href="#">sport</a></li>
                              <li><a href="#">money</a></li>
                              <li><a href="#">comments</a></li>
                           </ul>
                           <div class="share-input">
                              <input type="text" value="" name="share-input">
                              <span class="fa fa-chain sharelinkicon"></span>
                           </div>
                        </div>
                        <div class="clearfix spacer"></div>
                        <!-- DETAILS -->
                        <div class="video-content">
                           <h2 class="title main-head-title">视频简介</h2>
                           <p>
                             {{$data['introduction']}}
                           </p>
                          
                        </div>
                        <div class="clearfix spacer"></div>
                        <!-- MAIN ROLL ADVERTISE BOX -->
                       
                     </article>
                  
               <!-- COMMENTS -->
               <section id="comments">
                  <h2 class="title">评论区</h2>
      
                  <div class="commentAll" style="width:700px;background-color:pink;color:black">
                      <!--评论区域 begin-->
                      <div class="reviewArea clearfix">
                          <textarea style="background-color:white;color:black" class="content comment-input" placeholder="Please enter a comment&hellip;" onkeyup="keyUP(this)"></textarea>
                          <a href="javascript:;" class="plBtn">评论</a>
                      </div>
                      <!--评论区域 end-->
                      <!--回复区域 begin-->
                      <div class="comment-show">
                          <div class="comment-show-con clearfix">
                              <div class="comment-show-con-img pull-left"><img src="images/header-img-comment_03.png" alt=""></div>
                              <div class="comment-show-con-list pull-left clearfix">
                                  <div class="pl-text clearfix">
                                      <a href="#" class="comment-size-name">张三 : </a>
                                      <span class="my-pl-con">&nbsp;来啊 造作啊!</span>
                                  </div>
                                  <div class="date-dz">
                                      <span class="date-dz-left pull-left comment-time">2017-5-2 11:11:39</span>
                                      <div class="date-dz-right pull-right comment-pl-block">
                                          <a href="javascript:;" class="removeBlock">删除</a>
                                          <a href="javascript:;" class="date-dz-pl pl-hf hf-con-block pull-left">回复</a>
                                          <span class="pull-left date-dz-line">|</span>
                                          <a href="javascript:;" class="date-dz-z pull-left"><i class="date-dz-z-click-red"></i>赞 (<i class="z-num">666</i>)</a>
                                      </div>
                                  </div>
                                  <div class="hf-list-con"></div>
                              </div>
                          </div>
                      </div>
                      <!--回复区域 end-->
                  </div>

               </section>
              
              </div>
              
                  <!-- VIDEO SIDE BANNERS -->
                 @include('Home.comm.youce')
               </div>
               <div class="clearfix spacer"></div>
              
            </div>
         </div>
  
      <!-- CHANNELS -->
      <div id="channels-block" class="container-fluid channels-bg">
         <div class="container-fluid ">
            <div class="col-md-12">
               <!-- CHANNELS -->
               <section id="channels">
                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                     <h2 class="icon"><i class="fa fa-television" aria-hidden="true"></i>相关视频</h2>
                     <div class="carousel-control-box">
                        <a class="left carousel-control" href="#myCarousel"  role="button" data-slide="prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                        <a class="right carousel-control" href="#myCarousel"  role="button" data-slide="next"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                     </div>
                     <!-- Wrapper for slides -->
                     <div class="carousel-inner" role="listbox">
                        <div class="item active">
                           <div class="row auto-clear">
                           @foreach($rmtj as $v)
                              <article class="col-lg-2 col-md-4 col-sm-4">
                                 <div class="post post-medium">
                                    <div class="thumbr">
                                       <a class="post-thumb" href="{{url('home/play')}}?vid={{$v->vid}}">
                                       <img class="  img-responsive" src="{{url('uploads/Video')}}/{{ $v->logo }}" style="width: 240px; height: 115px;" alt="#">
                                       </a>
                                    </div>
                                    <div class="infor">
                                       <h4>
                                          <a class="title" href="{{url('home/play')}}?vid={{$v->vid}}">{{$v->vname}}</a>
                                       </h4>
                                       <span class="posts-channel" title="Posts from Channel"><i class="fa fa-video-camera" aria-hidden="true"></i>{{$v->vscores}}</span>
                                    </div>
                                 </div>
                              </article>
                              @endforeach
                           </div>
                        </div>
                        <div class="item">
                           <div class="row auto-clear">
                              @foreach($rmtj as $v)
                              <article class="col-lg-2 col-md-4 col-sm-4">
                                 <div class="post post-medium">
                                    <div class="thumbr">
                                       <a class="post-thumb" href="{{url('home/play')}}?vid={{$v->vid}}">
                                       <img class="  img-responsive" src="{{url('uploads/Video')}}/{{ $v->logo }}" style="width: 240px; height: 115px;" alt="#">
                                       </a>
                                    </div>
                                    <div class="infor">
                                       <h4>
                                          <a class="title" href="{{url('home/play')}}?vid={{$v->vid}}">{{$v->vname}}</a>
                                       </h4>
                                       <span class="posts-channel" title="Posts from Channel"><i class="fa fa-video-camera" aria-hidden="true"></i>{{$v->vscores}}</span>
                                    </div>
                                 </div>
                              </article>
                              @endforeach
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
               <div class="clearfix"></div>
            </div>
         </div>
      </div>

@if(session('HomeUser')->roleid != 4)
  <script type="text/javascript">
    layer.open({
      type: 1,
      skin: 'layui-layer-rim', //加上边框
      area: ['560px', '560px'], //宽高
      content: "<img src='img/banners/1513051009.png'>"
    });
  </script>
@endif

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
@stop