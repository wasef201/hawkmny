<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete([1, 2]);
        \DB::table('users')->insert([
                        [
                            'id' => 1,
                            'type' => 'admin',
                            'name' => 'admin',
                            'email' => 'admin@demo.com',
                            'section' => null,
                            'area_id' => null,
                            'city_id' => null,
                            'password' => \Hash::make('123123123'),
                            'number' => '123123',
                            'phone' => '123123',
                            'approved' => 1,
                            'is_active' => true,
                            'email_verified_at' => now(),
                            'created_at' => now(),
                            'updated_at' => now()
                        ],
                        [
                            'id' => 2,
                            'type' => 'association',
                            'name' => 'association',
                            'email' => 'association@demo.com',
                            'section' => 1,
                            'area_id' => 1,
                            'city_id' => 1,
                            'password' => \Hash::make('123123123'),
                            'number' => '123123',
                            'phone' => '123123',
                            'approved' => 1,
                            'is_active' => true,
                            'email_verified_at' => now(),
                            'created_at' => now(),
                            'updated_at' => now()
                        ],
                ]);
    }
}
