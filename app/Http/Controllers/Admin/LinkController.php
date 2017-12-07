<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Link;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class LinkController extends Controller
{

    /**
     * 友情链接浏览页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::orderby('link_order','asc')->get();
        $title='友情链接首页';
        return view('Admin.Link.index',compact(['title','links']));
    }

    /**
     *  ajax排序操作
     *
     * @return \Illuminate\Http\Response
     */
     public function changeOrder(Request $request)
    {
          $link_id = $request->input('link_id');
          $link_order = $request->input('link_order');
          $link = Link::find($link_id);
          $res = $link->update(['link_order'=>$link_order]);

          if($res){
              $data =[
                  'status'=> 0,
                  'msg'=>'修改成功'
              ];
          }else{
              $data =[
                  'status'=> 1,
                  'msg'=>'修改失败'
              ];
          }

          return $data;
    }


    /**
     *友情链接更新页
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='添加友情链接首页';
        return view('Admin.Link.add',compact(['title']));
    }

    /**
     * 友情链接更新操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');
        $res = Link::create($input);
        if($res){
            return redirect('admin/link');
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
     * 友情链接更新页
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = '友情链接更新';
        $link = Link::find($id);

        return view('Admin.Link.edit',['link'=>$link,'title'=>$title]);
    }

    /**
     * 友情链接更新操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $link = Link::find($id);
        $input = $request->except('_token','_method');
        
       //过滤掉空数据
       foreach($input as $k=>&$v){
            if(!$v){unset($input[$k]); }
       }

        $res = $link->update($input);
        if($res){
            return redirect('admin/link');
        }else{
            return redirect('admin/link/'.$link->link_id.'/edit');
        }
    }

    /**
     * 友情链接删除操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Link::find($id)->delete();
        $data = [];
        if($res){
            $data['error'] = 0;
            $data['msg'] ="删除成功";
        }else{
            $data['error'] = 1;
            $data['msg'] ="删除失败";
        }
        return $data;
    }
}
