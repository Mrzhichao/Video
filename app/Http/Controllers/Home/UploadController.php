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
use Illuminate\Support\Facades\Session;

class UploadController extends Controller
{

	//显示页
	public function add()
	{
		return view('Home.Userinfo.uploadvideo');
	}


    //上传调试
    public function doadd(Request $request)
    {

		$file = $request -> file('upload');
        if($file->isValid()){
	        $entension = $file->getClientOriginalExtension();//上传文件的后缀名
	        $newName = 'V'.time().mt_rand(1000,9999).'.'.$entension;
	     	$newJPG = strstr($newName,'.',-1).'.jpg';
			$ffmpeg = FFMpeg::create(
				[
			    'ffmpeg.binaries'  => '../vendor/bin/ffmpeg.exe',
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
	            ->save(public_path().'/uploads/Uploadvideo/'.$newJPG);
	      //   //调整视频大小
	      //   $video->filters()->resize(new Dimension(320, 240),ResizeFilter::RESIZEMODE_INSET,false);
	      //   $res =  $video ->save(public_path().'/uploads/test/'.$newName);
	      // echo $res;

	        // //上传到本地服务器的方法
	        $path = $file->move(public_path().'/uploads/Uploadvideo/',$newName);
	      //上传数据库
	       // $aa =  new Video;
	       $video = new Video;

	       $video -> uname = $request->session()->get('HomeUser')-	> uname;
	       // var_dump($userid);
	       $video -> userid = $request->session()->get('HomeUser')-> uid;

	     	// var_dump($video -> userid);
	       $video -> logo = $newJPG;
	       $video -> resourceSrc = $newName;
	       // //typeid 随机分配
	       $video -> typeid = rand(4,8);
	       // //名字随机分配
	       $video -> vname = $newName;

	       // //上映时间
	       $video -> publicTime = time();
	       // //下映时间 一个礼拜
	       $video -> projectionTime = time()+(3600*24*7);
	       // //随机VIP
	       $video -> isVip = rand(0,1);
	       // //视频简介 随机
	       // $aa -> introduction = rand(1000,9000);
	       // //评分 随机
	       $video -> vscores = rand(1.1,8.7);
	       // //保存
	       $res = $video -> save();

	      $data= [];
	        if($res){
	            $data['error']=0;
	            $data['msg']='上传成功';
	            // echo '删除成功';
	            // return redirect('admin/user')->with('msg','删除成功');
	        }else{
	            $data['error']=1;
	            $data['msg']='上传失败';
	          // echo '删除失败';
	            // return back()->with('msg','修改失败');
	        }

        	return $data;
   
	    }
   	}
}
