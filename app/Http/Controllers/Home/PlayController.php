<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Video;

class PlayController extends Controller
{
    //播放页
    public function play()
    {
    	$id = empty($_GET['vid']) ? '7':$_GET['vid'];

    	//根据id查询数据库里面的视频并返回页面
    	$data = Video::find($id);


    	return view('Home.play',compact('data'));
    }

    public function vip_play()
    {
    	$vid=$_GET['vid'];
    	$rid=Session('HomeUser')->rid;

    	if($rid == 4){
    		return redirect("/home/play?vid=$vid");  
    	}else{
    		return redirect('/');
    	}

    }
}
