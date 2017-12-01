<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;



class VideoType extends Model
{
    //
   public $table = 'videotype';
   public $primaryKey='vtid';
   
   //    定义时间戳  larval会自动维护create_at update_at两个表字段，所以如果表中没有这两个字段，一定要关闭自维护

   public $timestamps = false;

   // 设置允许批量修改的字段
   //public $fillable = ['username','userpass','telephone'];
 
   public $guarded = [];



       public  function tree()
    {
        $cates = $this->orderBy('order_sort','asc')->get();
        //对分类数据进行格式化（排序、缩进）
        return $this->getTree($cates,0);
    }


    /**
     * 对分类数据进行格式化（排序、缩进）
     */
    public function getTree($Category,$pid)
    {
        //存放最终结果的数组
        $arr = [];
        foreach($Category as $k=>$v){
            //如果是当前遍历的类是一级类
            if($v->pid == $pid){
                //复制当前分类的名称给cate_names字段
                $v->vtname = $v->vtname;
                $arr[] = $v;

                //找当前一级类下的二级类
                foreach ($Category as $m=>$n) {
                    //如果一个分类的pid == $v这个类的id,那这个类就是$v的子类
                    if($n->pid == $v->vtid){
                        $n->vtname = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$n->vtname;
                        $arr[] = $n;
                    }
                }
            }
        }
        return $arr;
    }





    //测试函数 （测试正式函数）
    public function getVideoTypeInfo(){
        $sourceItems = $this->get();
        $targetItems = new Collection;
        $this->getVideoType($sourceItems, $targetItems);
        return $targetItems;
    }
    
    //使用递归获取分类信息测试函数 （测试正式函数）
    public function getVideoType($sourceItems, $targetItems, $pid=0, $str='|'){
        $str .= '__';
        foreach ($sourceItems as $k => $v) {
            if($v->pid == $pid){
                $v->vname = $str.$v->vname;
                $targetItems[] = $v;
                $this->getVideoType($sourceItems, $targetItems, $v->vtid, $str);
            }
        }
    }



    //测试函数 （测试正式函数）
    public function getTypeInfo(){
        $sourceItems = $this->get();
        $targetItems = new Collection;
        $this->getType($sourceItems, $targetItems);
        return $targetItems;
    }
    
    //使用递归获取分类信息测试函数 （测试正式函数）
    public function getType($sourceItems, $targetItems, $pid=0, $str='|'){
        $str .= '__';
        foreach ($sourceItems as $k => $v) {
            if($v->pid == $pid){
                $v->vtname = $str.$v->vtname;
                $targetItems[] = $v;
                $this->getType($sourceItems, $targetItems, $v->vtid, $str);
            }
        }
    }




}
