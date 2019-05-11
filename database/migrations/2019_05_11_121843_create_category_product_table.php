<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *v
     * @return void
     */
    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned(); //sadece pozitif sayılar
            $table->integer('product_id')->unsigned();

            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            //category tablosundaki id'yi category_id'ye iliştirmiş oldum
            //Çoka çok M:M ilişki oluşturdum.
            //cascade bir ürün veya kategori silindiğinde bu tablodan da sil anlamında.
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            //product tablosundaki id'yi product_id'ye iliştirmiş oldum

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_product');
    }
}
