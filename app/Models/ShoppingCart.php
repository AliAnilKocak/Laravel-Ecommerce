<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class ShoppingCart extends Model
{
    use SoftDeletes;
    protected $table = "shoppingcart";

    protected $fillable = ['user_id'];
    //protected $guard = [];

    public function order()
    {
        return $this->hasOne('App\Models\Order');
    }

    public function shoppingcartProduct()
    {
        return $this->hasMany('App\Models\ShoppingCartProduct','shoppingcart_id');
    }

    public static function active_shoppingcart_id()
    {
        $active_shoppingcart = DB::table('shoppingcart as s')
            ->leftJoin('order as o', 'o.shoppingcart_id', '=', 's.id')
            ->where('s.user_id', auth()->id())
            ->whereRaw('o.id is null')
            ->orderByDesc('s.created_at')
            ->select('s.id')
            ->first();

        if (!is_null($active_shoppingcart)) {
            return $active_shoppingcart->id;
        };
    }



    public  function shoppingCartProductAmount()
    {
        return DB::table('shoppingcart_product')->where('shoppingcart_id', $this->id)->sum('count');
    }

    public function user(){
        return $this->belongsTo('App\_UsersModel');
    }
}
