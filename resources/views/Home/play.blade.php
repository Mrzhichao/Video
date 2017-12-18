
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

                       

                        video: [//视频地址列表形式
                          ["{{url('uploads/Video')}}/{{$data['resourceSrc']}}", 'video/mp4', '中文标清', 0],
                          ],


                      };
                    var player = new ckplayer(videoObject);
                  </script>

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

                              <span class="meta-i">
                              <i class="fa fa-download"></i>{{$data['numOfDownload']}}
                              </span>

                              <div class="ratings">
                                 @if($data['vscores'] < 2 )
                        <div class="ratings">

                          <li></li>
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
<li class="social-google-plus" id="down"><a class="fa fa-download social-icons" href="{{url('home/down')}}/{{$data['vid']}}"></a></li><br><br>
              

                     分享到：          <!-- 分享按钮 -->
                   <div class="bdsharebuttonbox"> 

                   <a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                   </div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>


                             
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
                  <h2 class="title">leave comment</h2>
                  <div class="widget-area">
                     <div class="status-upload">
                        <form>
                           <textarea placeholder="Your comment goes here" ></textarea>
                           <div class="comment-box-control">
                              <ul>
                                 <li><a title="" data-placement="bottom" data-original-title="Video"><i class="fa fa-video-camera"></i></a></li>
                                 <li><a title="" data-placement="bottom" data-original-title="Picture"><i class="fa fa-picture-o"></i></a></li>
                                 <li><a title="" data-placement="bottom" data-original-title="Smile"><i class="fa fa-smile-o"></i></a></li>
                              </ul>
                              <button type="submit" class="btn pull-right"><i class="fa fa-share"></i> post comment</button>
                           </div>
                        </form>
                     </div><!-- Status Upload  -->
                  </div><!-- Widget Area -->
                  
                  
                  <div class="row comment-posts">
                     <div class="col-sm-1">
                        <div class="thumbnail">
                           <img class="img-responsive user-photo" src="img/thumbs/thumb-review.jpg" alt="Comment User Avatar">
                        </div>
                     </div>

                     <div class="col-sm-11">
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <strong>John Doe</strong> <span class="pull-right">commented 5 days ago</span>
                           </div>
                           <div class="panel-body">
                              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting
                           </div>
                        </div>
                     </div>
                  
                     <div class="col-sm-1">
                        <div class="thumbnail">
                           <img class="img-responsive user-photo" src="img/thumbs/thumb-review.jpg" alt="Comment User Avatar">
                        </div>
                     </div>

                     <div class="col-sm-11">
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <strong>John Doe</strong> <span class="pull-right">commented 5 days ago</span>
                           </div>
                           <div class="panel-body">
                              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting
                           </div>
                        </div>
                     </div>
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
      
      @stop