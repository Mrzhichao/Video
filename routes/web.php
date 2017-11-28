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

// Route::get('/', function () {
//     return view('welcome');
// });

/**
 *
 */
//后台首页
route::get('/',function()
	{
		return view('Admin.index',['title'=>'后台主页']);
	});

//广告模块的增删改查
 Route::resource('admin/ad','Admin\AdController');
