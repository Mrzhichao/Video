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



//后台主页
Route::get('/',function(){
	return view('Admin.index',['title'=>'后台首页']);
});



/*-----------------------------------Wang-----------------------------------*/
//后台登录
//验证码路由
Route::get('admin/yzm','Admin\LoginController@yzm');

//登录页面显示
Route::get('admin/login','Admin\LoginController@login');

//执行登录
Route::post('admin/dologin','Admin\LoginController@dologin');

//退出登录
Route::get('admin/loginout','Admin\LoginController@loginout');

//后台管理员路由
Route::resource('admin/admin','Admin\AdminController');

//后台用户模块
Route::resource('admin/user','Admin\UserController');

//用户详情路由
Route::resource('admin/userinfo','Admin\UserinfoController');

//用户ajax状态路由
Route::post('/admin/ajax/ajaxstatus', 'Admin\AjaxController@ajaxStatus');

//管理员ajax状态路由
Route::post('/admin/ajax/adminajaxstatus', 'Admin\AjaxController@adminajaxStatus');

//视频评论路由
Route::resource('admin/videoreview','Admin\ReviewController');



/*-----------------------------------Mrlu-----------------------------------*/
//广告路由
 Route::resource('admin/ad','Admin\AdController');

//页面广告
 Route::resource('admin/ad','Admin\AdController');

//视频广告
 Route::resource('admin/vad','Admin\VadController');

//轮播视频管理
Route::resource('admin/carousel','Admin\CarouselController');

//轮播管理 AJAX
Route::post('admin/carousel/ajaxName','Admin\CarouselController@ajax');




/*-----------------------------------SunnyHan-----------------------------------*/
//视频管理模块
Route::resource('admin/video','Admin\VideoController');

//视频类别管理
Route::resource('admin/videotype','Admin\VideoTypeController');

//视频类别类别排序
Route::post('/admin/videotype/changeorder','Admin\VideoTypeController@changeorder');

//视频类别ajax无刷新上传
Route::post('/admin/video/upload','Admin\VideoTypeController@upload');

//系统配置管理
Route::resource('admin/sysconfig','Admin\SysconfigController');
Route::post('admin/contentchange','Admin\SysconfigController@contentchange');

//友情链接管理
Route::resource('admin/link','Admin\LinkController');
