<?php

namespace App\Helper;

use Illuminate\Database\Eloquent\Model;

class helpers extends Model
{
    public static function uploadImage($images, $name, $path)
    {
        $image = $images;
        if ($image->getSize() > 1000000)
        {
            return false;
        }

        $extension = strstr($image->getClientOriginalName(), '.');
        $fileName = $name . $extension;
        $image->move($path, $fileName);

        return $fileName;
    }

    public static function validationImage($image)
    {
        if (($image->getMimeType() != 'image/jpeg') && ($image->getMimeType() != 'image/png'))
        {
            return false;
        } else {
            return true;
        }
    }
}
