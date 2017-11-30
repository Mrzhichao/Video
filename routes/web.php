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
		return view('Admin.index',['title'=>'后台主页']);
	});

//后台用户模块
// Route::resource('admin/')


//前台台用户模块
Route::resource('admin/user','Admin\UserController');

//用户的状态管理的ajax
Route::post('/admin/ajax/ajaxstatus', 'Admin\AjaxController@ajaxStatus');



//广告模块的增删改查
 Route::resource('admin/ad','Admin\AdController');


Route::resource('admin/video','Admin\VideoController');
