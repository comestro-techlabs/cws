<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Category;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Feature;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['courses'] = Course::paginate(20);
        return view("admin.manageCourse",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.insertCourse');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $course = new Course();
        $course->title = $request->title;
        $course->course_code = $request->course_code; 
        $course->slug = Str::slug($request->title);
        $course->save();
        return redirect()->route('course.show', array('course' => $course));
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $courseData = Course::with('features')->findOrFail($course->id);
        $categories = Category::all();  
        $allFeatures = Feature::all();
        return view("admin.viewCourse", array("course" => $courseData,'categories' => $categories, "allFeatures" => $allFeatures));
    }


    public function addFeature(Request $request, $id)
{
    $course = Course::findOrFail($id);
    $course->features()->sync($request->input('features'));

    return redirect()->back()->with('success', 'Features updated successfully');
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('admin.edit_course', ['course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, $field)
    {
        $course = Course::findOrFail($id);
        
        // Define validation rules
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'nullable|numeric',
            'instructor' => 'nullable|string',
            'fees' => 'nullable|numeric',
            'discounted_fees' => 'nullable|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'course_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'course_code' => 'required|string|unique:courses' 
        ];
        
        // Validate only the field being updated
        if ($field == 'course_image') {
            // Special validation for file upload
            $validatedData = $request->validate([
                $field => $rules[$field]
            ]);
        } else {
            // Validate other fields
            $validatedData = $request->validate([
                $field => $rules[$field]
            ]);
        }
      
        // Handle file upload if updating the course_image
        if ($field === 'course_image' && $request->hasFile('course_image')) {
            $image = $request->file('course_image');
            // Store the image and get the path
            $imagePath = $image->store('public/course_images');
            // Update the course image path
            $course->course_image = basename($imagePath);
        } else {
            // Update the specific field for non-file inputs
            $course->$field = $request->input($field);
        }
    
        // Save the course with the updated field
        $course->save();
    
        // Define the required fields for publication
        $requiredFields = ['title', 'description', 'duration', 'instructor', 'fees', 'discounted_fees', 'category_id', 'course_image'];
    
        // Check if all required fields are filled
        $allFieldsCompleted = true;
        foreach ($requiredFields as $requiredField) {
            // if (empty($course->$requiredField)) {
            //     $allFieldsCompleted = false;
            //     break;
            // }
            if (is_null($course->$requiredField)) {
                $allFieldsCompleted = false;
                break;
            }
            
        }
    
        // Update the published status
        $course->published = $allFieldsCompleted;
        $course->save();
    
        return redirect()->route('course.show', $course->id)->with('success', ucfirst($field) . ' updated successfully!');
    }
    

    public function publish(Course $course)
    {
        // Define the required fields for publication
    $requiredFields = ['title', 'description', 'duration', 'instructor', 'fees', 'discounted_fees', 'category_id', 'course_image'];

    // Check if all required fields are filled
    $allFieldsCompleted = true;
    foreach ($requiredFields as $requiredField) {
        if (is_null($course->$requiredField)) {
            $allFieldsCompleted = false;
            break;
        }
        
    }

    // Check if at least one chapter and one feature is added
    $hasChapters = $course->chapters()->exists(); // Check if there are any chapters
    $hasFeatures = $course->features()->exists(); // Check if there are any features

    // Update the published status
    $course->published = $allFieldsCompleted && $hasChapters && $hasFeatures;
    $course->save();

    return redirect()->route('course.show', $course->id);
    }

    public function unpublish($id)
{
    $course = Course::find($id);
    $course->published = false;
    $course->save();

    return redirect()->back()->with('success', 'Course unpublished successfully!');
}

    public function destroy(Course $course)
    {
        Course::find($course->id)->delete();
        return redirect()->route('course.index');
    }

    public function batches(Course $course){
        $data['batches']  = $course->batches()->withCount('users')->get();
        $data['course'] = $course; 
        return view('admin.batches.allBatches',$data);
    }
    public function showStudents(Batch $batch)
{
    $students = $batch->users; 
    $course=$batch->course;
    return view('admin.batches.allStudents', compact('batch', 'students','course'));
}
     
}
