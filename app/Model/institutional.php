<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class institutional extends Model
{
    protected $table = 'institutional';

    public static function listInstitutional()
    {
        return self::select('id','institutional_name')->where('is_active', "Y")->get();
    }
}
