<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Batch;
use Carbon\Carbon;

class BatchSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();

        if ($courses->isEmpty()) {
            $this->command->info('Please seed courses first.');
            return;
        }

        $batchNames = [
            'Morning',
            'Evening',
            'Weekend',
            'Fast Track',
            'Regular'
        ];

        foreach ($courses as $course) {
            // Create 2-3 batches per course
            $numBatches = rand(2, 3);
            
            for ($i = 0; $i < $numBatches; $i++) {
                $startDate = Carbon::now()->addDays(rand(-30, 30)); // Random start dates
                $duration = $course->duration ?? 12; // Default to 12 weeks if duration not set
                
                Batch::create([
                    'course_id' => $course->id,
                    'batch_name' => $batchNames[array_rand($batchNames)] . ' Batch ' . ($i + 1),
                    'start_date' => $startDate,
                    'end_date' => $startDate->copy()->addWeeks($duration),                    
                ]);
            }
        }
    }
}
