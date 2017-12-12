@extends('Home.comm.layout')

@section('title')
 @parent
 首页
@stop
<!-- HOME 1 -->

@section('content')
 <!-- CORE -->
 <div class="row">
	<!-- SIDEBAR -->
	<div class="col-lg-2 col-md-4 hidden-sm hidden-xs">
	   <aside class="dark-bg">
		  <article>
			 <h2 class="icon"><i class="fa fa-flash" aria-hidden="true"></i>本站统计</h2>
			 <ul class="sidebar-links">
			 	@foreach($tongji as $k=>$v)
				<li class="fa fa-chevron-right"><a href="#{{$k}}">{{$k}}</a><span>{{$v}}00</span></li>
				@endforeach

				
			 </ul>
		  </article>
		  
		  
	   </aside>
	</div>
	<!-- 轮播图 -->	
	<div class=" col-lg-8 col-md-8 ">
		<div class="shutter">
		<div class="shutter-img">
		@foreach($car as $k=>$v)
		  <a href="{{url('home/play')}}?vid={{$v->vid}}" data-shutter-title="{{ $v->cname }}"><img src="{{ url('uploads/Video') }}/{{$v->vlogo}}" alt="加载失败"></a>
		@endforeach
		</div>
		<ul class="shutter-btn">
		  <li class="prev"></li>
		  <li class="next"></li>
		</ul>
		<div class="shutter-desc">
		  <p>Iron Man</p>
		</div>
		</div>
	</div>	




	<div class="col-lg-2 col-md-4 hidden-sm hidden-xs">
	   <aside class="dark-bg">
		  <article>
			 <h2 class="icon">广告信息</h2>
			 <ul class="sidebar-links">
			 	@foreach($Ad as $k=>$v)
				<li class="fa fa-chevron-right"><a href="{{ $v->acontent }}">{{$v->adesc}}</a><span>{{$v->aprice}}</span></li>
				@endforeach
				
			 </ul>
		  </article>
		  	

		  
	   </aside>
	</div>


 </div>



</div>
@stop

