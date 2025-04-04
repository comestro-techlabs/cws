<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('product_categories')->insert([
                'name' => 'Category ' . $i,
                'description' => 'Description for category ' . $i,
                'isActive' => true,
                'imageUrl' => 'http://example.com/category' . $i . '.jpg',
                'availableQuantity' => rand(0, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
