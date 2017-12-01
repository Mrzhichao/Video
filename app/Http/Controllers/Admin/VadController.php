<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\VideoAd;

class VadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * 添加视频广告
     * @author:Mrlu
     * @date:2017/12/01 
     * @return 返回一个添加模板 并把视频名称和标题传递过去
     */
    public function create()
    {
        //获取视频的id
        $id = $_GET['vid'];
        //获取视频的信息
        $data =  VideoAd::find($id)->video;
        
        return view('Admin.Vad.create',['title'=>'视频广告添加','data'=>$data]);
      


    }

     /**
     * 上传 并处理 视频广告
     * @author:Mrlu
     * @date:2017/12/01 
     * @param:请求的信息
     * @return 成功返回到首页 失败返回到添加页面
     */
    public function store(Request $request)
    {
         //验证表单
        $this->validate($request, [
            'vpath' => 'required|size:5000',
            'vredirect' => 'required|max:50|url',
            'startTime' => 'required|date',
            'endTime' => 'required|date',
            'vprice' => 'required',
        ],[
            'vpath.required' => '请上传一个小视频',
            'vpath.size' => '视频不得超过5M',
            'vredirect.required' => '请填写URL链接',
            'vredirect.max' => '长度不能超过100',
            'vredirect.url' => '请填写正确的URL地址',
            'startTime.required' => '请选择开始时间哦',
            'startTime.data' => '请选择有效时间哦',
            'endTime.required' => '请选择结束时间哦',
            'endTime.data' => '请选择有效时间哦',
            'vprice.required' => '请点击金额进行计算o.o ',

        ]);


        //获取文件的信息
          
          //判断是否有上传
        if($request->hasFile("vpth")){
            //获取上传信息
            $file = $request->file("vpath");
            //确认上传的文件是否成功
            if($file->isValid()){
                $ext = $file->getClientOriginalExtension(); //获取上传文件名的后缀名
                //执行移动上传文件
                $filename = 'V'.time().rand(1000,9999).".".$ext;
                $file->move("./uploads/Vad/",$filename);
               
            }

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
        //
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
        //
    }
}
