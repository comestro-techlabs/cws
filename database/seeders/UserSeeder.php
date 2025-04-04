<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'contact' => '1234567890',
            'gender' => 'male',
            'education_qualification' => 'BCA',
            'isAdmin' => true,
        ]);

        // Create regular students
        $students = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'contact' => '9876543210',
                'gender' => 'male',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'contact' => '8765432109',
                'gender' => 'female',
            ],
            // Add more students as needed
        ];

        foreach ($students as $student) {
            User::create([
                'name' => $student['name'],
                'email' => $student['email'],
                'password' => Hash::make('password'),
                'contact' => $student['contact'],
                'gender' => $student['gender'],
                'education_qualification' => array_rand(['BCA', 'MCA', 'B.COM', 'BBA']),
                'isAdmin' => false,
            ]);
        }
    }
}
