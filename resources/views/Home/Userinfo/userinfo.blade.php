<!DOCTYPE html>
<html>

   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

      <title>个人资料</title>

      <link href="{{ asset('/userinfo/AmazeUI-2.4.2/assets/css/admin.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ asset('/userinfo/AmazeUI-2.4.2/assets/css/amazeui.css') }}" rel="stylesheet" type="text/css">

      <link href="{{ asset('/userinfo/css/personal.css')}}" rel="stylesheet" type="text/css">
      <link href="{{ asset('/userinfo/css/infstyle.css')}}" rel="stylesheet" type="text/css">
      <script src="{{ asset('userinfo/AmazeUI-2.4.2/assets/js/jquery.min.js') }}" type="text/javascript'"></script>
      <script src="{{ asset('userinfo/AmazeUI-2.4.2/assets/js/amazeui.js') }}" type="text/javascript"></script>
         
   </head>

   <body>
      <!--头 -->
      <header>
         <article>
            <div class="mt-logo">
               <!--顶部导航条 -->
               <div class="am-container header">
                  <ul class="message-l">
                     <div class="topMessage">
                        <div class="menu-hd">
                           <a href="#" target="_top" class="h">亲，请登录</a>
                           <a href="#" target="_top">免费注册</a>
                        </div>
                     </div>
                  </ul>
                  <ul class="message-r">
                     <div class="topMessage home">
                        <div class="menu-hd"><a href="#" target="_top" class="h">商城首页</a></div>
                     </div>
                     <div class="topMessage my-shangcheng">
                        <div class="menu-hd MyShangcheng"><a href="#" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
                     </div>
                     <div class="topMessage mini-cart">
                        <div class="menu-hd"><a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
                     </div>
                     <div class="topMessage favorite">
                        <div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
                  </ul>
                  </div>

                  <!--悬浮搜索框-->

                  <div class="nav white">
                     <div class="logoBig">
                        <img src="/userinfo/images/logobig.png" />
                     </div>

                     <div class="search-bar pr">
                        <a name="index_none_header_sysc" href="#"></a>
                        <form>
                           <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
                           <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
                        </form>
                     </div>
                  </div>

                  <div class="clear"></div>
               </div>
            </div>
         </article>
      </header>
            <div class="nav-table">
                  <div class="long-title"><span class="all-goods">全部分类</span></div>
                  <div class="nav-cont">
                     <ul>
                        <li class="index"><a href="#">首页</a></li>
                                <li class="qc"><a href="#">闪购</a></li>
                                <li class="qc"><a href="#">限时抢</a></li>
                                <li class="qc"><a href="#">团购</a></li>
                                <li class="qc last"><a href="#">大包装</a></li>
                     </ul>
                      <div class="nav-extra">
                        <i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
                        <i class="am-icon-angle-right" style="padding-left: 10px;"></i>
                      </div>
                  </div>
         </div>
         <b class="line"></b>
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
                  <a href="index.html">个人中心</a>
               </li>
               <li class="person">
                  <a href="#">个人资料</a>
                  <ul>
                     <li class="active"> <a href="">个人信息</a></li>
                     <li> <a href="safety.html">安全设置</a></li>
                     <li> <a href="address.html">收货地址</a></li>
                  </ul>
               </li>
               <li class="person">
                  <a href="#">我的交易</a>
                  <ul>
                     <li><a href="order.html">订单管理</a></li>
                     <li> <a href="change.html">退款售后</a></li>
                  </ul>
               </li>
               <li class="person">
                  <a href="#">我的资产</a>
                  <ul>
                     <li> <a href="coupon.html">优惠券 </a></li>
                     <li> <a href="bonus.html">红包</a></li>
                     <li> <a href="bill.html">账单明细</a></li>
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