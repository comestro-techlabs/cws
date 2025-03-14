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
                'title' => 'Web Development',
                'description' => 'Learn modern web development technologies including HTML, CSS, JavaScript, PHP, and popular frameworks.',
            ],
            [
                'title' => 'Programming',
                'description' => 'Master programming fundamentals and advanced concepts with popular languages like Python, Java, and C++.',
            ],
            [
                'title' => 'Database',
                'description' => 'Understand database design, management, and optimization with various database systems.',
            ],
            [
                'title' => 'Mobile Development',
                'description' => 'Create mobile applications for iOS and Android platforms using modern frameworks.',
            ]
        ];

        foreach ($categories as $category) {
            Category::create([
                'cat_title' => $category['title'],
                'cat_description' => $category['description'],
                'cat_slug' => Str::slug($category['title']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
