<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Auth;
class AuthController extends Controller
{
   /**
     * 查询权限并显示到页面
     * @author:Mrlu
     * @date:2017/12/05
     * @return 返回获取的数据和标题
     */
    public function index()
    {
        //查询数据并传入页面
        
         $namekey = empty($_GET['aname']) ? '' : $_GET['aname']; 
        
        // //查询数据库
        $data = Auth::where('aname','like','%'.$namekey.'%')->paginate(6); 
        return view('Admin.Auth.index',['title'=>'权限预览','data'=>$data])->with('where',['aname'=>$namekey]);
    }

    /**
     * 显示权限添加页面
     * @author:Mrlu
     * @date:2017/12/05
     * @return 返回页面 和标题
     */
    public function create()
    {
        $title = '权限添加';
        return view('admin.Auth.create',['title'=>$title]);
    }

    /**
     * 将添加的信息处理后写入数据库
     * @author:Mrlu
     * @date:2017/12/05
     * @param: 数据请求的集合
     * @return 成功返回主页  失败返回back()
     */
    public function store(Request $request)
    {
        //表单验证
         $this->validate($request, [
            'aname' => 'required',
            'adesc' => 'required',
        ],[
            'aname.required' => '请填写权限名称',
            'adesc.required' => '请简单的进行描述',
        ]);

        //获取提交的数据
        $data = $request -> except('_token');

        //写入数据库
        $res = Auth::create($data);
        if($res){
            //如果添加成功 跳到主页
            return redirect('admin/auth')->with('msg','添加成功');
        }else{
            //失败 返回上一个页面
            return redirect('admin/auth/create')->with('msg','添加失败');
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
     * 获取编辑页面并显示
     * @author:Mrlu
     * @date:2017/12/05
     * @param:id 用于查询某条信息
     * @return 返回一组数据 和 标题
     */
    public function edit($id)
    {
       //根据ID获取数据
       $data = Auth::find($id);
       //返回一个页面
       return view('Admin.Auth.eidt',['title'=>'权限编辑','data'=>$data]);
    }

    /**
     * 将更新的信息处理后写入数据库
     * @author:Mrlu
     * @date:2017/12/05
     * @param:request: 数据请求的集合 id:修改某条数据
     * @return 成功返回主页  失败返回back()
     */
    public function update(Request $request, $id)
    {
       //获取数据
       $data = $request -> except('_token','_method');

       //修改
       $res = Auth::find($id)->update($data);
        if($res){
            //如果修改成功 跳到主页
            return redirect('admin/auth')->with('msg','更新成功');
        }else{
            //如果修改失败 跳到主页
            return redirect('admin/auth')->with('msg','更新失败');
        }

    }

    /**
     * 删除一条信息
     * @author:Mrlu
     * @date:2017/12/05
     * @param:id:用户删除某条信息
     * @return 返回一种状态
     */
    public function destroy($id)
    {
        //根据ID删除数据
        $res = Auth::find($id)->delete();
        if($res){
            echo '删除成功';
       }else{
            echo '删除失败';
       }
    }
}
