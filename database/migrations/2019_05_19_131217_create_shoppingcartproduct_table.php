<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingcartproductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoppingcart_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shoppingcart_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('count');
            $table->decimal('price',5,2);
            $table->string('status',30);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes(); 


            $table->foreign('shoppingcart_id')->references('id')->on('shoppingcart')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shoppingcart_product');
    }
}
