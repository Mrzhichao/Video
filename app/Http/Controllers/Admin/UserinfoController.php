<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Userinfo;
use App\Models\Admin\User;

class UserinfoController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        //详情页显示
        $title = '用户详情页';

        $data = User::find($id)->infos;
       if($data){
            return view('Admin.Userinfo.index',['title'=>$title,'data'=>$data]);
       }else{
            return back()->with('msg','用户没有详情信息');
       }
    
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $title ='详情修改页';
        $data = Userinfo::find($id);
        return  view('Admin.Userinfo.edit',['title'=>$title,'data'=>$data]);
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
            'nickname' => 'required|min:5|max:18',
            'realname' => 'required|min:2|max:6',
            'cardid' => 'required|size:18',
            'qq' => 'required|min:6|max:11',

        ],[
            'nickname.required' => '昵称不能为空。',
            'nickname.min' => '昵称最小5个字符。',
            'nickname.max' => '昵称最大18个字符。',
            'realname.required' => '姓名不能为空。',
            'realname.min' => '姓名最小2个字符。',
            'realname.max' => '姓名最大6个字符。',
            'cardid.required' => '身份证不能为空。',
            'cardid.size' => '身份证长度不合适 。',
            'qq.required' => 'qq不能为空。',
            'qq.min' => 'qq最小6个字符。',
            'qq.max' => 'qq最大11个字符。',

        ]);
        
        $data = $request->except('_token');
        // if($data = )
        // dd($data);

        //修改插入数据库
       $res = Userinfo::find($id) -> update($data);
       //查询数据库 通过查到的数据查看userid
       $user = Userinfo::find($id);



       //判断是否修改成功
       if($res){
        return redirect('admin/userinfo/'.$user->userid)->with('msg','修改成功');
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
        $res = Userinfo::find($id)->delete();

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
