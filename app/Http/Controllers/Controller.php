<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function get_json_latitude_longitude($status, $latitude, $longitude, $address)
    {
        return response()->json(['status' => $status, 'latitude' => $latitude, 'longitude' => $longitude, 'address' => $address]);
    }
}
