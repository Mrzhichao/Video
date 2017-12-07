<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ErrorController extends Controller
{
    //权限不足信息
    public function auth()
    {
    	return view('errors.auth',['title'=>'权限不足']);
    }
}
