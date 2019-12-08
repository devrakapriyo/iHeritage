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

    public static function content($user)
    {
        return self::select('id','name')->where('institutional_id',$user)->where('is_active', "Y")->first();
    }

    public static function fieldContent($id, $field)
    {
        return self::select($field)->where('id',$id)->first()->$field;
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
}
