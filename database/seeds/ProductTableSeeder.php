<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductDetails;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Product::truncate();
        ProductDetails::truncate();

        for ($i = 0; $i < 30; $i++) {
            $name = $faker->sentence(2);
            $product = Product::create([
                'name' => $name,
                'slug' => str_slug($name),
                'description' => $faker->sentence(20),
                'price' => $faker->randomFloat(3, 1, 20),
            ]);


            //Pratik bir kullanım. product->detail->create diyerek detay sayfasına ekleme yapabiliyoruz.
            //Yani kendisi otomatik olarak product_id'yi gönderiyor.
            $detail = $product->detail()->create([
                'show_slider' => rand(0, 1),
                'show_day_opportunity' => rand(0, 1),
                'show_featured' => rand(0, 1),
                'show_bestselling' => rand(0, 1),
                'show_reduced' => rand(0, 1),
            ]);
            # code...
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
