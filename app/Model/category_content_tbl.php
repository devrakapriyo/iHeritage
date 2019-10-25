<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class category_content_tbl extends Model
{
    protected $table = 'category_content';

    public static function listCategory($category)
    {
        return self::select('id','category_ctn_name_en','category_ctn_name_ind')->where('category', $category)->get();
    }

    public static function getIDCategoryContent($category)
    {
        return self::select('id')->where('category', $category)->first()->id;
    }
}
