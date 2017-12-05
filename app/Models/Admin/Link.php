<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    public $table = 'links';
    public $primaryKey = 'link_id';
    public $guarded = [];
    public $timestamps = false;

}
