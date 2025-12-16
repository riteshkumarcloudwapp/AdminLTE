<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Ritesh kumar' ,
                'email' => 'abc@gmail.com' ,
                'password' => Hash::make('ritesh123') ,
                'profile_image' => 'user1-128x128.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Omkar kulkarni' ,
                'email' => 'om@gmail.com' ,
                'password' => Hash::make('om123') ,
                'profile_image' => 'user2-160x160.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sid jha' ,
                'email' => 'sid@gmail.com' ,
                'password' => Hash::make('sid123') ,
                'profile_image' => 'user3-128x128.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chelsi Sharma' ,
                'email' => 'chelsi@gmail.com' ,
                'password' => Hash::make('chelsi123') ,
                'profile_image' => 'user4-128x128.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rohit Sharma' ,
                'email' => 'rohit@gmail.com' ,
                'password' => Hash::make('rohit123') ,
                'profile_image' => 'user5-128x128.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Varun vias' ,
                'email' => 'varun@gmail.com' ,
                'password' => Hash::make('varun123') ,
                'profile_image' => 'avatar6.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chetan yadav' ,
                'email' => 'chetan@gmail.com' ,
                'password' => Hash::make('chetan123') ,
                'profile_image' => 'photo7.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Arshul patidat' ,
                'email' => 'arshul123@gmail.com' ,
                'password' => Hash::make('arshul123') ,
                'profile_image' => 'avatar6.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]

            ]);
    }
}
