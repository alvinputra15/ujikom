<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData =  [
            [
                'name'=> 'admin',
                'email'=>'admin@gmail.com',
                'level'=>'admin',
                'foto_profile'=>'',
                'telepon'=>'123',
                'password'=>bcrypt('123456')
            ],
            [
                'name'=> 'Petugas',
                'email'=>'petugas@gmail.com',
                'level'=>'petugas',
                'foto_profile'=>'',
                'telepon'=>'123',
                'password'=>bcrypt('123456')
            ],
            [
                'name'=> 'User',
                'email'=>'user@gmail.com',
                'level'=>'user',
                'foto_profile'=>'',
                'telepon'=>'123',
                'password'=>bcrypt('123456')
            ]
            ];

            foreach($userData as $key => $val){
                User::create($val);
            }
    }
}
