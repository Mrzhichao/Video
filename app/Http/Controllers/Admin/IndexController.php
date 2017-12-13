<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;

class IndexController extends Controller
{
   	public function index()
   	{
   		$aid=Session('user')->aid;
        $admin=Admin::find($aid);
        
   		return view('Admin.index',['title'=>'后台首页','admin'=>$admin]);
   	}
}
