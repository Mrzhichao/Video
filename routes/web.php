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



//��̨��ҳ
route::get('/',function()
	{
		return view('Admin.index',['title'=>'��̨��ҳ']);
	});

//��̨�û�ģ��
// Route::resource('admin/')


//ǰ̨̨�û�ģ��
Route::resource('admin/user','Admin\UserController');

//�û���״̬�����ajax
Route::post('/admin/ajax/ajaxstatus', 'Admin\AjaxController@ajaxStatus');



//���ģ�����ɾ�Ĳ�
 Route::resource('admin/ad','Admin\AdController');


Route::resource('admin/video','Admin\VideoController');
