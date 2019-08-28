<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class place_tbl extends Model
{
    protected $table = 'place';

    public static function listSearch()
    {
        return self::select('id','place_ind','place_en')->get();
    }
}
