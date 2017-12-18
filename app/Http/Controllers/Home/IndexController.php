<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Home\VideoRecommend as vr;
use App\Models\Admin\Video;
use App\Models\Admin\VideoType;
use App\Models\Admin\Carousel;
use App\Models\Admin\Advertisement as ad;



class IndexController extends Controller
{
    //存放各类id
    private $cate_id = [];
    

    /**
     * 前台首页面
     * @author:Mrlu
     * @date:2017/12/08 
     * @param:
     * @return 把排行 轮播图 推荐 等数据发送到前台首页
     */
    public function index()
    {

        \Session::put('detail_search','');

    	//获取上榜的视频信息
    	$first = Video::orderBy('vscores','desc')->take(6)->get();

    	
      //获取轮播图
      $car = Carousel::get();
     
        //电影精选
        //获取传递过来参数的id
        
        $vid = VideoType::where('vtname','电影')->first();
        $vid = $vid['vtid'];
        //调用方法获取所有的电影下面的分类s
        $a = $this -> cate($vid);
        $this -> cate_id = [];

        //循环查出属于电影下面的子类
        if(!empty($a)){
            foreach($a as $v){
                $dyjx[] = Video::where('typeid',$v)->orderBy('numOfViewed','desc')->take(5)->get();
            }
          }else{
            $dyjx = [];
          } 

       
          //拼凑成一个二维数组
          $i = 0;
          foreach($dyjx as $k=>$v){
            
            foreach($v as $kk=>$vv){
                $i++;
                if($i < 7 ){
                     $erwei[] = $vv;
                }else{
                    break 2;
                }
            }
          }
          $dyjx = $erwei;
          //dd($dyjx);

        

        //电视剧精选
        //获取传递过来参数的id
        $vid = VideoType::where('vtname','电视剧')->first();
        $vid = $vid['vtid'];
        //调用方法获取所有的电影下面的分类s
        $a = $this -> cate($vid);
        $this -> cate_id = [];
        //循环查出属于电影下面的子类
        $i = 0;
        if(!empty($a)){
            foreach($a as $v){
                $i++;

                if($i <4){
                    $dsjx = Video::where('typeid',$v)->orderBy('numOfViewed','desc')->take(5)->get();
                }
            }
          }else{
            $dsjx = [];
          } 
  
        //综艺
        //获取传递过来参数的id
        $vid = VideoType::where('vtname','综艺')->first();
        $vid = $vid['vtid'];
        //调用方法获取所有的电影下面的分类s
        $a = $this -> cate($vid);
        $this -> cate_id = [];
        //循环查出属于电影下面的子类
        if(!empty($a)){
            foreach($a as $v){
                $yljx = Video::where('typeid',$v)->orderBy('numOfViewed','desc')->take(5)->get();
            }
          }else{
            $yljx = [];
          } 
         

        //VIP精选
        $oneVip = Video::where('isVip','1')-> orderBy('numOfViewed','desc')->first();
        // dd($oneVip);
        $Vip = Video::where('isVip','1')-> orderBy('numOfViewed','desc')->take(4)->get();

        //本站统计
        
        //电影统计
        //初始值
        $dytj = 0;
        //获取传递过来参数的id
        $vid = VideoType::where('vtname','电影')->first();
        $vid = $vid['vtid'];
        //调用方法获取所有的电影下面的分类s
        $a = $this -> cate($vid);
        $this -> cate_id = [];
        //循环查出属于电影下面的子类
        if(!empty($a)){
            foreach($a as $v){
                $dytj += Video::where('typeid',$v)->count();
            }
        }

         //电视统计
        //初始值
        $dstj = 0;
        //获取传递过来参数的id
        $vid = VideoType::where('vtname','电视剧')->first();
        $vid = $vid['vtid'];
        //调用方法获取所有的电影下面的分类s
        $a = $this -> cate($vid);
        $this -> cate_id = [];
        //循环查出属于电影下面的子类
        if(!empty($a)){
            foreach($a as $v){
                $dstj += Video::where('typeid',$v)->count();
            }    
        }
        //娱乐统计
        // //初始值
        $yltj = 0;
        //获取传递过来参数的id
        $vid = VideoType::where('vtname','娱乐')->first();
        $vid = $vid['vtid'];
        //调用方法获取所有的电影下面的分类s
        $a = $this -> cate($vid);
        $this -> cate_id = [];
        //循环查出属于电影下面的子类
         if(!empty($a)){
            foreach($a as $v){
                $yltj += Video::where('typeid',$v)->count();
            }
        }

      
        //  dd($a);
        //各种统计
        $tongji = [
            '电影资源'=>$dytj,
            '电视资源' => $dstj,
            '综艺资源' => $yltj,
        ];

    //获取广告信息 根据结束时间
    $Ad =ad::inRandomOrder()->take(6)->get();

    	return view('Home.index',compact('first','car','dyjx','dsjx','yljx','oneVip','Vip','tongji','Ad'));



    }
    

//获取子类中的各个子类
public function cate($id)
    {
        //获取数据遍历
        $type = VideoType::get();
        // dd($type);
         foreach($type as $k=>$v){
            //如果pid==id 就说明是电影下面的子类
            if($v->pid == $id){
                //存放
               $this->cate_id[] =  $v->vtid;
               //再次调用
               //$this->cate($v->vtid);
            }
         }
         //去除重复值

         $this -> cate_id = array_unique($this->cate_id); 
         //返回
         return $this->cate_id;
    }


    public function search()
    {
       // 获取关键字
        $wordskey = empty($_GET['wordskey']) ? '' : $_GET['wordskey'];
        //进行搜索
        $res = Video::where('vname','like','%'.$wordskey.'%')->get();
        return redirect('home/list')->with('res',$res);

    }


    //获取layout元素
    



}
