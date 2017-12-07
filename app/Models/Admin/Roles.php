<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    /**
     * 权限角色表
     */
     public $table = 'roles';

    public $primaryKey = 'rid';

    public $timestamps = false;

    public $guarded = [];

       
    public function role()
   	{	
   		//路由名称,关联表,当前的ID,aid 反向
   		return $this->belongsToMany('App\Models\Admin\Admin','admin_roles','rid','aid');
   	}

   	public function auth()
   	{	
   		//路由名称,关联表,当前的ID,aid
   		return $this->belongsToMany('App\Models\Admin\Auth','role_auth','rid','aid');
   	}

}
