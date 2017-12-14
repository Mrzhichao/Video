<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\VideoAd;
use App\Models\Admin\Video;

class VadController extends Controller
{
     /**
     * 浏览视频广告
     * @author:Mrlu
     * @date:2017/12/01 
     * @return 返回一个浏览模板 广告信息 .标题传递过去
     */
    public function index()
    {
        $title = '视频广告浏览页面';    
       
       $min = empty($_GET['min']) ? '' : $_GET['min'];
       $max = empty($_GET['max']) ? '' : $_GET['max'];

        
        // //查询数据库

        $data = VideoAd::with('video')->paginate(8);
       
       
        return view('Admin.Vad.index',['title'=>$title,'data'=>$data]);
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
        $data =  Video::find($id);
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
            'vpath' => 'required|max:5000',
            'vredirect' => 'required|max:50|url',
            'vprice' => 'required',
        ],[
            'vpath.required' => '请上传一个小视频',
            'vpath.max' => '视频不得超过5M',
            'vredirect.required' => '请填写URL链接',
            'vredirect.max' => '长度不能超过50',
            'vredirect.url' => '请填写正确的URL地址',
            'vprice.required' => '请重新选择时间哦'
        ]);

      
        //获取提交数据
        $data = $request -> except('_token','method','aname');

        //获取文件的信息
          
          //判断是否有上传
        if($request->hasFile("vpath")){ //vpath是表单字段
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

        //获取文件名
        $data['vpath'] = $filename;

        $res = VideoAd::create($data);

        if($res){
            //如果添加成功 跳到主页
            return redirect('admin/vad')->with('msg','成功添加');
        }else{
            //失败 返回添加页面
            return redirect('admin/vad/create')->with('msg','添加失败');
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

    }

     /**
     * 编辑页面 视频广告
     * @author:Mrlu
     * @date:2017/12/01 
     * @param:某条信息
     * @return 返回一组数据和一个编辑模板
     */
    public function edit($id)
    {
        $data = VideoAd::find($id);

        return view('Admin.Vad.edit',['title'=>'视频广告修改','data'=>$data]);
    }

    /**
     * 修改数据库 视频广告
     * @author:Mrlu
     * @date:2017/12/01 
     * @param:id 某条信息
     * @return 成功返回主页 失败返回主页
     */
    public function update(Request $request, $id)
    {
        //表单验证
        
        $this->validate($request, [
            'vredirect' => 'required|max:50|url',
            'vtime' => 'required',
            'vprice' => 'required',
        ],[
            'vredirect.required' => '请填写URL链接',
            'vredirect.max' => '长度不能超过50',
            'vredirect.url' => '请填写正确的URL地址',
            'vtime.required' => '请选择投放时间哦',
            'vprice.required' => '请重新选择时间哦'
        ]);

        //获取数据
        $data = $request -> except('_token','method');

        //过滤空数据
            foreach($data as $k=>&$v){
                if(!$data[$k]){
                    unset($data[$k]); 
                }
            }
        //传入数据库
        $res = VideoAd::find($id) -> update($data);

        if($res){
            //如果添加成功 跳到主页
            return redirect('admin/vad')->with('msg','更新添加');
        }else{
            //失败 返回添加页面
            return redirect('admin/vad')->with('msg','更新失败');
        }

    }

    /**
     * 删除数据库里面的某条信息
     * @author:Mrlu
     * @date:2017/12/01 
     * @param:id 某条信息
     * @return 成功返回主页 失败返回主页
     */
    public function destroy($id)
    {
        //删除数据
        $res = VideoAd::find($id)->delete();
        if($res){
            echo '删除成功';
         }else{
            echo '删除失败';
         }
    }

    /**
     * ajax修改图片
     * @author:Mrlu
     * @date:2017/12/4
     * @param:表单和ID
     * @return 返回图片的路径
     */
    public function ajax(Request $request)
    {
        //获取id
        $id = $request->id; 
        $file = $request -> file('upload');
        if($file->isValid()){
        $entension = $file->getClientOriginalExtension();//上传文件的后缀名
        $newName = 'V'.time().mt_rand(1000,9999).'.'.$entension;
        //上传到本地服务器的方法
        $path = $file->move(public_path().'/uploads/Vad/',$newName);

        //移动成功后 修改数据库并删除老图片
        $oldImg = VideoAd::find($id);
        if($oldImg->vpath){
            //如果文件存在就删除
            if(file_exists('uploads/Ad/'.$oldImg->vpath)){
                unlink('/uploads/Ad/'.$oldImg->vpath);
            }
        }
       //修改数据库
        // $oldImg -> vpath = $newName;
        VideoAd::find($id) -> update(['vpath'=>$newName]);
        //将上传文件的路径返回给浏览器客户端
        $filepath = 'uploads/Vad/'.$newName;
        return $filepath;
        }
       
       
    }
}
