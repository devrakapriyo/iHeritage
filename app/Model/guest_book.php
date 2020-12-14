<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class guest_book extends Model
{
    protected $table = 'guest_book';

    public static function count_visitor($museum_name)
    {
        return self::where('museum',$museum_name)->count();
    }
}
