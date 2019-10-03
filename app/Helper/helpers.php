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

        if (!file_exists($path))
        {
            mkdir($path, 0777, true);
        }
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

    public static function uploadMedia($images, $name, $path, $size)
    {
        $image = $images;
        if ($image->getSize() > $size)
        {
            return false;
        }

        $extension = strstr($image->getClientOriginalName(), '.');
        $fileName = $name . $extension;

        if (!file_exists($path))
        {
            mkdir($path, 0777, true);
        }
        $image->move($path, $fileName);

        return $fileName;
    }
    public static function validationMedia($image, $media)
    {
        if($media == "image")
        {
            if (($image->getMimeType() != 'image/jpeg') && ($image->getMimeType() != 'image/png'))
            {
                return false;
            } else {
                return true;
            }
        }else if($media == "audio"){
            if (($image->getMimeType() != 'application/octet-stream') && ($image->getMimeType() != 'audio/mpeg') && ($image->getMimeType() != 'audio/mp3'))
            {
                return false;
            } else {
                return true;
            }
        }else if($media == "document"){
            if ($image->getMimeType() != 'application/pdf')
            {
                return false;
            } else {
                return true;
            }
        }
    }
}
