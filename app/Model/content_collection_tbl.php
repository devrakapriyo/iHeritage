<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class content_collection_tbl extends Model
{
    protected $table = 'content_collection';

    public static function countCollectionType($content_id, $type)
    {
        if($type == "all")
        {
            return self::select('name')->where('content_id',$content_id)->where('is_active', "Y")->count();
        }else{
            return self::select('name')->where('content_id',$content_id)->where('media_typle',$type)->where('is_active', "Y")->count();
        }
    }
}
