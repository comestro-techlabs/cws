<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = DB::table('product_categories')->pluck('id')->toArray();

        for ($i = 1; $i <= 50; $i++) {
            DB::table('products')->insert([
                'product_category_id' => $categories[array_rand($categories)],
                'name' => 'Product ' . $i,
                'description' => 'Description for product ' . $i,
                'points' => rand(0, 100),
                'imageUrl' => 'http://example.com/image' . $i . '.jpg',
                'availableQuantity' => rand(0, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
