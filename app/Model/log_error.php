<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class log_error extends Model
{
    protected $table = 'log_error';

    public static function simpan($url, $messages)
    {
        $simpan = new log_error;
        $simpan->url = $url;
        $simpan->messages = $messages;
        $simpan->save();

        return $simpan;
    }
}
