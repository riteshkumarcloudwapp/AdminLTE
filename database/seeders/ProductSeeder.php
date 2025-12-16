<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**s
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('products')->insert([
            [
                'title' => 'Wireless Headphones',
                'description' => 'Comfortable wireless headphones with active noise cancellation.',
                'actual_price' => 5999.00,
                'discount_price' => 4999.00,
                'image' => 'headphone1.jpg',
                'tags' => 'audio,wireless,headphones',
                'status' => 1,
            ],
            [
                'title' => 'Smart Watch Pro',
                'description' => 'Fitness tracking smart watch with heart-rate monitor.',
                'actual_price' => 7999.00,
                'discount_price' => 6999.00,
                'image' => 'smartwatch1.jpg',
                'tags' => 'smart,watch',
                'status' => 1,
            ],
            [
                'title' => 'Portable Speaker',
                'description' => 'Waterproof portable Bluetooth speaker with 12h battery life.',
                'actual_price' => 2499.00,
                'discount_price' => 1999.00,
                'image' => 'speaker1.jpg, speaker2.jpg, speaker3.jpg',
                'tags' => 'audio,speaker,portable',
                'status' => 1,
            ],
            [
                'title' => 'DSLR Camera',
                'description' => 'High-resolution DSLR camera for professional photography.',
                'actual_price' => 45999.00,
                'discount_price' => 42999.00,
                'image' => 'camera2.jpg, camera3.jpg',
                'tags' => 'camera,photography,dslr',
                'status' => 1,
            ],
            [
                'title' => 'Gaming Laptop',
                'description' => 'Powerful gaming laptop with high refresh rate display.',
                'actual_price' => 89999.00,
                'discount_price' => 84999.00,
                'image' => 'laptop1.jpg',
                'tags' => 'laptop,gaming,pc',
                'status' => 1,
            ],
        ]);
    }
}
