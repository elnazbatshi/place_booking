<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $faker = Factory::create();


        $user = User::create([
            'name'     => 'admin',
            'email'    => 'admin@admin.com',
            'password' => '$2y$10$SafxrUdqumNlSSFmEaN63.AnGt5iqDNVOGg2BbQ8hGDhSVoIxdXxe',   /*12345678*/
        ]);
        $user->assignRole('super admin');
        for ($i = 0; $i < rand(5, 50); $i++) {
            $year = rand(18, 45);
            User::create([
                'name'     => $faker->name(),
                'email'    => $faker->email(),
                'password' => '$2y$10$SafxrUdqumNlSSFmEaN63.AnGt5iqDNVOGg2BbQ8hGDhSVoIxdXxe',

            ]);
        }


    }
}
