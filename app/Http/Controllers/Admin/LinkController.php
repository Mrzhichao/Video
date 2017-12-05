<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Link;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    /**
     * 友情链接页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        1获取友情链接数据
        $links = Link::get();
        $title='友情链接首页';
//        2 显示视图
        return view('admin.Link.list',compact(['title','links']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.link.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');
        $res = Link::create($input);
        //        4. 判断添加是否成功
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
