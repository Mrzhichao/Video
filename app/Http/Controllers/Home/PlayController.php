<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Video;
use App\Models\Admin\VideoAd;

class PlayController extends Controller
{
    //播放页
    public function play()
    {
    	$id = empty($_GET['vid']) ? '7':$_GET['vid'];

    	//根据id查询数据库里面的视频并返回页面
    	$data = Video::find($id);

    	//查找视频广告
    	$vad = VideoAd::where('videoid',$id)->first();

        
    	return view('Home.play',compact('data','vad'));
    }
}
