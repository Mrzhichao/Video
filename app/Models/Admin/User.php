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


     public function Videos()
    {
         return $this->hasMany('App\Models\Admin\Video');
    }

}
