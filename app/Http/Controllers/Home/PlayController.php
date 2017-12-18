<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Video;
use App\Models\Admin\VideoAd;
use App\Models\Home\User_Video;


class PlayController extends Controller
{
    //视频播放页
    public function play()
    {
        $id = empty($_GET['vid']) ? '7':$_GET['vid'];

        //根据id查询数据库里面的视频并返回页面
        $data = Video::find($id);

        //浏览量
        static $numOfViewed=1;
        //和原来的浏览量相加
        $liulan =  $data['numOfViewed'] + $numOfViewed;

        //修改到数据库
        Video::find($id)->update(['numOfViewed'=>$liulan]);

        //查找视频广告
        $vad = VideoAd::where('videoid',$id)->first();

        return view('Home.play',compact('data','vad'));
    }


    //vip视频         播放记录
    public function vip()
    {
    	$vid=$_GET['vid'];

        if(!empty(Session('HomeUser'))){

            $uid=Session('HomeUser')->uid;

            $record['uid']=$uid;
            $record['vid']=$vid;

            $record_exists=User_Video::where('uid',$uid)->where('vid',$vid)->first();

            if(!$record_exists){
                User_Video::create($record);
            }
        }
        return redirect("/home/play?vid=$vid");  

    }


    //这个写在PlayController里
    public function down($id)
    {
        //定义下载量
        static $down = 1;
       
        //查询数据库
        $video = Video::find($id);
        if(empty( $video )){
            return rediretc('404');
        }
         //获取原下载量
        $xiazai =  $down + $video['numOfDownload'];

        //修改
        Video::find($id)->update(['numOfDownload'=>$xiazai]);
        //视频地址
        $pathFile = public_path().'/uploads/Video'.'/'.$video['resourceSrc'];
        
        //视频名字
        $name = $video['vname'];
        //响应内容
        $headers = ['Content-Type'=>'video/mp4'];
        // response()->headers->set('Content-type' , 'application/octet-stream');
        // response()->headers->set('Accept-Ranges', 'bytes');
        // response()->headers->set('Content-Disposition', 'attachment');
        return response()->download($pathFile,$name,$headers);
    }


}