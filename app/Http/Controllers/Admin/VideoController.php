<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Video;

use Intervention\Image\ImageManagerStatic as Image;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $title='视频首页';

        $keywords=$request->input('search');

        $data = Video::where('vname','like',"%".$keywords."%")->paginate(10); 

        return view('Admin.Video.index',['data'=>$data,'title'=>$title,'where'=>['search'=>$keywords] ]);  //放置到视图中 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='视频添加';
        return view('Admin.Video.add',['title'=>$title]);
    }

    /**
     * Store a newly created resource in storage.
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

                            'userid' => 'required',
                            'typeid' => 'required',

                            'vname' => 'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:5,8',  //只允许数字和字母

                            'publicTime' => 'required',
                            'projectionTime' => 'required',

                            'logo'=>'required',
                            'keywords'=>'required',
                            
                            'resourceSrc'=>'required',
                            'introduction'=>'required',

                        ],

                        [
                            'userid.required'=>'用户不能为空',
                            'typeid.required'=>'视频类型为必选项',

                            'vname.required'=>'视频名称为必选项',
                            'vname.regex'=>'视频名称只允许数字和字母',
                            'vname.between'=>'视频只能为5--8位的名称',

                            'publicTime.required'=>'视频上映时间为必选项',
                            'projectionTime.required'=>'视频下映时间为必选项',
                            
                            
                            'logo.required'=>'必须上传视频图片',
                            'keywords.required'=>'视频关键词不能为空',

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
    
        $input = $request->except('_token');

        $input['logo'] = $filename;
        $input['publicTime']=strtotime($request->publicTime);
        $input['projectionTime']=strtotime($request->projectionTime);
        $input['isVip']=0;

        //dd($input);
        //添加数据的方法一：通过模型的save方法添加一条数据到数据表中
//        $user = new User();
//        $user->username = $input['username'];
//        $res = $user->save();//是否成功的状态，是bool类型的

        //添加数据的方法二：create方法添加一条数据到数据表中
        $res = Video::create($input);
        //dd($res);//刚添加到数据表中的那条数据

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::find($id);
        $title = '视频修改';
        return view('Admin.Video.edit',['video'=>$video,'title'=>$title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$title = '视频删除';
        echo $id;die;
        $flight = Video::find($id);
        $flight -> delete();
    }
}
