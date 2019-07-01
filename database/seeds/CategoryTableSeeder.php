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
       // DB::table('category')->truncate();


        $id = DB::table('category')->insertGetId([
            'name' => 'Elektronik',
            'slug' => 'Elektronik'
        ]);

        DB::table('category')->insert([
            'name' => 'Bilgisayar/Tablet',
            'slug' => 'bilgisayar-tablet',
            'parent_id' => $id
        ]);
        DB::table('category')->insert([
            'name' => 'Foto/Kamera',
            'slug' => 'foto-kamera',
            'parent_id' => $id
        ]);
        DB::table('category')->insert([
            'name' => 'Telefon',
            'slug' => 'telefon',
            'parent_id' => $id
        ]);
        DB::table('category')->insert([
            'name' => 'Beyaz Eşya',
            'slug' => 'beyaz-esya',
            'parent_id' => $id
        ]);

        $idBook =   DB::table('category')->insertgetId([
            'name' => 'Kitap',
            'slug' => 'Kitap'
        ]);
        DB::table('category')->insert([
            'name' => 'Roman',
            'slug' => 'roman',
            'parent_id' => $idBook
        ]);
        DB::table('category')->insert([
            'name' => 'Tarih',
            'slug' => 'tarih',
            'parent_id' => $idBook
        ]);
        DB::table('category')->insert([
            'name' => 'Kişisel Gelişim',
            'slug' => 'kisisel-gelisim',
            'parent_id' => $idBook
        ]);
        DB::table('category')->insert([
            'name' => 'Ders Kitabı',
            'slug' => 'ders-kitabı',
            'parent_id' => $idBook
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
