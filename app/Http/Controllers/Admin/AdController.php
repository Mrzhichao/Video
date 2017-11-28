<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\advertisement;
use Intervention\Image\ImageManagerStatic as Image; 



class AdController extends Controller
{
    /**
     * 显示广告所有的信息
     * @author:Mrlu
     * @date:2017/11/28
     * @返回一个广告主页的模板和标题,广告信息
     */
    public function index()
    {
        //查询数据库
        $data = advertisement::where('adesc','like','%a%')->paginate(10);
        

         return view('Admin.Ad.index',['title'=>'广告预览','data'=>$data]);
    }

    /**
     * 广告添加模块
     * @author:Mrlu
     * @date:2017/11/28 
     * @return 返回一个添加模板 并把用户名和标题传递过去
     */
    public function create()
    {
        // $uid = $_GET['id']; 查询哪个用户添加的广告
         $aid = 1; //假的
        // $uid = DB::table('data_users')->where('uid',$uid)->first(); //获取前台用户名并发送
        $user = advertisement::find($aid)->post;
        $aname = $user -> aname;

         return view('Admin.Ad.create',['title'=>'广告添加','aid'=>$aid,'aname'=>$aname]);
         
    }



    /**
     * 将用户添加的信息处理后写入数据库
     * @author:Mrlu
     * @date:2017/11/28
     * @param:表单中数据请求的集合
     * @return 成功返回主页  失败返回back()
     */
    public function store(Request $request)
    {

        //验证表单
        
        $this->validate($request, [
            'adesc' => 'required|max:50',
            'acontent' => 'required|max:100|url',
            'aimg' => 'image|required',
            'startTime' => 'required',
            'endTime' => 'required',
            'aprice' => 'required',
        ],[
            'adesc.required' => '请填写描述信息',
            'adesc.max' => '长度不能超过50',
            'acontent.required' => '请填写URL链接',
            'acontent.max' => '长度不能超过100',
            'acontent.url' => '请填写正确的URL地址',
            'aimg.image' => '请上传图片类广告哦',
            'aimg.required' => '请上传广告图片哦',
            'startTime.required' => '请选择开始时间哦',
            'endTime.required' => '请选择结束时间哦',
            'aprice.required' => '请点击金额进行计算o.o ',

        ]);

        //获取文件的信息
          
          //判断是否有上传
        if($request->hasFile("aimg")){
            //获取上传信息
            $file = $request->file("aimg");
            //确认上传的文件是否成功
            if($file->isValid()){
                $ext = $file->getClientOriginalExtension(); //获取上传文件名的后缀名
                //执行移动上传文件
                $filename = 'Ad'.time().rand(1000,9999).".".$ext;
                $file->move("./uploads/Ad/",$filename);
                
                //压缩图片
                 $img = Image::make("./uploads/Ad/".$filename)->resize(60,40);
                 $img->save("./uploads/Ad/s_".$filename);

               
            }
        }
        



        //获取数据
        $data = $request -> except('_token','aimg');

        //处理时间
        $data['startTime'] = strtotime($data['startTime']);
        $data['endTime'] = strtotime($data['endTime']);
        $data['aimg'] = $filename; 

        $res = advertisement::create($data);
        if($res){
            //如果添加成功 跳到广告主页
            return redirect('admin/ad');
        }else{
            //失败 返回上一个页面
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
