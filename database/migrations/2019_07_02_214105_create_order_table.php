<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shoppingcart_id')->unsigned();
            $table->decimal('price', 10, 4);
            $table->string('status')->nullable();


            $table->string('full_name')->nullable();
            $table->string('adress')->nullable();
            $table->string('tel_no')->nullable();
            $table->string('number')->nullable();
            $table->string('bank')->nullable();
            $table->integer('hire')->nullable();


            $table->unique('shoppingcart_id');
            $table->foreign('shoppingcart_id')->references('id')->on('shoppingcart')->onDelete('cascade');


            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
