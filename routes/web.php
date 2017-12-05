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


	//后台主页
	Route::get('index','IndexController@index');

		/*-----------------------------------Wang-----------------------------------*/
	
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
//广告路由
 Route::resource('admin/ad','Admin\AdController');


// //页面广告
//  Route::resource('admin/ad','Admin\AdController');

//广告路由AJAX
 Route::post('admin/ad/ajax','Admin\AdController@ajax');


//视频广告
 Route::resource('admin/vad','Admin\VadController');
 //视频广告路由AJAX
 Route::post('admin/vad/ajax','Admin\VadController@ajax');

//轮播视频管理
Route::resource('admin/carousel','Admin\CarouselController');

//轮播管理 AJAX
Route::post('admin/carousel/ajaxName','Admin\CarouselController@ajax');

//视频推荐管理
Route::get('admin/video/first','Admin\VideoRecommendController@first');



/*-----------------------------------SunnyHan-----------------------------------*/
//视频管理模块
Route::resource('video','VideoController');

//视频类别管理
Route::resource('videotype','VideoTypeController');

//视频类别类别排序
Route::post('videotype/changeorder','VideoTypeController@changeorder');

//视频类别ajax无刷新上传
Route::post('video/upload','VideoTypeController@upload');

//系统配置管理
Route::resource('sysconfig','SysconfigController');
Route::post('contentchange','SysconfigController@contentchange');

//友情链接管理
Route::resource('link','LinkController');

});