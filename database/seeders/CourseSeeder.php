<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Course categories array for realistic course names
        $courseTypes = [
            'Web Development' => [
                'HTML & CSS Fundamentals',
                'JavaScript Mastery',
                'PHP Development',
                'Laravel Framework',
                'React.js Essentials',
                'Vue.js Development',
                'Full Stack Development',
                'REST API Development',
            ],
            'Programming' => [
                'Python Programming',
                'Java Development',
                'C++ Fundamentals',
                'Data Structures',
                'Algorithms',
                'Object-Oriented Programming',
            ],
            'Database' => [
                'MySQL Fundamentals',
                'MongoDB Basics',
                'PostgreSQL Development',
                'Database Design',
            ],
            'Mobile Development' => [
                'Android Development',
                'iOS Development',
                'React Native',
                'Flutter Development',
            ],
        ];

        // Instructors array for realistic names
        $instructors = [
            'John Smith', 'Sarah Johnson', 'Michael Brown',
            'Emily Davis', 'David Wilson', 'Jessica Taylor',
            'Robert Anderson', 'Jennifer Martinez'
        ];

        // Generate 50 courses
        for ($i = 0; $i < 50; $i++) {
            // Pick a random course type and course
            $categoryName = array_rand($courseTypes);
            $courses = $courseTypes[$categoryName];
            $courseTitle = $courses[array_rand($courses)];

            // Add a unique identifier to make titles unique
            $uniqueTitle = $courseTitle . ' - ' . Str::random(4);

            $regularFees = $faker->randomElement([15000, 20000, 25000, 30000, 35000]);
            $discountedFees = $regularFees * 0.8; // 20% discount

            Course::create([
                'title' => $uniqueTitle,
                'slug' => Str::slug($uniqueTitle),
                'course_code' => strtoupper(Str::random(3)) . rand(1000, 9999),
                'description' => $faker->paragraphs(3, true),
                'duration' => $faker->randomFloat(1, 1, 6), // Duration in months
                'instructor' => $instructors[array_rand($instructors)],
                'fees' => $regularFees,
                'discounted_fees' => $discountedFees,
                'category_id' => rand(1, 4), // Assuming you have 4 categories
                'course_image' => 'courses/course-' . rand(1, 5) . '.jpg', // Assuming you have default images
                'published' => $faker->boolean(80), // 80% chances of being published
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}
