<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
   public $table = 'videos';
   public $primaryKey='vid';
   
   //    定义时间戳  larval会自动维护create_at update_at两个表字段，所以如果表中没有这两个字段，一定要关闭自维护

   public $timestamps = false;

   // 设置允许批量修改的字段
   //public $fillable = ['username','userpass','telephone'];

   // 不允许批量修改的字段
   public $guarded = [];


   //    一对一

//     public function userinfo(){
// //        参数1 ：要关联的模型
// //        参数2：外键
// //        参数3：当前模型的主键
// //        return $this->hasOne('App\Phone', 'foreign_key', 'local_key');
//         return $this->hasOne('App\Models\UserInfo','uid','id');
//     }


// //    一对多
//     public function userinfos(){
// //        参数1 ：要关联的模型
// //        参数2：外键
// //        参数3：当前模型的主键
// //       return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
//         return $this->hasMany('App\Models\UserInfo','uid','id');
//     }

}
