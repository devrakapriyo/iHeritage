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

    public static function listGallery($content_id, $limit)
    {
        if($limit == "all")
        {
            return self::select('photo','id','description_ind','description_en')->where('content_id', $content_id)->orderBy('id','desc')->get();
        }else{
            return self::select('photo','id','description_ind','description_en')->where('content_id', $content_id)->orderBy('id','desc')->take($limit)->get();
        }
    }
}
