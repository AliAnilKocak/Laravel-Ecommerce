<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShoppingCartProduct extends Model
{
    use SoftDeletes;
    protected $table = "shoppingcart_product";

    protected $guarded  = [];
}
