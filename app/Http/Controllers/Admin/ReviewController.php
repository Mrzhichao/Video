<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\VideoReview;
use App\Models\Admin\Userinfo;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return 111;
        // $title = '视频评论页';
        // // $data = VideoReview::get();
        // // dd($data);
        // $keywords=$request->input('keyword');

        // // $data = VideoReview::
        // // dd($data);
        // // 
        // $data= \DB::table('videoreview')
        //     ->join('users', 'users.uid', '=', 'videoreview.userid')
        //     ->join('videos', 'videos.vid', '=', 'videoreview.videoid')
        //     ->select('videoreview.*', 'users.uname', 'videos.vname')
        //     ->where('rtitle','like',"%".$keywords."%")->Paginate(5);
        //     // dd($users);

        // return view('Admin.VideoReview.index',['title'=>$title,'data'=>$data,'where'=>['keyword'=>$keywords]]);
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
    public function show(Request $request,$id)
    {
        $title = '视频评论';

        $keywords=$request->input('keyword');
         $data= \DB::table('videoreview')
            ->join('users', 'users.uid', '=', 'videoreview.userid')
            ->join('videos', 'videos.vid', '=', 'videoreview.videoid')
            ->join('userinfo', 'userinfo.uiid', '=', 'videoreview.userinfoid')
            ->select('videoreview.*', 'users.uname', 'videos.vname','userinfo.nickname')
            ->where('vid',$id)->where('pid',0)->where('rtitle','like',"%".$keywords."%")->Paginate(5);
        // dd($data);
       return view('Admin.Review.index',['title'=>$title,'id'=>$id,'data'=>$data,'where'=>['keyword'=>$keywords]]);
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
