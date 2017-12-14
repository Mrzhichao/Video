<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Video;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Filters\Video\ResizeFilter;

use App\Models\Admin\Video;

class UploadController extends Controller
{
    //上传调试
    public function index(Request $request)
    {

		$file = $request -> file('upload');
        if($file->isValid()){
	        $entension = $file->getClientOriginalExtension();//上传文件的后缀名
	        $newName = 'V'.time().mt_rand(1000,9999).'.'.$entension;
	     	$newJPG = strstr($newName,'.',-1).'.jpg';
			$ffmpeg = FFMpeg::create(
				[
			    'ffmpeg.binaries'  => '../vendor/bin/ffmpeg/bin/ffmpeg.exe',
			    'ffprobe.binaries' => '../vendor/bin/ffprobe.exe' ,
			    'timeout'=> 3600, // The timeout for the underlying process
    			'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
			],null
				);
			//打开视频
			$video = $ffmpeg->open($file);
			//截取第10秒的片
			$video
	            ->frame(TimeCode::fromSeconds(10))
	            ->save(public_path().'/uploads/test/'.$newJPG);
	      //   //调整视频大小
	      //   $video->filters()->resize(new Dimension(320, 240),ResizeFilter::RESIZEMODE_INSET,false);
	      //   $res =  $video ->save(public_path().'/uploads/test/'.$newName);
	      // echo $res;

	        // //上传到本地服务器的方法
	        $path = $file->move(public_path().'/uploads/test/',$newName);
	      //上传数据库
	       $aa =  new Video;

	       $aa -> uname = \Session::get();
	       $aa -> userid = \Session::get();
	       $aa -> logo = $newJPG;
	       $aa -> resourceSrc = $newName;
	       //typeid 随机分配
	       $aa -> typeid = rand(4,8);
	       //名字随机分配
	       $aa -> vname = str_rand(7);

	       //上映时间
	       $aa -> publicTime = time();
	       //下映时间 一个礼拜
	       $aa -> projectionTime = $time()+(3600*24*7);
	       //随机VIP
	       $aa -> isVip = rand(0,1);
	       //视频简介 随机
	       $aa -> introduction = str_rand(107);
	       //评分 随机
	       $aa -> vscores = rand(1.1,8.7);
	       //保存
	       $res = $aa -> save();

	       if($res){
	       		echo '上传成功';
	       }else{
	       		echo '上传失败';
	       }
   
	    }

	   



   	}
}
