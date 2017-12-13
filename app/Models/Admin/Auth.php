<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
     /**
     * 用户权限表
     */
     public $table = 'auth';

    public $primaryKey = 'aid';

    public $timestamps = false;

    public $guarded = [];

}
