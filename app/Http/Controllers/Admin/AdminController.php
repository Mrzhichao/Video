<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Admin\Roles;
use Intervention\Image\ImageManagerStatic as Image;
use DB;



class AdminController extends Controller
{


     /**
     * 显示用户授权页面
     * @author:Mrlu
     * @date:2017/12/5
     * @param:用户的ID
     * @返回一个页面
     */
    public function auth($id){

        //标题
        $title='管理员用户授权';

        //获取用户名
        $user = Admin::find($id);
        //获取角色
        $roles = Roles::get();
        
         //获取当前用户已经拥有的角色
       

        $own_roles = DB::table('admin_roles')->where('aid',$id)->pluck('rid');
        $own_roles= $own_roles->toArray();
        return view('Admin.Admin.auth',compact('title','user','roles','own_roles'));

    }

      /**
     * 处理用户授权数据
     * @author:Mrlu
     * @date:2017/12/5
     * @param:请求页面的信息
     * @返回到列表页
     */
    public function doauth(Request $request)
    {
        $data = $request->except('_token');

          //开启事务
          DB::beginTransaction();
        try{
            //删除用户以前拥有的角色
            DB::table('admin_roles')->where('aid',$data['aid'])->delete();
//            给当前用户重新授权
            if(isset($data['rid'])){
                foreach ($data['rid'] as $k=>$v){
                    DB::table('admin_roles')->insert(['aid'=>$data['aid'],'rid'=>$v]);
                }
            }


        }catch (Exception $e){
            DB::rollBack();
        }

        DB::commit();

        // //添加成功后，跳转到列表页
         return redirect('admin/admin');



    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = '后台管理员用户';
        $keywords=$request->input('keyword');

        $data = Admin::where('aname','like',"%".$keywords."%")->Paginate(5);

        $aid=Session('user')->aid;
        $admin=Admin::find($aid);
        // dd($admin);

        return view('Admin.Admin.index',['title'=>$title,'data'=>$data,'where'=>['keyword'=>$keywords]]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = '管理员添加';
        return view('Admin.Admin.create',['title'=>$title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'aname' => 'required|min:5|max:18',
            'apwd' => 'required',
            're_apwd' => 'same:apwd',
            'avatar' => 'image'
        ],[
            'aname.required' => '用户名不能为空。',
            'aname.min' => '用户名最小5个字符。',
            'aname.max' => '用户名最大18个字符。',
            'updated_at.required' => '密码不能为空。',
            're_apwd.same' => '确认密码不一致。',
            'avatar.image' => '请选择一张图片才好。',
        ]);

        $data = $request->except('_token', 're_apwd');
        //加密
        $data['apwd'] = encrypt($data['apwd']);
        // dd($data);

        //上传文件处理
        if($request->hasFile('avatar'))
        {
            if($request->file('avatar')->isValid())
            {
                $ext = $request->file('avatar')->getClientOriginalExtension();
                $filename = str_random(32).'.'.$ext;
                $request->file('avatar')->move('./uploads/admin', $filename);
                $data['avatar'] = $filename;
                //压缩图片
                $img = Image::make("./uploads/admin/".$filename)->resize(120,100);
                $img->save("./uploads/admin/s_".$filename);

            }
        }else
        {
            //不上传给默认值
            $data['avatar'] = 'default.jpg';
        }
         // dd($data);
        //插入数据库
       $res =  Admin::create($data);
       //判断是否登录成功
       if($res){
        return redirect('admin/admin')->with('msg','添加成功');;
       }else{
        return back()->with('msg','添加失败');;
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
      $title = '修改页面';
       $data = Admin::find($id);
       return view('Admin.Admin.edit',['title'=>$title,'data'=>$data]);
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
        $this->validate($request,[
            'aname' => 'required|min:5|max:18',
            'avatar' => 'image'
        ],[
            'aname.required' => '用户名不能为空。',
            'aname.min' => '用户名最小5个字符。',
            'aname.max' => '用户名最大18个字符。',
            'avatar.image' => '请选择一张图片才好。',
        ]);
        
        $data = $request->except('_token');
        // if($data = )
        // dd($data);

        // 上传文件处理
        if($request->hasFile('avatar'))
        {
            if($request->file('avatar')->isValid())
            {
                $ext = $request->file('avatar')->getClientOriginalExtension();
                $filename = str_random(32).'.'.$ext;
                $request->file('avatar')->move('./uploads/admin', $filename);
                $data['avatar'] = $filename;
                //压缩图片
                $img = Image::make("./uploads/admin/".$filename)->resize(120,100);
                $img->save("./uploads/admin/s_".$filename);

                // 删除老图片。
                $oldPic = Admin::where('aid', $id)->first()->avatar;
                if($oldPic != 'default.jpg'){
                    unlink('./uploads/admin/'.$oldPic);
                    unlink("./uploads/admin/s_".$oldPic);
                  }

            }
        }
        //修改插入数据库
       $res = Admin::find($id) -> update($data);
       //判断是否修改成功
       if($res){
        return redirect('admin/admin')->with('msg','修改成功');
       }else{
        return back()->with('msg','修改失败');
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //通过id删除数据
        $res = Admin::find($id)->delete();

        //判断是否删除成功
        $data= [];
        if($res){
            $data['error']=0;
            $data['msg']='删除成功';
            // echo '删除成功';
            // return redirect('admin/user')->with('msg','删除成功');
        }else{
            $data['error']=1;
            $data['msg']='删除失败';
          // echo '删除失败';
            // return back()->with('msg','修改失败');
        }

        return $data;
    }
}
