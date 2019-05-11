<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        Product::truncate();
        for ($i = 0; $i < 30; $i++) {
            $name = $faker->sentence(2);
            Product::create([
                'name' => $name,
                'slug' => str_slug($name),
                'description' => $faker->sentence(20),
                'price' => $faker->randomFloat(3, 1, 20),
            ]);
            # code...
        }
    }
}
