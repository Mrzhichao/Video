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

//�û�ģ��
Route::resource('admin/user','Admin\UserController');




//���ģ�����ɾ�Ĳ�
 Route::resource('admin/ad','Admin\AdController');

