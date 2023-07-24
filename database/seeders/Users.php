<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'email' => 'admin123456@gmail.com',
                'password' => 'TieuAn141219',
                'level' => 5,
            ],
            [
                'username' => 'usertest123456',
                'email' => 'usertest123456@gmail.com',
                'password' => '123456testing123456',
                'level' => 0,
            ],
            [
                'username' => 'user1',
                'email' => 'user1@gmail.com',
                'password' => 'userTesting1',
                'level' => 0,
            ],
            [
                'username' => 'usernum2',
                'email' => 'usernum2@gmail.com',
                'password' => 'bestontest',
                'level' => 0,
            ],
            [
                'username' => 'admin12',
                'email' => 'admin123456@gmail.com',
                'password' => 'abcTest123',
                'level' => 1,
            ],
            [
                'username' => 'admin35',
                'email' => 'admin35@gmail.com',
                'password' => 'admin35Testing',
                'level' => 2,
            ],
            [
                'username' => 'dillin',
                'email' => 'giakhanh010200@gmail.com',
                'password' => 'TieuAn14121999',
                'level' => 0,
            ],
        ]);
    }
}
