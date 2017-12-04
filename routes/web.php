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
Route::get('/',function()
	{
		return view('Admin.index',['title'=>'潞贸脤篓脢脳脪鲁']);
	});


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


//用户模块路由
Route::resource('admin/user','Admin\UserController');

//用户详情路由
Route::resource('admin/userinfo','Admin\UserinfoController');



//用户ajax状态路由
Route::post('/admin/ajax/ajaxstatus', 'Admin\AjaxController@ajaxStatus');
//管理员ajax状态路由
Route::post('/admin/ajax/adminajaxstatus', 'Admin\AjaxController@adminajaxStatus');




//广告路由
 Route::resource('admin/ad','Admin\AdController');


//视频路由
Route::resource('admin/video','Admin\VideoController');

//视频评论路由
Route::resource('admin/videoreview','Admin\ReviewController');
