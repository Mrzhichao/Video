<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Carousel;

class CarouselController extends Controller
{
    /**
     * 浏览轮播视频界面
     * @author:Mrlu
     * @date:2017/11/30
     * 
     * @返回一个视频轮播浏览的模板和标题 
     */
    public function index()
    {
        // //获取关键字搜索
        $namekey = empty($_GET['keywords']) ? '' : $_GET['keywords']; 
        
        // //查询数据库
        $data =Carousel::where('cname','like','%'.$namekey.'%')->paginate(8); 

       //将查询到的用户名放进数组
      
        return view('Admin.Carousel.index',['title'=>'广告预览','data'=>$data])->with('namekey',['aname'=>$namekey]);

    }

    /**
     * 添加轮播视频界面
     * @author:Mrlu
     * @date:2017/11/30
     * 
     * @返回一个视频轮播添加的模板和标题 查询的视频的信息
     */
    public function create()
    {
        //标题
        $title = '视频轮播添加';
        //通过编号获取视频的名称
        $id = $_GET['vid']; 
        // dd($id);
        $data = Carousel::find($id)->video;
         // dd($data);
        //返回
        return view('Admin.Carousel.create',['title'=>$title,'data'=>$data]);
        
    }

    /**
     * 将轮播视频信息写入数据库
     * @author:Mrlu
     * @date:2017/11/30
     * @param:表单中数据请求的集合
     * @return 成功返回主页  失败返回添加页
     */
    public function store(Request $request)
    {
        //表单验证
         $this->validate($request, [
            'cname' => 'required|max:50',
            'credirect' => 'required|url',
        ],[
            'cname.required' => '请填写轮播名称',
            'canme.max' => '名称不得大于50字',
            'redirect.required' => '请填写跳转的路径',
            'redirect.url' => '请输入有效的地址',

        ]);

         //获取数据
         $data = $request -> except('_token');
         
         //写入数据库
        $res =  Carousel::create($data);

        if($res){
            //如果添加成功 跳到主页
            return redirect('admin/carousel')->with('msg','成功添加');
        }else{
            //失败 返回上一个页面
            return redirect('admin/carousel/create')->with('msg','添加失败');
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
     * 轮播视频修改界面
     * @author:Mrlu
     * @date:2017/11/30
     * @param id 用于显示某条信息
     * @返回一个视频轮播添加的模板和标题 查询的视频的信息
     */
    public function edit($id)
    {
        //查询某条数据
        $info = Carousel::find($id);
        

        //返回一个修改模板
        return view('Admin.Carousel.edit',['title'=>'视频轮播修改','data'=>$info]);
    }

    /**
     * 轮播视频修改
     * @author:Mrlu
     * @date:2017/11/30
     * @param id 用于修改某条信息 request用户请求的信息
     * @成功返回到主页  失败也返回到主页
     */
    public function update(Request $request, $id)
    {
        
        //表单验证
         $this->validate($request, [
            'cname' => 'max:50',
            'credirect' => 'url',
        ],[
            'canme.max' => '名称不得大于50字',
            'redirect.url' => '请输入有效的地址',
        ]);

         $data = $request -> except('_token','method');

         //过滤掉空数据
         foreach($data as $k=>&$v){
            if(!$data[$k]){
            unset($data[$k]); 
            }
        }

         //写入数据库
        $res =  Carousel::find($id)->update($data);

        if($res){
            //如果添加成功 跳到主页
            return redirect('admin/carousel')->with('msg','更新添加');
        }else{
            //失败 返回上一个页面
            return redirect('admin/carousel')->with('msg','跟新失败');
        }

    }

    /**
     * 删除轮播视频
     * @author:Mrlu
     * @date:2017/11/30
     * @param id 用于删除某条信息
     * @成功返回到主页  失败也返回到主页
     */
    public function destroy($id)
    {
        $res = Carousel::find($id)->delete();
        if($res){
            echo '删除成功';
         }else{
            echo '删除失败';
         }
        
    }

     /**
     * ajax修改数据
     * @author:Mrlu
     * @date:2017/11/29
     * @param:页面的请求信息
     * @return
     */
    public function ajax(Request $request)
    {

        $id = $request->input('id');
        $name = $request->input('cname');
        $res = Carousel::where('cname', $name)->first();
        if ($res) {
////            用户名已经存在 。
            return response()->json(['code' => 0]);
////            return ['code'=>0];
        } else {
            $data = Carousel::find($id);
            $res = $data->update(['cname' => $name]);
//            echo $res;
            if ($res) {
//////                1.表示成功。
                return response()->json(['code' => 1]);
            } else {
//////                2.表示失败。
                return response()->json(['code' => 2]);
            }
        }
        


    }



}
