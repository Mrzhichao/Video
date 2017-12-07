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

Route::group(['middleware'=>'CheckLogin','prefix'=>'admin','namespace'=>'Admin'],function (){

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

	//视频推荐管理
	Route::get('video/first','VideoRecommendController@first');



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
