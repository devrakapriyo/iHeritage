<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class content_detail_tbl extends Model
{
    protected $table = 'content_detail';

    public static function fieldContent($id, $field)
    {
        return self::select($field)->where('content_id',$id)->first()->$field;
    }
}
