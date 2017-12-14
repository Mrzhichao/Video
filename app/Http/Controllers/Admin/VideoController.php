<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Video;

use App\Models\Admin\VideoType;
use App\Models\Home\VideoRecommend as vr;
use Illuminate\Database\Eloquent\Collection;

use Intervention\Image\ImageManagerStatic as Image;


use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Filters\Video\ResizeFilter;

class VideoController extends Controller
{
    //视频名字
     public $filename;
    //图片名字
     public $logo;


    /**
     *  视频首页
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $title='视频首页';

         $keywords=$request->input('search');
         $type=$request->input('type');

         if(!empty($type)){
            //渴求式加载多个关联关系
            $videos = Video::with('users','types')->where('vname','like',"%".$keywords."%")->where('vid',$type)->orderby('type_order','asc')->paginate(1); 
         }else{
            $videos = Video::with('users','types')->where('vname','like',"%".$keywords."%")->orderby('type_order','asc')->paginate(1); 
         }

         //dd($videos);
         
         //二级分类显示所有视频分类
         $types =  (new VideoType) -> tree(); 
         //dd($types);

         return view('Admin.Video.index',['videos'=>$videos,'title'=>$title,'types'=>$types,'where'=>['type'=>$type,'search'=>$keywords] ]);  
    }


     /**
     * ajax无刷新条件查询
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tj_ajax(){

    }    


    /**
     *  添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='视频添加';

        $types =  (new VideoType) -> tree(); 
        
        if( !empty($_GET['id']) ){
            $type=VideoType::find($_GET['id'])->vtid;
            return view('Admin.Video.add',['title'=>$title,'types'=>$types,'type'=>$type] );
        }
    
        //多级分类
        // $items =  (new Video) -> getTypeInfo();
        // foreach ($items as $key => $item) {
        //     $types[]=$item;        
        // }
        //二级分类显示所有视频分类
         
        //dd($types);
        
        return view('Admin.Video.add',['title'=>$title,'types'=>$types] );
    }


    /**
     *  添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //验证
        $this->validate(
            $request, 
            [
                'vname' => 'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:1,5',  //只允许数字和字母

                'publicTime' => 'required',
                'projectionTime' => 'required',

                //'logo'=>'required',
                'keywords'=>'required',
                'resourceSrc'=>'required',
                'introduction'=>'required',
            ],

            [
                'vname.required'=>'视频名称为必选项',
                'vname.regex'=>'视频名称只允许数字和字母',
                'vname.between'=>'视频只能为1--5位的名称',

                'publicTime.required'=>'视频上映时间为必选项',
                'projectionTime.required'=>'视频下映时间为必选项',
                
                //'logo.required'=>'必须上传视频图片',
                'keywords.required'=>'视频关键词不能为空',
                'resourceSrc.required'=>'视频路径不能为空',
                'introduction.required'=>'视频简介不能为空',
            ]
        );

        // //判断是否有上传
        // if($request->hasFile("resourceSrc")){
        //     //获取上传信息
        //     $file = $request->file("resourceSrc");
        //     //确认上传的文件是否成功
        //     if($file->isValid()){
        //         //$picname = $file->getClientOriginalName(); //获取上传原文件名
        //         $ext = $file->getClientOriginalExtension(); //获取上传文件名的后缀名
        //         //执行移动上传文件
        //         $filename = $this->filename;
        //         //清空
        //         $this->filename = '';
        //         $file->move("./Uploads/Video/",$filename);
              
        //         // $img = Image::make("./Uploads/Video/".$filename)->resize(100,100);

        //         // $img->save("./Uploads/Video/v_".$filename); //另存为
        //     }
        // }
    
        $input = $request->except('_token','art_thumb','logo','resourceSrc');
        $input['userid']=Session('user')->aid;
        $input['uname']=Session('user')->aname;
        $input['type_order']=1;

        $input['isVip']=0;
        $input['numOfDownload']=0;
        $input['numOfViewed']=0;
        $input['vscores']=100;
        $input['publicTime']=strtotime($request->publicTime);
        $input['projectionTime']=strtotime($request->projectionTime);
        $input['resourceSrc'] = \Session::get('filename');
        $input['logo'] = \Session::get('logo');
        \Session::put('filename','');
        \Session::put('logo','');
        $input['type_order']=1;
        $res = Video::create($input);

        if($res){
            return redirect('admin/video');
        }else{
            return back();
        }

    }


    /**
     *  视频详情页
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title='视频详情页';

      
        
        $video=Video::with('users','types')->find($id);
        //dd($video);
        // 获取推荐的内容
        $vr = vr::get();

        //判断视频是否已经推荐
        foreach($vr as $v){
            if(!empty($v->videoid)){
                $em = true;
            }else{
                $em = false;
            }
        }

        return view('Admin.Video.detail',compact(['video','title','em']));
    }


    /**
     *  视频修改页
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = '视频修改';

        $video = Video::find($id);
        $types=VideoType::get();
        $aname=Session('user')->aname;

        return view('Admin.Video.edit',['video'=>$video,'types'=>$types,'aname'=>$aname,'title'=>$title,'id'=>$id]);
    }


    /**
     *  修改操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vid)
    {
        $input = $request->except('_token','_method','vimg','logo');
        
        //过滤掉空数据
        foreach($input as $k=>&$v){
            if(!$v){unset($input[$k]); }
        }

        if( !empty($request->publicTime) ){
            $input['publicTime']=strtotime($request->publicTime);
        }

        if( !empty($request->projectionTime) ){
             $input['projectionTime']=strtotime($request->projectionTime); 
        }
        $input['logo'] = \Session::get('logo');
        $input['resourceSrc'] = \Session::get('filename');
        \Session::put('filename');
        \Session::put('logo');
        $res = Video::find($vid)->update($input);
        if($res){
            return redirect('admin/video');
        }else{
            return redirect('admin/video/'.$video->vid.'/edit');
        }

    }


    /**
     *  删除操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = [];

        $res = Video::find($id)->delete();
        if($res){
            $data['error'] = 0;
            $data['msg'] ="删除成功";
        }else{
            $data['error'] = 1;
            $data['msg'] ="删除失败";
        }

        return $data;
    }
   

    /**
     *  ajax排序操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeOrder(Request $request)
    {
        $vid = $request->input('vid');
        //要修改的值
        $type_order = $request->input('type_order');

        $cate = Video::find($vid);
        $res = $cate->update(['type_order'=>$type_order]);

        if($res){
            $data =[
                'status'=> 0,
                'msg'=>'修改成功'
            ];
        }else{
            $data =[
                'status'=> 1,
                'msg'=>'修改失败'
            ];
        }

          return $data;
    }


    /**
     *  ajax时间控制
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function time(Request $request)
    {
        $publicTime = strtotime($request->input('publicTime'));
        $projectionTime = strtotime($request->input('projectionTime')); 

            if($publicTime < $projectionTime){
                $data =[
                    'status'=> 0,
                ];
            }else{
                $data =[
                    'status'=> 1,
                    'msg'=>'结束时间不能小于发布时间'
                ];
            }

          return $data;
    }


     /**
     * ajax修改图片
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function img_ajax_edit(Request $request)
    {
        //获取id
        $id = $request->id; 
        $file = $request -> file('upload');
        if($file->isValid()){
            $entension = $file->getClientOriginalExtension();//上传文件的后缀名
            $newName = time().mt_rand(1000,9999).'.'.$entension;




            //上传到本地服务器的方法
          

              // 拼装文件名
            \Session::put('filename',$newName);
 

            \Session::put('logo',strstr(\Session::get('filename'),'.',-1).'.jpg');
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
                ->frame(TimeCode::fromSeconds(4))
                ->save(public_path().'/uploads/Video/'.\Session::get('logo'));


             $file->move(public_path().'/uploads/Video/',\Session::get('filename'));
            // //压缩图片
            // $img = Image::make("./Uploads/Video/".$newName)->resize(100,100);
            // $img->save("./Uploads/Video/small_".$newName); //另存为

            //移动成功后 修改数据库并删除老图片
            $video = Video::find($id);

            if($video){
                //如果文件存在就删除
                $oldImge=$video->logo;
                $oldSP = $video->resourceSrc;
                if(file_exists(public_path().'/uploads/Video/'.$oldImge)){
                   
                    if( unlink(public_path().'/uploads/Video/'.$oldImge) &&  unlink(public_path().'/Uploads/Video/'.$oldSP) ){
                        //修改数据库
                        Video::find($id) -> update(['logo'=>\Session::get('logo'),'resourceSrc'=>\Session::get('filename')]); 
                    }  
                }
            }
           
            //将上传文件的路径返回给浏览器客户端
            return \Session::get('logo');
        }

    }


    /**
     *  ajax无刷新上传
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function img_ajax_upload(Request $request)
    {
        // $old_img=$require->input('old_img');
        // dd($old_img);

        $file = $request->file('resourceSrc');
        // 验证
        $check = $this->checkFile($file);
        if(!$check['status']){
            return response()->json(['ServerStatus' => '400','ResultData' => $check['msg']]);
        }
        // 获取文件路径
        $transverse_pic = $file->getRealPath();
        // public路径
        $path = public_path().'/uploads/Video/';
        // 获取后缀名
        $postfix = $file->getClientOriginalExtension();
        // 拼装文件名
        \Session::put('filename',md5(time().rand(0,10000)).'.'.$postfix);
 

         \Session::put('logo',strstr(\Session::get('filename'),'.',-1).'.jpg');
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
                ->frame(TimeCode::fromSeconds(4))
                ->save($path.\Session::get('logo'));


        // 移动
        if(!$file->move($path,\Session::get('filename'))){
            return response()->json(['ServerStatus' => '400','ResultData' => '文件保存失败']);
        }
        // 删除之前的图片文件
        
        //if(unlink('old_img')){
            return response()->json(['ServerStatus' => '200','ResultData' => \Session::get('logo')]);
        // }

    }


    private function checkFile($file)
    {
        if (!$file->isValid()) {
            return ['status' => false, 'msg' => '文件上传失败'];
        }

        if ($file->getClientSize() > $file->getMaxFilesize()) {
            return ['status' => false, 'msg' => '文件大小不能大于2M'];
        }

        return ['status' => true];
    }


}