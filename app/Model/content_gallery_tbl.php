<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class content_gallery_tbl extends Model
{
    protected $table = 'content_gallery';

    public static function countAlbum($content_id)
    {
        return self::select('photo')->where('content_id',$content_id)->count();
    }
}
