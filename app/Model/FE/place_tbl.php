<?php

namespace App\Model\FE;

use Illuminate\Database\Eloquent\Model;

class place_tbl extends Model
{
    protected $table = "place";

    public static function listSearch()
    {
        return self::select('place_en','id')->orderBy('id','asc')->get();
    }
}
