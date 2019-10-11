<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class place_tbl extends Model
{
    protected $table = 'place';

    public static function listSearch()
    {
        return self::select('id','place_ind','place_en')->get();
    }

    public static function placeNameLang($id)
    {
        $name = self::select('place_ind','place_en')->where('id',$id)->first();
        if(App::isLocale('id'))
        {
            return $name->place_ind;
        }else{
            return $name->place_en;
        }
    }
}
