<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::create([
        //     'name' => 'Test User new shaique',
        //     'email' => 'testnewshaique@example.com',
        //     'contact'=> 123456787,
        //     'gender'=>'male',
        //     'education_qualification'=>' BCA'
        // ]);
        $this->call([
            SubscriptionPlanSeeder::class,  // Add this line
            CategorySeeder::class,        // Categories first
            CourseSeeder::class,          // Courses second
            PostCourseSeeder::class,
            PostChapterSeeder::class,
            PostTopicPostSeeder::class,
            PostMyPostSeeder::class,
            MockTestSeeder::class,        // Mock tests after courses
            ProductCategorySeeder::class, // Product categories after mock tests
            ProductSeeder::class,         // Products after mock testsP
            UserSeeder::class,            // Users must be first
            CategorySeeder::class,        // Categories before courses
            CourseSeeder::class,          // Courses before batches
            BatchSeeder::class,           // Batches before assignments
            CourseUserSeeder::class,      // Enroll users in courses
            AssignmentSeeder::class,      // Assignments last
        ]);
    }
}
