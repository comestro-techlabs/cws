<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use Carbon\Carbon;

class MarkOnlineAttendance
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Get user's online courses
            $onlineCourses = $user->courses()
                ->where('course_type', 'online')
                ->with('batches')
                ->get();

            foreach ($onlineCourses as $course) {
                $batch = $course->pivot->batch_id ? $course->batches->find($course->pivot->batch_id) : null;

                if ($batch) {
                    // Check if attendance already marked today
                    $existingAttendance = Attendance::where('user_id', $user->id)
                        ->where('course_id', $course->id)
                        ->where('batch_id', $batch->id)
                        ->whereDate('check_in', Carbon::today())
                        ->exists();

                    if (!$existingAttendance) {
                        Attendance::create([
                            'user_id' => $user->id,
                            'check_in' => now(),
                            'course_id' => $course->id,
                            'batch_id' => $batch->id,
                            'attendance_type' => 'online'
                        ]);
                    }
                }
            }
        }

        return $next($request);
    }
}
