<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "user_admin";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function countAdmin($admin_master, $instantion)
    {
        if($admin_master == "Y")
        {
            return self::where('is_active', "Y")->where('is_delete',"N")->count();
        }else{
            return self::where('institutional_id', $instantion)->where('is_active', "Y")->where('is_delete',"N")->count();
        }
    }

    public static function countWaitingAppr()
    {
        $data = self::select('is_active')->where('is_active',"N")->where('is_delete',"N");

        if(empty($data->first()))
        {
            return 0;
        }else{
            return $data->count();
        }
    }
}
