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

//后台登录
	//验证码路由
	Route::get('admin/yzm','Admin\LoginController@yzm');

	//登录页面显示
	Route::get('admin/login','Admin\LoginController@login');

	//执行登录
	Route::post('admin/dologin','Admin\LoginController@dologin');


	// Route::get('/',function(){
	// 	return view('Admin.index',['title'=>'后台首页']);
	// });

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
	
	//后台授权路由
	Route::get('admin/auth/{id}','AdminController@auth');
	Route::post('admin/auth','AdminController@doauth');
	//权限管理
	Route::resource('auth','AuthController');

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
	
	//视频ajax无刷新时间判断
	Route::post('video/time','VideoController@time');


	//视频类别管理
	Route::resource('videotype','VideoTypeController');


	//视频类别无刷新排序
	Route::post('videotype/changeorder','VideoTypeController@changeOrder');




	//系统配置管理
	Route::resource('sysconfig','SysconfigController');
	Route::post('contentchange','SysconfigController@contentchange');




	//友情链接管理
	Route::resource('link','LinkController');
	Route::post('link/changeorder','LinkController@changeorder');

});

/*-----------------------------------Mrlu-----------------------------------*/

//报错路由  权限不足
Route::get('admin/error/auth','ErrorController@auth');

//视频推荐
Route::post('home/video/tj','Home\VideoRecommendController@tj');
//取消视频推荐
Route::post('home/video/qx','Home\VideoRecommendController@qx');

//前台首页
Route::get('/','Home\indexController@index');
//前台首页搜索
Route::get('home/search','Home\indexController@search');

//播放页
Route::get('home/play','Home\PlayController@play');

//上传调试
Route::post('home/test','Home\UploadController@index');


