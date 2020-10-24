<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Author unknown',
                'email' => 'author_unknown@g.g',
                'password' => Hash::make(Str::random(16))
            ],
            [
                'name' => 'Test',
                'email' => 'test@test.ru',
                'password' => Hash::make('test')
            ]
        ];

        \DB::table('users')->insert($data);
    }
}