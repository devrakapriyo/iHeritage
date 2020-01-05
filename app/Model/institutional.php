<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class institutional extends Model
{
    protected $table = 'institutional';

    public static function listInstitutional()
    {
        return self::select('id','institutional_name')->where('is_active', "Y")->where('id', '!=', "1")->get();
    }

    public static function getData($parameter, $field)
    {
        return self::select($field)->where('id', $parameter)->first();
    }

    public static function getId($id)
    {
        return content_tbl::select('institutional_id')->where('id',$id)->first()->institutional_id;
    }

    public static function getName($id)
    {
        $content = content_tbl::select('institutional_id')->where('id',$id)->first()->institutional_id;
        return self::select('institutional_name')->where('id', $content)->first()->institutional_name;
    }
}
