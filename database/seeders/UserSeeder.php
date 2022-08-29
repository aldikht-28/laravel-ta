<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'Bendahara Masjid',
                'email' => 'bendahara.masjid.albahri@gmail.com',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Bendahara Paud',
                'email' => 'bendahara.paud.albahri@gmail.com',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Bendahara TPQ',
                'email' => 'bendahara.tpq.albahri@gmail.com',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Ketua Yayasan',
                'email' => 'ketua.yayasan.albahri@gmail.com',
                'password' => bcrypt('password'),
            ]
        );
    }
}
