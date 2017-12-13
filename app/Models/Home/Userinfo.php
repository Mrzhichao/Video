<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
    public $table = 'userinfo';

    public $primaryKey = 'uiid';

    public $timestamps = false;

    public $guarded = [];
}
