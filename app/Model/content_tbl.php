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

    public static function listContentCategory($category, $limit)
    {
        return self::select('content.*','category_content.category')
            ->join('category_content','category_content.id',"=",'content.category_ctn_id')
            ->join('institutional','institutional.id',"=",'content.institutional_id')
            ->join('place','place.id',"=",'institutional.place_id')
            ->where('category_content.category', $category)
            ->where('content.is_active', "Y")
            ->orderBy('place.id', 'asc')
            ->take($limit)
            ->get();
    }

    public static function content($user)
    {
        return self::select('id','name')->where('institutional_id',$user)->where('is_active', "Y")->first();
    }

    public static function fieldContent($id, $field)
    {
        return self::select($field)->where('id',$id)->first()->$field;
    }

    public static function countAppr($admin_master, $instantion)
    {
        if($admin_master == "Y")
        {
            return self::select('name')->where('is_active', "N")->count();
        }else{
            return self::where('institutional_id', $instantion)->where('is_active', "Y")->count();
        }
    }

    public static function countWaitingAppr($category)
    {
        $data = self::select('category')
            ->join('institutional', 'institutional.id', '=', 'content.institutional_id')
            ->where('category',$category)
            ->where('content.is_active',"N");

        if(empty($data->first()))
        {
            return 0;
        }else{
            return $data->count();
        }
    }

    public static function groupInstitution()
    {
        return self::select('category_ctn_id')->where('is_active', "Y")->groupBy('category_ctn_id')->get();
    }
}