@section('main')
<!-- MAIN -->
<div id="main" class="container-fluid">
 <div class="container-fluid">
	<!-- SIDEBAR -->
	
	<!-- VIP影视 -->
	<div class="col-lg-12 col-md-12">
	   <!-- EDITORS CHOICE -->
	   <section id="editor-choice">
		  <h2 class="icon"><i class="fa fa-eye" aria-hidden="true"></i>VIP精选</h2>
		  <div class="row auto-clear">
			 <!-- MAIN POST -->
			 <div class="col-lg-6 col-md-12 col-sm-12">
				<!-- POST L size -->
				<article class="post post-medium main-large-post">
				   <div class="thumbr">
					  <div class="flag flag1"><i class="fa fa-star"></i></div>
					  <a class="post-thumb" href="{{url('home/play')}}?vid={{$oneVip['vid']}}" data-lity>
					  <span class="play-btn-border" title="Play"><i class="fa fa-play-circle headline-round" aria-hidden="true"></i></span>
					  <img class="img-responsive" src="{{ url('/uploads/Video') }}/{{$oneVip['logo'] }}" alt="加载失败">
					  </a>
					  <div class="infor">
						 <h4>
							<a class="title" href="{{ $oneVip['resourceSrc'] }}">{{ $oneVip['introduction'] }}</a>
						 </h4>
						 <span class="posts-txt" title="Posts from Channel"><i class="fa fa-thumbs-up" aria-hidden="true"></i>{{ $oneVip['numOfViewed'] }}</span>
						 <div class="ratings">
							 @if($oneVip['vscores'] < 2 )
							   <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								 	<i class="fa fa-star-o"></i>
								 	<i class="fa fa-star-o"></i>
								   <i class="fa fa-star-o"></i>
								  
							   </div>
							   @elseif($oneVip['vscores'] >=2 && $oneVip['vscores'] < 5)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								   <i class="fa fa-star-o"></i>
								  <i class="fa fa-star-o"></i>
								 
							   </div>
							   @elseif($oneVip['vscores'] >=5 && $oneVip['vscores'] < 7)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-o"></i>
							   </div>
							    @elseif($oneVip['vscores'] >=7 && $oneVip['vscores'] < 9)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-half"></i>
							   </div>
							    @elseif($oneVip['vscores'] > 9 )
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
							   </div>
							   @endif
						 </div>
						 <div class="vid-time-block">
							<div class="cactus-note ct-time font-size-1"><span>{{$oneVip['numOfDownload']}}</span></div>
						 </div>
					  </div>
				   </div>
				</article>
			 </div>
			 <!-- SMALL POSTS -->
			 <div class="col-lg-6 col-md-12 col-sm-12 editor-choice-small">
				<div class="row 3-right-posts">
					@foreach($Vip as $v)
				   <article class="col-sm-6 post post-medium small-post">
					  <div class="thumbr">
						 <div class="flag flag1"><i class="fa fa-star"></i></div>
						 <a class="post-thumb" href="{{url('home/play')}}?vid={{$v->vid}}" data-lity >
						 <span class="play-btn-border" title="Play"><i class="fa fa-play-circle headline-round" aria-hidden="true"></i></span>
						 <img class="img-responsive" src="{{ url('/uploads/Video') }}/{{$v->logo}}" alt="加载失败">
						 </a>
						 <div class="infor">
							<h4>
							   <a class="title" href="#">{{ $v->introduction }}</a>
							</h4>
							<div class="vid-time-block home-small-posts">
							   <span class="posts-txt" title="Posts from Channel"><i class="fa fa-thumbs-up" aria-hidden="true"></i>{{$v->numOfDownload}}</span>
							   <div class="ratings">
								  @if($v->vscores < 2 )
							   <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								 	<i class="fa fa-star-o"></i>
								 	<i class="fa fa-star-o"></i>
								   <i class="fa fa-star-o"></i>
								  
							   </div>
							   @elseif($v->vscores >=2 && $v->vscores < 5)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								   <i class="fa fa-star-o"></i>
								  <i class="fa fa-star-o"></i>
								 
							   </div>
							   @elseif($v->vscores >=5 && $v->vscores < 7)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-o"></i>
							   </div>
							    @elseif($v->vscores >=7 && $v->vscores < 9)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-half"></i>
							   </div>
							    @elseif($v->vscores > 9 )
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
							   </div>
							   @endif
							   </div>
							   <div class="cactus-note ct-time font-size-1"><span>{{ $v->numOfViewed }}</span></div>
							</div>
						 </div>
					  </div>
				   </article>
				   @endforeach
				</div>
			 </div>
		  </div>
	   </section>
	   <div class="clearfix"></div>
	   <!-- MAIN ROLL ADVERTISE BOX -->
	   
		<!-- 今日推荐---方 -->
 <div class="container-fluid ">
	<div class="col-md-12">
	   <!-- 今日推荐 -->
	   <section id="channels">
		  <div id="myCarousel" class="carousel slide" data-ride="carousel">
			 <h2 class="icon"><i class="fa fa-television" aria-hidden="true"></i>今日推荐</h2>
			 <div class="carousel-control-box">
				<a class="left carousel-control" href="#myCarousel"  role="button" data-slide="prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
				<a class="right carousel-control" href="#myCarousel"  role="button" data-slide="next"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
			 </div>
			 <!-- Wrapper for slides -->
			 <div class="carousel-inner" role="listbox">
				<div class="item active">
				   <div class="row auto-clear">
				   	@foreach($tj as $k=>$v)
					  <article class="col-lg-2 col-md-4 col-sm-4">
						 <div class="post post-medium">
							<div class="thumbr">
							   <a class="post-thumb" href="{{url('home/play')}}?vid={{$v->vid}}">
							   <img style="width: 180px;height: 130px;" class="img-responsive" src="{{ url('uploads/Video') }}/{{$v->logo}}" alt="#">
							   </a>
							</div>
							<div class="infor">
							   <h4>
								  <a class="title" href="{{url('home/play')}}?vid={{$v->vid}}">{{ $v->vname }}</a>
							   </h4>
							   <span class="posts-channel" title="Posts from Channel"><i class="fa fa-video-camera" aria-hidden="true"></i>{{$v->numOfViewed}}</span>
							</div>
						 </div>
					  </article>
					 @endforeach
					 
					 
					
				   </div>
				</div>
				<div class="item">
				   <div class="row auto-clear">
				   	@foreach($tj as $k=>$v)
					  <article class="col-lg-2 col-md-4 col-sm-4">
						 <div class="post post-medium">
							<div class="thumbr">
							   <a class="post-thumb" href="{{url('home/play')}}?vid={{$v->vid}}">
							   <img style="width: 180px;height: 130px;" class="img-responsive" src="{{ url('uploads/Video') }}/{{$v->logo}}" alt="#">
							   </a>
							</div>
							<div class="infor">
							   <h4>
								  <a class="title" href="{{url('home/play')}}?vid={{$v->vid}}">{{ $v->vname }}</a>
							   </h4>
							   <span class="posts-channel" title="Posts from Channel"><i class="fa fa-video-camera" aria-hidden="true"></i>{{$v->numOfViewed}}</span>
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



	
	 <!-- 排行榜 -->
	   <section id="main-reviews">
		  <div id="myCarousel2" class="carousel slide" data-ride="carousel">
			 <h2 class="icon"><i class="fa fa-star" aria-hidden="true"></i>排行榜</h2>
			 <div class="carousel-control-box">
				<a class="left carousel-control" href="#myCarousel2"  role="button" data-slide="prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
				<a class="right carousel-control" href="#myCarousel2"  role="button" data-slide="next"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
			 </div>
			 <!-- Wrapper for slides -->
			 <div class="carousel-inner" role="listbox">
				<div class="item active">
				   <div class="row auto-clear">
				   	 @foreach($first as $k=>$v)
					  <article class="reviews col-lg-2 col-md-4 col-sm-4">
						 <!-- POST L size -->
						 <div class="post post-medium">
							<a class="thumbr post-thumb" href="{{url('home/play')}}?vid={{$v->vid}}">
							<span class="review-number">{{$v->vscores}}</span>
							<img src="{{ url('/uploads/Video') }}/{{ $v->logo }}" style="width: 256px; height: 160px;" class="review img-responsive" alt="Client">
							</a>
							<div class="infor">
							   <h4>
								  <a class="title" href="{{url('home/play')}}?vid={{$v->vid}}">{{$v->vname}}</a>
							   </h4>
							    @if($v->vscores < 2 )
							   <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								 	<i class="fa fa-star-o"></i>
								 	<i class="fa fa-star-o"></i>
								   <i class="fa fa-star-o"></i>
								  
							   </div>
							   @elseif($v->vscores >=2 && $v->vscores < 5)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								   <i class="fa fa-star-o"></i>
								  <i class="fa fa-star-o"></i>
								 
							   </div>
							   @elseif($v->vscores >=5 && $v->vscores < 7)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-o"></i>
							   </div>
							    @elseif($v->vscores >=7 && $v->vscores < 9)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-half"></i>
							   </div>
							    @elseif($v->vscores > 9 )
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
					  </article>
					@endforeach
				   </div>
				</div>
				<div class="item">
				   <div class="item active">
				   <div class="row auto-clear">
				   	 @foreach($first as $k=>$v)
					  <article class="reviews col-lg-2 col-md-4 col-sm-4">
						 <!-- POST L size -->
						 <div class="post post-medium">
							<a class="thumbr post-thumb" href="{{url('home/play')}}?vid={{$v->vid}}">
							<span class="review-number">{{$v->vscores}}</span>
							<img src="{{ url('/uploads/Video') }}/{{ $v->logo }}" style="width: 256px; height: 160px;" class="review img-responsive" alt="Client">
							</a>
							<div class="infor">
							   <h4>
								  <a class="title" href="{{url('home/play')}}?vid={{$v->vid}}">{{$v->vname}}</a>
							   </h4>
							    @if($v->vscores < 2 )
							   <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								 	<i class="fa fa-star-o"></i>
								 	<i class="fa fa-star-o"></i>
								   <i class="fa fa-star-o"></i>
								  
							   </div>
							   @elseif($v->vscores >=2 && $v->vscores < 5)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								   <i class="fa fa-star-o"></i>
								  <i class="fa fa-star-o"></i>
								 
							   </div>
							   @elseif($v->vscores >=5 && $v->vscores < 7)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-o"></i>
							   </div>
							    @elseif($v->vscores >=7 && $v->vscores < 9)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-half"></i>
							   </div>
							    @elseif($v->vscores > 9 )
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
					  </article>
					@endforeach
				   </div>
				</div>
				</div>
			 </div>
		  </div>
	   </section>
	
 	   <div class="clearfix"></div>





	   <!-- 电影精选 -->
	   <section id="cur-view">
	   <a name="电影资源" id="电影资源"></a>
		  <h2 class="icon"><i class="fa fa-trophy" aria-hidden="true"></i>电影精选</h2>
		  <div class="row auto-clear">
			 <!-- POST L size -->
			 @foreach($dyjx as $v)
			 <article class="col-lg-2 col-md-4 col-sm-6 post post-medium">
				<div class="thumbr">
				   <a class="post-thumb" href="{{url('home/play')}}?vid={{$v->vid}}" data-lity>
					  <span class="play-btn-border" title="Play"><i class="fa fa-play-circle headline-round" aria-hidden="true"></i></span>
					  <div class="cactus-note ct-time font-size-1"><span>{{$v->vscores}}</span></div>
					  <img class="img-responsive" style="width: 180px; height: 200px;" src="{{url('/uploads/Video')}}/{{$v->logo}}" alt="#">
				   </a>
				</div>
				<div class="infor">
				   <h4>
					  <a class="title" href="{{url('home/play')}}?vid={{$v->vid}}">{{$v->vname}}</a>
				   </h4>
				   <span class="posts-txt" title="Posts from Channel"><i class="fa fa-thumbs-up" aria-hidden="true"></i>{{$v->numOfViewed}}</span>
				   <div class="ratings">
					  @if($v->vscores < 2 )
							   <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								 	<i class="fa fa-star-o"></i>
								 	<i class="fa fa-star-o"></i>
								   <i class="fa fa-star-o"></i>
								  
							   </div>
							   @elseif($v->vscores >=2 && $v->vscores < 5)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								   <i class="fa fa-star-o"></i>
								  <i class="fa fa-star-o"></i>
								 
							   </div>
							   @elseif($v->vscores >=5 && $v->vscores < 7)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-o"></i>
							   </div>
							    @elseif($v->vscores >=7 && $v->vscores < 9)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-half"></i>
							   </div>
							    @elseif($v->vscores > 9 )
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
			 </article>
			 @endforeach
		  </div>
	   </section>
	   <div class="clearfix spacer"></div>
	    <!-- 电视精选 -->
	   <section id="cur-view">
	    <a name="电视资源" id="电视资源">
		  <h2 class="icon"><i class="fa fa-trophy" aria-hidden="true"></i>热门剧场</h2>
		  <div class="row auto-clear">
			 <!-- POST L size -->
			 @foreach($dsjx as $v)
			 <article class="col-lg-2 col-md-4 col-sm-6 post post-medium">
				<div class="thumbr">
				   <a class="post-thumb" href="{{url('home/play')}}?vid={{$v->vid}}" data-lity>
					  <span class="play-btn-border" title="Play"><i class="fa fa-play-circle headline-round" aria-hidden="true"></i></span>
					  <div class="cactus-note ct-time font-size-1"><span>{{$v->vscores}}</span></div>
					  <img class="img-responsive" style="width: 180px; height: 200px;" src="{{url('/uploads/Video')}}/{{$v->logo}}" alt="#">
				   </a>
				</div>
				<div class="infor">
				   <h4>
					  <a class="title" href="{{url('home/play')}}?vid={{$v->vid}}">{{$v->vname}}</a>
				   </h4>
				   <span class="posts-txt" title="Posts from Channel"><i class="fa fa-thumbs-up" aria-hidden="true"></i>{{$v->numOfViewed}}</span>
				   <div class="ratings">
					  @if($v->vscores < 2 )
							   <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								 	<i class="fa fa-star-o"></i>
								 	<i class="fa fa-star-o"></i>
								   <i class="fa fa-star-o"></i>
								  
							   </div>
							   @elseif($v->vscores >=2 && $v->vscores < 5)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								   <i class="fa fa-star-o"></i>
								  <i class="fa fa-star-o"></i>
								 
							   </div>
							   @elseif($v->vscores >=5 && $v->vscores < 7)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-o"></i>
							   </div>
							    @elseif($v->vscores >=7 && $v->vscores < 9)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-half"></i>
							   </div>
							    @elseif($v->vscores > 9 )
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
			 </article>
			 @endforeach
		  </div>
	   </section>
	   <div class="clearfix spacer"></div>
	    <!-- 娱乐精选 -->
	   <section id="cur-view">
	    <a name="娱乐资源" id="娱乐资源">
		  <h2 class="icon"><i class="fa fa-trophy" aria-hidden="true"></i>娱乐排行</h2>
		  <div class="row auto-clear">
			 <!-- POST L size -->
			 @foreach($yljx as $v)
			 <article class="col-lg-2 col-md-4 col-sm-6 post post-medium">
				<div class="thumbr">
				   <a class="post-thumb" href="{{url('home/play')}}?vid={{$v->vid}}" data-lity>
					  <span class="play-btn-border" title="Play"><i class="fa fa-play-circle headline-round" aria-hidden="true"></i></span>
					  <div class="cactus-note ct-time font-size-1"><span>{{$v->vscores}}</span></div>
					  <img class="img-responsive" style="width: 180px; height: 200px;" src="{{url('/uploads/Video')}}/{{$v->logo}}" alt="#">
				   </a>
				</div>
				<div class="infor">
				   <h4>
					  <a class="title" href="{{url('home/play')}}?vid={{$v->vid}}">{{$v->vname}}</a>
				   </h4>
				   <span class="posts-txt" title="Posts from Channel"><i class="fa fa-thumbs-up" aria-hidden="true"></i>{{$v->numOfViewed}}</span>
				   <div class="ratings">
					  @if($v->vscores < 2 )
							   <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								 	<i class="fa fa-star-o"></i>
								 	<i class="fa fa-star-o"></i>
								   <i class="fa fa-star-o"></i>
								  
							   </div>
							   @elseif($v->vscores >=2 && $v->vscores < 5)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								   <i class="fa fa-star-o"></i>
								  <i class="fa fa-star-o"></i>
								 
							   </div>
							   @elseif($v->vscores >=5 && $v->vscores < 7)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-o"></i>
							   </div>
							    @elseif($v->vscores >=7 && $v->vscores < 9)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-half"></i>
							   </div>
							    @elseif($v->vscores > 9 )
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
			 </article>
			 @endforeach
		  </div>
	   </section>
	   <div class="clearfix spacer"></div>
	    <!-- 新闻精选 -->
	   <section id="cur-view">
	    <a name="新闻资源" id="新闻资源">
		  <h2 class="icon"><i class="fa fa-trophy" aria-hidden="true"></i>热门新闻</h2>
		  <div class="row auto-clear">
			 <!-- POST L size -->
			 @foreach($xwjx as $v)
			 <article class="col-lg-2 col-md-4 col-sm-6 post post-medium">
				<div class="thumbr">
				   <a class="post-thumb" href="{{url('home/play')}}?vid={{$v->vid}}" data-lity>
					  <span class="play-btn-border" title="Play"><i class="fa fa-play-circle headline-round" aria-hidden="true"></i></span>
					  <div class="cactus-note ct-time font-size-1"><span>{{$v->vscores}}</span></div>
					  <img class="img-responsive" style="width: 180px; height: 200px;" src="{{url('/uploads/Video')}}/{{$v->logo}}" alt="#">
				   </a>
				</div>
				<div class="infor">
				   <h4>
					  <a class="title" href="{{url('home/play')}}?vid={{$v->vid}}">{{$v->vname}}</a>
				   </h4>
				   <span class="posts-txt" title="Posts from Channel"><i class="fa fa-thumbs-up" aria-hidden="true"></i>{{$v->numOfViewed}}</span>
				   <div class="ratings">
					  @if($v->vscores < 2 )
							   <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								 	<i class="fa fa-star-o"></i>
								 	<i class="fa fa-star-o"></i>
								   <i class="fa fa-star-o"></i>
								  
							   </div>
							   @elseif($v->vscores >=2 && $v->vscores < 5)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								   <i class="fa fa-star-o"></i>
								  <i class="fa fa-star-o"></i>
								 
							   </div>
							   @elseif($v->vscores >=5 && $v->vscores < 7)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-o"></i>
							   </div>
							    @elseif($v->vscores >=7 && $v->vscores < 9)
							    <div class="ratings">

								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star" aria-hidden="true"></i>
								  <i class="fa fa-star-half-o" aria-hidden="true"></i>
								  <i class="fa fa-star-half"></i>
							   </div>
							    @elseif($v->vscores > 9 )
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
			 </article>
			 @endforeach
		  </div>
	   </section>
	

	<!-- 广告欣赏 -->
  <section id="cur-view">
		  <h2 class="icon"><i class="fa fa-star" aria-hidden="true"></i>广告欣赏</h2>(点击投放)
		  <div class="row auto-clear">
			 <!-- POST L size -->
			@foreach($Ad as $k=>$v)
					  <article class="col-lg-2 col-md-4 col-sm-4">
						 <div class="post post-medium">
							<div class="thumbr">
							   <a class="post-thumb" href="http://wpa.qq.com/msgrd?v=3&uin=1239099896&site=qq&menu=yes">
							   <img style="width: 540px; height: 180px;border-radius:25%; " class="img-responsive" src="{{ url('uploads/Ad') }}/{{$v->aimg}}" alt="#">
							   </a>
							</div>
							<div class="infor">
							   <h4>
								  <a class="title" href="{{ $v->acontent }}">{{ $v->adesc }}</a>
							   </h4>
							  
							</div>
						 </div>
					  </article>
					 @endforeach
		  </div>
	   </section>
	
	  
<div class="clearfix spacer"></div>



@stop
