<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class content_tbl extends Model
{
    protected $table = 'content';

    public static function listContent($user)
    {
        return self::select('id','name')->where('users_id',$user)->where('is_active', "Y")->get();
    }
}
