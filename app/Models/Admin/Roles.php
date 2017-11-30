<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    /**
     * 用户权限表
     */
     public $table = 'roles';

    public $primaryKey = 'rid';

    public $timestamps = false;

    public $guarded = [];

        //用户表
//     public function users()
//     {
//     		//  一对一
//     	// 参数1 ：要关联的模型
// // //        参数2：外键
// // //        参数3：当前模型的主键
//         return $this->hasOne('App\Models\Admin\User','roleid','rid');
//     }
}
