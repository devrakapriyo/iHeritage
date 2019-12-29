<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class visiting_order extends Model
{
    protected $table = 'visiting_order';

    public static function get_visitor_order($id)
    {
        $visiting_order = visiting_order::select('education_id', 'event_id')->where('id', $id)->first();
        if($visiting_order->education_id != null)
        {
            $education = content_edu_tbl::select('name')->where('id', $visiting_order->education_id)->first()->name;
            $result = "Education - ".$education;
        }elseif($visiting_order->event_id != null){
            $event = content_event_tbl::select('name')->where('id', $visiting_order->event_id)->first()->name;
            $result = "Event - ".$event;
        }else{
            $result = "-";
        }

        return $result;
    }
}
