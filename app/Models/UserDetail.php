<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_detail'; //tablonun ismi.
    protected $timestamps = false; //tarih bilgileri tutumayacak.
    protected $guarded = []; //tüm alanlara ekleme yapılabilir.


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
