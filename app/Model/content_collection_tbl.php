<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class content_collection_tbl extends Model
{
    protected $table = 'content_collection';

    public static function countCollection($admin_master, $instantion)
    {
        if($admin_master == "Y")
        {
            return self::select('name')->where('is_active', "Y")->count();
        }else{
            return self::join('content', 'content.id', '=', 'content_collection.content_id')->where('institutional_id', $instantion)->where('content_collection.is_active', "Y")->count();
        }
    }

    public static function countCollectionType($content_id, $type)
    {
        if($type == "all")
        {
            return self::select('name')->where('content_id',$content_id)->where('is_active', "Y")->count();
        }else{
            return self::select('name')->where('content_id',$content_id)->where('media_typle',$type)->where('is_active', "Y")->count();
        }
    }

    public static function fieldContent($id, $field)
    {
        return self::select($field)->where('id',$id)->first()->$field;
    }

    public static function listCollection($content_id, $limit)
    {
        return self::select('id','name','name_en','banner','media_type','description_ind','description_en','place_id','media_type','topic')->where('content_id', $content_id)->where('is_active',"Y")->orderBy('id','desc')->take($limit)->get();
    }

    public static function groupTopic()
    {
        return self::select('topic')->where('is_active', "Y")->groupBy('topic')->get();
    }
}
