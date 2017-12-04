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



//后台首页
route::get('/',function()
	{
		return view('Admin.index',['title'=>'ºóÌ¨Ö÷Ò³']);
	});

//ºóÌ¨ÓÃ»§Ä£¿é
// Route::resource('admin/')


//后台用户模块
Route::resource('admin/user','Admin\UserController');


//页面广告
 Route::resource('admin/ad','Admin\AdController');
//视频广告
 Route::resource('admin/vad','Admin\VadController');
//视频广告管理 AJAX
Route::post('admin/carousel/ajaxName','Admin\CarouselController@ajax');

//视频管理模块
Route::resource('admin/video','Admin\VideoController');

//轮播视频管理
Route::resource('admin/carousel','Admin\CarouselController');
//轮播管理 AJAX
Route::post('admin/carousel/ajaxName','Admin\CarouselController@ajax');