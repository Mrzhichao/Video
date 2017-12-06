<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public $table = 'reply';

    public $primaryKey = 'rid';

    public $timestamps = false;

    public $guarded = [];
}
