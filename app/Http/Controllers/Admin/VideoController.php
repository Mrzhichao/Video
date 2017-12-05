<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Video;

use App\Models\Admin\VideoType;

use Illuminate\Database\Eloquent\Collection;

use Intervention\Image\ImageManagerStatic as Image;

class VideoController extends Controller
{
    /**
     * 视频首页
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

         $title='视频首页';

         $keywords=$request->input('search');

         //渴求式加载多个关联关系
         $videos = Video::with('users','types')->where('vname','like',"%".$keywords."%")->paginate(5); 
         //dd($videos);
         
         //二级分类显示所有视频分类
         $types =  (new VideoType) -> tree(); 
         //dd($types);

         return view('Admin.Video.index',['videos'=>$videos,'title'=>$title,'types'=>$types,'where'=>['search'=>$keywords] ]);  
    }


    /**''
     * 添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='视频添加';

        //多级分类
        // $items =  (new Video) -> getTypeInfo();
        // foreach ($items as $key => $item) {
        //     $types[]=$item;        
        // }
        
        //二级分类显示所有视频分类
        $types =  (new VideoType) -> tree(); 

        return view('Admin.Video.add',compact(['title','types']) );
    }


    /**
     * 添加操作
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

                            'typeid' => 'required',

                            'vname' => 'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:5,8',  //只允许数字和字母
                            'uname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:1,5',

                            'publicTime' => 'required',
                            'projectionTime' => 'required',

                            'logo'=>'required',
                            'keywords'=>'required',
                            'typeid'=>'required',
                            'resourceSrc'=>'required',
                            'introduction'=>'required',

                        ],

                        [
                            
                            'typeid.required'=>'视频类型为必选项',

                            'vname.required'=>'视频名称为必选项',
                            'vname.regex'=>'视频名称只允许数字和字母',
                            'vname.between'=>'视频只能为5--8位的名称',

                            'uname.required'=>'上传者为必选项',
                            'uname.regex'=>'上传者只允许数字和字母',
                            'uname.between'=>'上传者只能为1--5位的名称',

                            'publicTime.required'=>'视频上映时间为必选项',
                            'projectionTime.required'=>'视频下映时间为必选项',
                            
                            
                            'logo.required'=>'必须上传视频图片',
                            'keywords.required'=>'视频关键词不能为空',
                            'typeid.required'=>'请选择视频类型',
                            'resourceSrc.required'=>'视频路径不能为空',
                            'introduction.required'=>'视频简介不能为空',

                        ]
        );

        //判断是否有上传
        if($request->hasFile("logo")){
            //获取上传信息
            $file = $request->file("logo");
            //确认上传的文件是否成功
            if($file->isValid()){
                //$picname = $file->getClientOriginalName(); //获取上传原文件名
                $ext = $file->getClientOriginalExtension(); //获取上传文件名的后缀名
                //执行移动上传文件
                $filename = time().rand(1000,9999).".".$ext;

                $file->move("./Admin/Uploads/Videos/",$filename);
              
               $img = Image::make("./Admin/Uploads/Videos/".$filename)->resize(100,100);
               $img->save("./Admin/Uploads/Videos/v_".$filename); //另存为
            }

        }
    
        $input = $request->except('_token','art_thumb');

        $input['logo'] = $filename;
        $input['publicTime']=strtotime($request->publicTime);
        $input['projectionTime']=strtotime($request->projectionTime);
        $input['isVip']=0;
        $input['type_order']=1;
        $input['userid']=1;
        $input['vscores']=0;
        
        $res = Video::create($input);

        if($res){
            return redirect('admin/video');
        }else{
            return back();
        }


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * 修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = '视频修改';
        $video = Video::find($id);
        $types=VideoType::get();

        return view('Admin.Video.edit',['video'=>$video,'types'=>$types,'title'=>$title]);
    }


    /**
     * 修改操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vid)
    {
        $video = Video::find($vid);
        $input = $request->except('_token','_method');
        
       //过滤掉空数据
       foreach($input as $k=>&$v){
            if(!$v){unset($input[$k]); }
       }

        if( !empty( $request->publicTime ) ){
            $input['publicTime']=strtotime($request->publicTime);
        }
        if( !empty( $request->projectionTime ) ){
             $input['projectionTime']=strtotime($request->projectionTime); 
        }

        if(!empty($request->logo)){
            if($request->hasFile("logo")){
                $file = $request->file("logo");
                if($file->isValid()){
                    $ext = $file->getClientOriginalExtension(); 
                    $filename = time().rand(1000,9999).".".$ext;
                    $file->move("./Admin/Uploads/Videos/",$filename);
                    $img = Image::make("./Admin/Uploads/Videos/".$filename)->resize(100,100);
                    $img->save("./Admin/Uploads/Videos/v_".$filename); //另存为
                }
            }
            $input['logo'] = $filename;
        }

        $res = $video->update($input);
        if($res){
            return redirect('admin/video');
        }else{
            return redirect('admin/video/'.$video->vid.'/edit');
        }

    }


    /**
     * 删除操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Video::find($id)->delete();
        $data = [];
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
     * 上传图片
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function upload(Request $request)
    {

         //获取客户端传过来的文件
         $file = $request->file('file_upload');
         //$file = $request->all();
         //dd($file);

        if($file->isValid()){
            //        获取文件上传对象的后缀名
            $ext = $file->getClientOriginalExtension();

            //生成一个唯一的文件名，保证所有的文件不重名
            $newfile = time().rand(1000,9999).uniqid().'.'.$ext;

            //设置上传文件的目录
            $dirpath = public_path().'/uploads/';

            //将文件移动到本地服务器的指定的位置，并以新文件名命名
            //$file->move(移动到的目录, 新文件名);
           $file->move($dirpath, $newfile);

            //将上传的图片名称返回到前台，目的是前台显示图片
            return $newfile;

        }

    }

}
