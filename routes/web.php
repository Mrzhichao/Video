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



//ºóÌ¨Ê×Ò³
route::get('/',function()
	{
		return view('Admin.index',['title'=>'ºóÌ¨Ö÷Ò³']);
	});

//ºóÌ¨ÓÃ»§Ä£¿é
// Route::resource('admin/')


//Ç°Ì¨ÓÃ»§Ä£¿é
Route::resource('admin/user','Admin\UserController');




//¹ã¸æÄ£¿éµÄÔöÉ¾¸Ä²é
 Route::resource('admin/ad','Admin\AdController');


Route::resource('admin/video','Admin\VideoController');
Route::resource('admin/videotype','Admin\VideoTypeController');

Route::post('/admin/videotype/changeorder','Admin\VideoTypeController@changeorder');

Route::post('/admin/videotype/upload','Admin\VideoTypeController@upload');
