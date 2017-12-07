<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Video extends Model
{
    
    public $table = 'videos';
    public $primaryKey='vid';
   
    public $timestamps = false;

    public $guarded = [];

    public function users()
    {
      return $this->belongsTo('App\Models\Admin\User', 'userid','uid');
    }

    public function types()
    {
      return $this->belongsTo('App\Models\Admin\VideoType', 'typeid','vtid');
    }

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
