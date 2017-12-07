<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\VideoReview;

class ReplyController extends Controller
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
    public function show(Request $request ,$id)
    {
         $title = '视频评论回复';
     
        $users= \DB::table('videoreview')
            ->join('users', 'users.uid', '=', 'videoreview.userid')
            ->join('videos', 'videos.vid', '=', 'videoreview.videoid')
            ->join('userinfo', 'userinfo.uiid', '=', 'videoreview.userinfoid')
            ->select('videoreview.*', 'users.uname', 'videos.vname','userinfo.nickname')
            ->get();
            // dd($users);

        $data = $this ->subtree($users,$id); 
        // dd($data);
       return view('Admin.Reply.index',['title'=>$title,'id'=>$id,'data'=>$data]);
    }
        

        /**
         * 无限极分类
         * @param  [type]  $arr [description]
         * @param  integer $id  [description]
         * @param  integer $lev [description]
         * @return [type]       [description]
         */
        public function subtree($arr,$id=0,$lev=1)
        {
                    // dd($arr);
                        $subs=[];
                        foreach($arr as $v){

                            if($v->pid==$id){
                                // dd($v);
                                $v->lev=$lev;
                                $subs[]=$v;
                                // dd($subs);
                                $subs = array_merge($subs,$this->subtree($arr,$v->rid,$lev+1));
                            }
                        }
                     return $subs;
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
         //通过id删除数据
        $res = VideoReview::find($id)->delete();

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
