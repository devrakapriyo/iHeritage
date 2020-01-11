<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class content_event_tbl extends Model
{
    protected $table = 'content_event';

    public static function listEvent($content_id, $limit)
    {
        return self::select('id','name','name_en','banner','seo','short_description_ind','short_description_en','price','start_date','map_area_detail')->where('content_id', $content_id)->where('is_active',"Y")->where('is_publish',"Y")->orderBy('id','desc')->take($limit)->get();
    }
}
