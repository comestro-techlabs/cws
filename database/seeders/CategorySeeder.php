<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'cat_title' => 'Web Development',
                'cat_description' => 'Learn modern web development technologies including HTML, CSS, JavaScript, PHP, and popular frameworks.',
            ],
            [
                'cat_title' => 'Mobile Development',
                'cat_description' => 'Master mobile app development for iOS and Android platforms.',
            ],
            [
                'cat_title' => 'Data Science',
                'cat_description' => 'Explore data analysis, machine learning, and statistical modeling.',
            ],
            [
                'cat_title' => 'Cloud Computing',
                'cat_description' => 'Learn cloud platforms, services, and deployment strategies.',
            ],
            [
                'cat_title' => 'Cybersecurity',
                'cat_description' => 'Study network security, ethical hacking, and security best practices.',
            ],
        ];

        foreach ($categories as $category) {
            // Check if category exists
            $existingCategory = Category::where('cat_slug', Str::slug($category['cat_title']))->first();
            
            if (!$existingCategory) {
                Category::create([
                    'cat_title' => $category['cat_title'],
                    'cat_slug' => Str::slug($category['cat_title']),
                    'cat_description' => $category['cat_description'],
                ]);
            }
        }
    }
}
