<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Admin',
               'email'=>'admin@admin.com',
               'is_admin'=>'1',
               'password'=> bcrypt('123456'),

            ],

            [
               'name'=>'Wizard',
               'email'=>'wizard95@wacopyingy.com',
               'is_admin'=>'0',
               'password'=> bcrypt('123456'),
            ],

            [
                'name'=>'Claffy',
                'email'=>'claffy@pieridesgarage.com',
                'is_admin'=>'0',
                'password'=> bcrypt('123456'),
            ],

            [
                'name'=>'Lilc',
                'email'=>'lilc2@kientao.tech',
                'is_admin'=>'0',
                'password'=> bcrypt('123456'),
            ],
        
            [
                'name'=>'Teari Tup',
                'email'=>'tearitup69@productsproz.com',
                'is_admin'=>'0',
                'password'=> bcrypt('123456'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
