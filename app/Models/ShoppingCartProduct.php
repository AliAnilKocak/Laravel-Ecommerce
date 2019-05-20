<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCartProduct extends Model
{
    use SoftDeletes;
    protected $table = "shoppingcart_product";
      protected $guard = [];
}
