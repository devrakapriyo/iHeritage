<?php

namespace App\Helper;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class helpers extends Model
{
    public static function uploadImage($images, $name, $path)
    {
        $image = $images;
        if ($image->getSize() > 10000000)
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

    public static function monthEn()
    {
        return $month = [
            '01'=>"January",
            '02'=>"February",
            '03'=>"March",
            '04'=>"April",
            '05'=>"May",
            '06'=>"June",
            '07'=>"July",
            '08'=>"August",
            '09'=>"September",
            '10'=>"October",
            '11'=>"November",
            '12'=>"December",
        ];
    }

    public static function monthInd()
    {
        return $month = [
            '01'=>"Januari",
            '02'=>"Februari",
            '03'=>"Maret",
            '04'=>"April",
            '05'=>"Mei",
            '06'=>"Juni",
            '07'=>"Juli",
            '08'=>"Agustus",
            '09'=>"September",
            '10'=>"Oktober",
            '11'=>"November",
            '12'=>"Desember",
        ];
    }

    public static function dateFormat($date)
    {
        $arr_date = explode("-", $date);
        if(App::isLocale('id'))
        {
            $month = [
                '01'=>"Januari",
                '02'=>"Februari",
                '03'=>"Maret",
                '04'=>"April",
                '05'=>"Mei",
                '06'=>"Juni",
                '07'=>"Juli",
                '08'=>"Agustus",
                '09'=>"September",
                '10'=>"Oktober",
                '11'=>"November",
                '12'=>"Desember",
            ];
            $result_month = $month[$arr_date[1]];
        }else{
            $month = [
                '01'=>"January",
                '02'=>"February",
                '03'=>"March",
                '04'=>"April",
                '05'=>"May",
                '06'=>"June",
                '07'=>"July",
                '08'=>"August",
                '09'=>"September",
                '10'=>"October",
                '11'=>"November",
                '12'=>"December",
            ];
            $result_month = $month[$arr_date[1]];
        }

        return $arr_date[2].", ".$result_month." ".$arr_date[0];
    }

    public static function dateFormatTime($date)
    {
        $arr_date_time = explode(" ", $date);
        $arr_date = explode("-", $arr_date_time[0]);
        if(App::isLocale('id'))
        {
            $month = [
                '01'=>"Januari",
                '02'=>"Februari",
                '03'=>"Maret",
                '04'=>"April",
                '05'=>"Mei",
                '06'=>"Juni",
                '07'=>"Juli",
                '08'=>"Agustus",
                '09'=>"September",
                '10'=>"Oktober",
                '11'=>"November",
                '12'=>"Desember",
            ];
            $result_month = $month[$arr_date[1]];
        }else{
            $month = [
                '01'=>"January",
                '02'=>"February",
                '03'=>"March",
                '04'=>"April",
                '05'=>"May",
                '06'=>"June",
                '07'=>"July",
                '08'=>"August",
                '09'=>"September",
                '10'=>"October",
                '11'=>"November",
                '12'=>"December",
            ];
            $result_month = $month[$arr_date[1]];
        }

        return $arr_date[2].", ".$result_month." ".$arr_date[0]." ".$arr_date_time[1];
    }
}
