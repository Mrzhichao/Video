<?php

namespace App\Http\Controllers\Home;


use App\Models\Admin\Video;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Filters\Video\ResizeFilter;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\User;

class UploadController extends Controller
{

	//显示页
	public function add()
	{
		
		return view('Home.Userinfo.uploadvideo');
	}


    //执行上传
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

	            ->save(public_path().'/uploads/Video/'.$newJPG);

	      //   //调整视频大小
	      //   $video->filters()->resize(new Dimension(320, 240),ResizeFilter::RESIZEMODE_INSET,false);
	      //   $res =  $video ->save(public_path().'/uploads/test/'.$newName);
	      // echo $res;

	        // //上传到本地服务器的方法

	        $path = $file->move(public_path().'/uploads/Video/',$newName);

	      //上传数据库
	       // $aa =  new Video;
	       $video = new Video;


	       $video -> uname = $request->session()->get('HomeUser')-> uname;

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

   	//用户上传图片ajax
   	
   	public function Uploads(Request $request)
   	{
   		$id = $request -> id;

   		 // 获取客户端传过来的文件
        $file = $request->file('upload');
        // return($file);
   
        if($file->isValid()){
            //        获取文件上传对象的后缀名
            $ext = $file->getClientOriginalExtension();

            //生成一个唯一的文件名，保证所有的文件不重名
            $newfile = time().rand(1000,9999).uniqid().'.'.$ext;
            //设置上传文件的目录
            $dirpath = public_path().'/uploads/user';
            // return $dirpath;
            //将文件移动到本地服务器的指定的位置，并以新文件名命名
//            $file->move(移动到的目录, 新文件名);
            $file->move($dirpath, $newfile);
            //将上传的图片名称返回到前台，目的是前台显示图片
            //压缩图片
         Image::make($dirpath.'/'.$newfile)->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($dirpath."/s_".$newfile)->response("jpg");
            // return "./uploads/user".$newfile;
        $res = User::where('uid',$id)->update(['avatar'=>$newfile]); 

        $data= [];
	        if($res){
	            $data['error']=0;
	            $data['msg']='上传成功';
	            return $data;
	            // echo '删除成功';
	            // return redirect('admin/user')->with('msg','删除成功');
	        }else{
	            $data['error']=1;
	            $data['msg']='上传失败';
	            return $data;
	          // echo '删除失败';
	            // return back()->with('msg','修改失败');
	        }


        // return $newfile;
   		}   		
	}
}
