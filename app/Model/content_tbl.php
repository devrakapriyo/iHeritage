<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class content_tbl extends Model
{
    protected $table = 'content';

    public static function listContent($user)
    {
        return self::select('id','name')->where('institutional_id',$user)->where('is_active', "Y")->get();
    }

    public static function fieldContent($id, $field)
    {
        return self::select($field)->where('id',$id)->first()->$field;
    }
}
