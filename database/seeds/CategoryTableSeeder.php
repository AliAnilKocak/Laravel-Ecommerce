<?php

use Illuminate\Database\Seeder;
use Illuminate\support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->truncate();
        DB::table('category')->insert([
            'name' => 'Elektronik',
            'slug' => 'Elektronik'
        ]);
        DB::table('category')->insert([
            'name' => 'Kitap',
            'slug' => 'Kitap'
        ]);
        DB::table('category')->insert([
            'name' => 'Dergi',
            'slug' => 'Dergi'
        ]);
        DB::table('category')->insert([
            'name' => 'Mobilya',
            'slug' => 'Mobilya'
        ]);
        DB::table('category')->insert([
            'name' => 'Dekorasyon',
            'slug' => 'Dekorasyon'
        ]);
        DB::table('category')->insert([
            'name' => 'Kozmetik',
            'slug' => 'Kozmetik'
        ]);
        DB::table('category')->insert([
            'name' => 'Kişisel Bakım',
            'slug' => 'Kişisel Bakım'
        ]);
        DB::table('category')->insert([
            'name' => 'Giyim ve Moda',
            'slug' => 'Giyim ve Moda'
        ]);
        DB::table('category')->insert([
            'name' => 'Anne ve Çocuk',
            'slug' => 'Anne ve Çocuk'
        ]);
    }
}
