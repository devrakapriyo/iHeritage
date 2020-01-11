<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class content_edu_tbl extends Model
{
    protected $table = 'content_edu_program';

    public static function listEducation($content_id, $limit)
    {
        return self::select('id','name','name_en','banner','seo','description_ind','description_en','map_area_detail')->where('content_id', $content_id)->where('is_active',"Y")->where('is_publish',"Y")->orderBy('id','desc')->take($limit)->get();
    }
}
