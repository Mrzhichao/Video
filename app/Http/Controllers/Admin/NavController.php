<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Navigation as nav;
use App\Models\Admin\VideoType as type;

class NavController extends Controller
{
    /**
     * 显示导航管理
     * @author:Mrlu
     * @date:2017/12/08
     * @param:
     * @return 将数据返回到首页
     */
    public function index()
    {
        $title = '导航预览';
        //获取数据
        $data = nav::get(); 


        //将数据带入页面
        return view('Admin.Nav.index',compact('title','data'));
    }
    /**
     * 引入导航添加页面
     * @author:Mrlu
     * @date:2017/12/08
     * @param:
     * @return 获取视频类型信息 返回导航添加页面  
     */
    
    public function create()
    {
       
       //获取一级分类
        $vt= type::where('pid',0)->get();
       
        foreach($vt as $v){

            $isV = nav::where('nname',$v->vtname)->first();
            //把一级导航添加到数据库
            if($isV){
                //如果数据库里面有 赋值为空
                $res = '';
            }else{
                //如果数据库里面没有 就添加
                 $res = nav::create(['nname'=>$v->vtname,'pid'=>$v->vtid]);
            }
         
        }
       
        if($res){
           return redirect('admin/nav')->with('msg','更新数据库成功');
        }else{
           return redirect('admin/nav')->with('msg','已经是最新的数据了');
        }
       

       
    }

   /**
     * 保存提交的数据
     * @author:Mrlu
     * @date:2017/12/08
     * @param: 页面的请求信息
     * @return 成功返回主页 失败返回本页 
     */
    public function store(Request $request)
    {
       
        // //验证
        //  $this->validate($request, [
        //     'nname' => 'required|max:50',
        //     'ndesc' => 'required|max:50',
        //     'resourceSrc' => 'required',
        // ],[
        //     'nname.required' => '请填写导航名称',
        //     'nname.max' => '名称不得大于50字',
        //     'ndesc.required' => '请填写导航描述',
        //     'ndesc.max' => '描述不得大于50字',
        //     'resourceSrc.required' => '请填写跳转的路径',
        //     'resourceSrc.url' => '请输入有效的地址',

        // ]);
        //  //获取数据
        //  $data = $request -> except('_token');

        //  //插入数据库
        //  $res = nav::create($data);
        //     if($res){
        //     //如果添加成功 跳到主页
        //      return redirect('admin/nav')->with('msg','成功添加');
        //     }else{
        //         //失败 返回上一个页面
        //         return redirect('admin/nav/create')->with('msg','添加失败');
        //     }

    }

   
    public function show($id)
    {
        //
    }

     /**
     * 编辑导航页面
     * @author:Mrlu
     * @date:2017/12/08
     * @param: 获取某条要修改的导航
     * @return 将信息返回到编辑页面
     */
    public function edit($id)
    {
        // $title = '导航编辑';

        // //根据ID获取数据
        // $data = nav::find($id);
        // return view('Admin.Nav.edit',compact('title','data'));
    }

    /**
     * 提交修改的数据
     * @author:Mrlu
     * @date:2017/12/08
     * @param: 获取某条要修改的导航
     * @return 成功返回主页 失败返回本页 
     */
    public function update(Request $request, $id)
    {

      //   //验证
      //    $this->validate($request, [
      //       'nname' => 'required|max:50',
      //       'ndesc' => 'required|max:50',
      //       'resourceSrc' => 'required',
      //   ],[
      //       'nname.required' => '请填写导航名称',
      //       'nname.max' => '名称不得大于50字',
      //       'ndesc.required' => '请填写导航描述',
      //       'ndesc.max' => '描述不得大于50字',
      //       'resourceSrc.required' => '请填写跳转的路径',
      //       'resourceSrc.url' => '请输入有效的地址',

      //   ]);


      //   //获取数据
      //   $data = $request -> except('_token','_method');
      // //过滤掉空的数据
      //    foreach($data as $k=>&$v){
      //       if(!$data[$k]){
      //       unset($data[$k]); 
      //       }
      //   }
      //       //写入数据库
      //   $res =  nav::find($id)->update($data);

      //   if($res){
      //       //如果添加成功 跳到主页
      //       return redirect('admin/nav')->with('msg','更新添加');
      //   }else{
      //       //失败 返回上一个页面
      //       return redirect('admin/nav')->with('msg','更新失败');
      //   }
        

    }

     /**
     * 删除导航
     * @author:Mrlu
     * @date:2017/12/08
     * @param: 获取某条要删除的导航
     * @return 成功返回主页 失败返回本页 
     */
    public function destroy($id)
    {
        
        $res = nav::find($id)->delete();
        if($res){
            //如果添加成功 跳到主页
          echo '删除成功';
        }else{
            //失败 返回上一个页面
            echo '删除失败';
        }


    }

     /**
     * ajax修改描述
     * @author:Mrlu
     * @date:2017/12/08
     * @param:页面的请求信息
     * @return
     */
    public function ajaxNdesc(Request $request)
    {


        $id = $request->input('id');
        $name = $request->input('name');
        $res = nav::where('ndesc', $name)->first();
        if ($res) {
////            用户名已经存在 。
            return response()->json(['code' => 0]);
////            return ['code'=>0];
        } else {
            $data = nav::find($id);
            $res = $data->update(['ndesc' => $name]);
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
         /**
     * ajax修改名称
     * @author:Mrlu
     * @date:2017/12/08
     * @param:页面的请求信息
     * @return
     */
    public function ajaxName(Request $request)
    {


        $id = $request->input('id');
        $name = $request->input('name');
        $res = nav::where('nname', $name)->first();
        if ($res) {
////            用户名已经存在 。
            return response()->json(['code' => 0]);
////            return ['code'=>0];
        } else {
            $data = nav::find($id);
            $res = $data->update(['nname' => $name]);
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
         /**
     * ajax修改数据
     * @author:Mrlu
     * @date:2017/11/29
     * @param:页面的请求信息
     * @return
     */
    public function ajaxNsrc(Request $request)
    {


        $id = $request->input('id');
        $name = $request->input('name');
        $res = nav::where('resourceSrc', $name)->first();
        if ($res) {
////            用户名已经存在 。
            return response()->json(['code' => 0]);
////            return ['code'=>0];
        } else {
            $data = nav::find($id);
            $res = $data->update(['resourceSrc' => $name]);
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
