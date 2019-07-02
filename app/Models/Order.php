<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'order';

    protected $fillable = ['shoppingcart_id', 'hire', 'bank', 'price', 'status'];

    public function shoppingcart(){
        return $this->belongsTo('App\Models\ShoppingCart');
    }
}
