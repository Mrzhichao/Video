<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	/**
	 * 用户表
	 * [$table description]
	 * @var string
	 */
    public $table = 'users';

    public $primaryKey = 'uid';

    public $timestamps = false;

    public $guarded = [];


       	 // 用户表
    public function infos()
    {
    		//  一对一
    	// 参数1 ：要关联的模型
// //        参数2：外键(userinfo)的外键
// //        参数3：当前模型的主键
        return $this->hasOne('App\Models\Admin\Userinfo','userid','uid');
    }

    public function Videos()
    {
         return $this->hasMany('App\Models\Admin\Video');

    }

}
