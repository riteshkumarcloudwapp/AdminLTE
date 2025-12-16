<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('testimonials')->insert([
            [
                'name' => 'Shayam Tiyagi',
                'images' => 'avatar.png',
                'description' => 'Excellent service and great quality products. Highly recommended!',
                'designation' => 'CEO, Tech Solutions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Priya Sharma',
                'images' => 'avatar2.png',
                'description' => 'Amazing experience with the team. Very professional and responsive.',
                'designation' => 'Marketing Director, Digital Inc',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rajesh Kumar',
                'images' => 'avatar3.png',
                'description' => 'Outstanding support and delivery. Will definitely work with them again.',
                'designation' => 'Founder, StartUp Labs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Neha Verma',
                'images' => 'avatar4.png',
                'description' => 'Great attention to detail and perfect execution. Exceeded expectations!',
                'designation' => 'Product Manager, Cloud Systems',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Arjun Singh',
                'images' => 'avatar5.png',
                'description' => 'Reliable, trustworthy, and always on time. A pleasure to work with.',
                'designation' => 'Operations Head, Global Corp',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
