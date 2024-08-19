<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('features')->insert([
            ['name' => 'Industry Mentorship'],
            ['name' => 'Interview Opportunities'],
            ['name' => 'Project Portfolio'],
            ['name' => 'Career Growth'],
            ['name' => 'Certification'],
            ['name' => 'Career Foundation'],
            ['name' => 'Personalized Coaching'],
            ['name' => 'Job Placement Assistance'],
            ['name' => 'Networking Opportunities'],
            ['name' => 'Real-World Projects'],
            ['name' => 'Flexible Learning Schedule'],
            ['name' => 'Hands-on Workshops'],
            ['name' => 'Online Resources'],
            ['name' => 'Expert Guidance'],
            ['name' => 'Peer Collaboration'],
            ['name' => 'Live Sessions'],
            ['name' => 'Interactive Quizzes'],
            ['name' => 'Dedicated Support'],
            ['name' => 'Access to Industry Tools'],
            ['name' => 'Certificate of Completion'],
            ['name' => 'Customizable Learning Path'],
            ['name' => 'Career Counseling'],
            ['name' => 'Guest Lectures'],
            ['name' => 'Research Opportunities'],
            ['name' => 'Advanced Technology Training'],
            ['name' => 'Group Projects'],
            ['name' => 'Case Studies'],
            ['name' => 'Alumni Network'],
            ['name' => 'Monthly Webinars'],
            ['name' => 'Discounts on Future Courses'],
            ['name' => 'Membership to Professional Organizations'],
        ]);
        
    }
}
