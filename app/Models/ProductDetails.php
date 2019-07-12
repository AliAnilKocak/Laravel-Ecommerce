<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    protected $table = 'product_detail';
    public $timestamps = false;
    protected $fillable = ['image_url'];
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
