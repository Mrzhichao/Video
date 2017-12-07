<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
	//声明数据表的名称
   	public $table = 'admin';

   	//声明数据表的主键
   	public $primaryKey = 'aid';

   	//过滤默认的字段
   	public $timestamps = false;
   	
   	//批量接收数据 除了 _token
   	public $guarded = ['_token'];

   	public function role()
   	{	
   		//路由名称,关联表,关联模型的外键,合并表的外键
   		return $this->belongsToMany('App\Models\Admin\Roles','admin_roles','aid','rid');
   	}


}