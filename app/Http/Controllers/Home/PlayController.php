<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Video;
use App\Models\Home\User_Video;

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

        $uid=Session('HomeUser')->uid;

        $record['uid']=$uid;
        $record['vid']=$vid;

        $record_exists=User_Video::where('uid',$uid)->where('vid',$vid)->first();

        if(!$record_exists){

            //判断当前用户是否是vip用户
            if(Session('HomeUser')->roleid == 4){
                User_Video::create($record);
                return redirect("/home/play?vid=$vid");  
            }else{
                return redirect("/home/play?vid=$vid");  
            }

        }else{
            return redirect("/home/play?vid=$vid");  
        }
    }


}
