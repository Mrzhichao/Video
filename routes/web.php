<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*-------------------------------------------后台---------------------------------------------*/

	/*-----------------------------------Wang-----------------------------------*/
	//后台登录
	//验证码路由
	Route::get('admin/yzm','Admin\LoginController@yzm');

	//登录页面显示
	Route::get('admin/login','Admin\LoginController@login');

	//执行登录
	Route::post('admin/dologin','Admin\LoginController@dologin');


Route::group(['middleware'=>['CheckLogin','hasrole'],'prefix'=>'admin','namespace'=>'Admin'],function (){


	/*-----------------------------------Wang-----------------------------------*/

	//后台主页
	Route::get('index','IndexController@index');	
	
	//退出登录
	Route::get('loginout','LoginController@loginout');

	//后台管理员路由
	Route::resource('admin','AdminController');
	
	//后台用户模块
	Route::resource('user','UserController');
	
	//用户详情路由
	Route::resource('userinfo','UserinfoController');

	//用户ajax状态路由
	Route::post('ajax/ajaxstatus', 'AjaxController@ajaxStatus');

	//管理员ajax状态路由
	Route::post('ajax/adminajaxstatus', 'AjaxController@adminajaxStatus');

	//视频评论路由
	Route::resource('videoreview','ReviewController');

	//评论回复路由
	Route::resource('videoreply','ReplyController');


	/*-----------------------------------Mrlu-----------------------------------*/

	//广告路由AJAX
	Route::post('ad/ajax','AdController@ajax');
	//广告路由
 	Route::resource('ad','AdController');

	//视频广告
	Route::resource('vad','VadController');
	//视频广告路由AJAX
	Route::post('vad/ajax','VadController@ajax');

	//轮播视频管理
	Route::resource('carousel','CarouselController');
	//轮播管理 AJAX
	Route::post('carousel/ajaxName','CarouselController@ajax');

	//角色管理
	Route::resource('role','RoleController');
	//角色授权
	Route::get('role/auth/{id}','RoleController@auth');
	Route::post('role/auth','RoleController@doauth');
	
	//权限管理
	Route::resource('auth','AuthController');
	//授权路由
	Route::get('admin/auth/{id}','AdminController@auth');
	Route::post('admin/auth','AdminController@doauth');

	//导航管理
	Route::resource('nav','NavController');
	//导航描述 AJAX修改
	Route::post('nav/ajaxNdesc','NavController@ajaxNdesc');
	//导航名字 AJAX修改
	Route::post('nav/ajaxName','NavController@ajaxName');
	//导航路径 AJAX修改
	Route::post('nav/ajaxNsrc','NavController@ajaxNsrc');


	/*-----------------------------------SunnyHan-----------------------------------*/
	
	//视频管理
	Route::resource('video','VideoController');
	//视频ajax无刷新排序
	Route::post('video/changeorder','VideoController@changeOrder');
	//视频ajax无刷新修改
	Route::post('video/img/ajax/edit','VideoController@img_ajax_edit');
	//视频ajax无刷新上传
	Route::post('video/img/ajax/upload','VideoController@img_ajax_upload');


	//类别管理
	Route::resource('videotype','VideoTypeController');
	//类别ajax无刷新排序
	Route::post('videotype/changeorder','VideoTypeController@changeOrder');


	//系统配置管理
	Route::resource('sysconfig','SysconfigController');
	Route::post('sysconfig/changeorder','SysconfigController@changeOrder');
	Route::post('sysconfig/putfile','SysconfigController@putFile');
	Route::post('sysconfig/contentchange','SysconfigController@contentChange');
	Route::post('sysconfig/status/ajax/update','SysconfigController@config_status_ajax_update');
	Route::post('sysconfig/content/ajax/update','SysconfigController@config_content_ajax_update');
	Route::post('sysconfig/delmore','SysconfigController@delmore');


	//友情链接管理
	Route::resource('link','LinkController');
	Route::post('link/changeorder','LinkController@changeorder');

});


/*-----------------------------------------------前台-----------------------------------------------*/

	/*-----------------------------------MrLu-----------------------------------*/
	
	//前台首页
	Route::get('/','Home\indexController@index');
	
	//前台首页搜索
	Route::get('home/search','Home\indexController@search');
	
	//报错路由  权限不足
	Route::get('admin/error/auth','ErrorController@auth');

	//视频推荐
	Route::post('home/video/tj','Home\VideoRecommendController@tj');
	//取消视频推荐
	Route::post('home/video/qx','Home\VideoRecommendController@qx');
	//推荐管理
	Route::get('home/video/first','Home\VideoRecommendController@first');


	//下载视频
	Route::get('home/down/{id}','Home\playController@down')->middleware('Cors');


	/*-----------------------------------Wang-----------------------------------*/
	
	//前台登录页面
	Route::get('home/login','Home\LoginController@Login');
	Route::post('home/dologin','Home\LoginController@doLogin');

	//前台手机邮箱注册路由
	Route::get('home/phoneregister','Home\RegisterController@PhoneRegister');
	//执行注册
	Route::post('home/dophoneregister','Home\RegisterController@doPhoneRegister');
	//发送验证码路由ajax
	Route::post('home/sendcode','Home\RegisterController@Sendcode');
	//邮箱激活
	Route::get('home/active','Home\RegisterController@Email');
	//忘记密码
	Route::get('home/forget','Home\RegisterController@Forget');
	//发送忘记密码邮件
	Route::post('home/doforget','Home\RegisterController@doForget');
	//重置密码
	Route::get('home/reset','Home\RegisterController@Reset');
	//修改密码
	Route::post('home/doreset','Home\RegisterController@doReset');


	Route::group(['middleware'=>'HomeLogin','prefix'=>'home','namespace'=>'Home'],function (){
		//个人中心路由
		Route::resource('userinfo','UserinfoController');
		//播放记录
		Route::resource('uservideo','UservideoController');

		//上传显示页
		Route::get('video/add','UploadController@add');

		//用户个人信息AJAX
		Route::post('userinfo/eidt','UploadController@Uploads');

		//上传视频
		Route::post('video/doadd','UploadController@doadd');
	});


	/*-----------------------------------SunnyHan-----------------------------------*/

	//销毁Session
	Route::get('home/video/destroy_session','Home\VideoController@destroy_session');


	//vip视频
	Route::get('home/video/vip','Home\VideoController@vip');	
Route::group(['prefix'=>'home','namespace'=>'Home'],function (){
	//普通视频
	Route::resource('video','VideoController');
	//多条件搜索
	Route::post('video/type/ajax','VideoController@type_ajax');
});


	//普通视频播放
	Route::get('home/play','Home\PlayController@play');
	//vip 视频播放    播放记录
	Route::get('home/vip_play','Home\PlayController@vip');