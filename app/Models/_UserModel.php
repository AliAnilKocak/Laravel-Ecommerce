<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class _UsersModel extends Authenticatable
{

    use SoftDeletes;
    protected $table = 'user';
    protected $fillable = [
        'full_name', 'email', 'password','activation_key','is_active','is_admin'
    ];

    protected $hidden = [
        'password', 'activation_key',
    ];


    public function detail()
    {
        return $this->hasOne('App\Models\UserDetail','user_id')->withDefault();
        //withdefault varsayılanir model atar
    }
}
