<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Roles;
use App\Models\Admin\Auth;
use DB;
class RoleController extends Controller
{


     //角色授权页面
    public function auth($id){

        //标题
        $title='角色授权';

        //获取角色
        $roles = Roles::find($id);
        //获取权限
        $auth = Auth::get();
        
         //获取当前角色已经拥有的权限
       

        $own_auths = DB::table('role_auth')->where('rid',$id)->pluck('aid');
        $own_auths= $own_auths->toArray();
        return view('Admin.Role.auth',compact('title','roles','auth','own_auths'));

    }

     //处理管理员用户授权
    public function doauth(Request $request)
    {
        $data = $request->except('_token');
       
          //开启事务
          DB::beginTransaction();
        try{
            //删除用户以前拥有的角色
            DB::table('role_auth')->where('rid',$data['rid'])->delete();
//            给当前用户重新授权
            if(isset($data['rid'])){
                foreach ($data['aid'] as $k=>$v){
                    DB::table('role_auth')->insert(['rid'=>$data['rid'],'aid'=>$v]);
                }
            }


        }catch (Exception $e){
            DB::rollBack();
        }

        DB::commit();

        // //添加成功后，跳转到列表页
         return redirect('admin/role');



    }




    /**
     * 查询角色并显示到页面
     * @author:Mrlu
     * @date:2017/12/05
     * @return 返回获取的数据和标题
     */
    public function index()
    {
        //查询数据并传入页面
        
         $namekey = empty($_GET['aname']) ? '' : $_GET['aname']; 
        
        // //查询数据库
        $data = Roles::where('rname','like','%'.$namekey.'%')->paginate(8); 
        return view('Admin.Role.index',['title'=>'角色预览','data'=>$data])->with('where',['aname'=>$namekey]);
    }

    /**
     * 显示角色添加页面
     * @author:Mrlu
     * @date:2017/12/05
     * @return 返回页面 和标题
     */
    public function create()
    {
        $title = '角色添加';
        return view('admin.Role.create',['title'=>$title]);
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
            'rname' => 'required',
            'rdesc' => 'required',
        ],[
            'rname.required' => '请填写角色名称',
            'rdesc.required' => '请简单的进行描述',
        ]);

        //获取提交的数据
        $data = $request -> except('_token');

        //写入数据库
        $res = Roles::create($data);
        if($res){
            //如果添加成功 跳到主页
            return redirect('admin/role')->with('msg','添加成功');
        }else{
            //失败 返回上一个页面
            return redirect('admin/role/create')->with('msg','添加失败');
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
       $data = Roles::find($id);
       //返回一个页面
       return view('Admin.Role.eidt',['title'=>'角色编辑','data'=>$data]);
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
       $res = Roles::find($id)->update($data);
        if($res){
            //如果修改成功 跳到主页
            return redirect('admin/role')->with('msg','更新成功');
        }else{
            //如果修改失败 跳到主页
            return redirect('admin/role')->with('msg','更新失败');
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
        $res = Roles::find($id)->delete();
        if($res){
            echo '删除成功';
       }else{
            echo '删除失败';
       }
    }
}
