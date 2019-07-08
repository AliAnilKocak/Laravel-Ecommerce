<?php

use Illuminate\Database\Seeder;
use App\_UsersModel;
use App\Models\UserDetail;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        _UsersModel::truncate();
        UserDetail::truncate();


        $admin = _UsersModel::create([
            'full_name' => 'Ali Anıl Koçak',
            'email' => 'alianilkocak@gmail.com',
            'password' => Hash::make('123123'),
            'is_active' => 1
        ]);
        $admin->detail()->create([
            'adress' => 'Random adress',
            'number' => 5077992643,
            'tel_number' => 9005077992643
        ]);


        for ($i = 0; $i < 50; $i++) {

            $customer = _UsersModel::create([
                'full_name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt(123456),
                'is_active' => 1
            ]);

            $customer->detail()->create([
                'adress' => $faker->address,
                'number' => $faker->phoneNumber,
                'tel_number' => $faker->phoneNumber
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
