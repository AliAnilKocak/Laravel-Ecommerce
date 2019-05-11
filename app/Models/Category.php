<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = "category";
  //  protected $fillable = ['name','slug']; //Add column permission
    protected $guarded = []; //this all columns are addable

    public function products(){
        return $this->belongsToMany('App\Models\Product','category_product');
        //Bir kategoriye ait ürünleri getirir. belongToMany M:M ilişkiyi işaret eder.
    }

}
