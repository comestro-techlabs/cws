<?php

namespace App\Livewire\Public\ViewAllCourses;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class AllCourses extends Component
{
    public $search = '';
    public $courseType = '';
    public $priceRange = '';
    public $page = 1;
    public $perPage = 10;
    public $hasMorePages = true;
    public $loading = false;

    public function loadMore()
    {
        $this->loading = true;
        $this->page++;
        $this->loading = false;
    }

    public function render()
    {
        $this->loading = true;
        $courses = Course::query()
            ->where('published', true)
            ->when($this->search, function($query) {
                return $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->courseType, function($query) {
                return $query->where('course_type', $this->courseType);
            })
            ->when($this->priceRange, function($query) {
                return match($this->priceRange) {
                    'free' => $query->where('discounted_fees', 0),
                    'paid' => $query->where('discounted_fees', '>', 0),
                    default => $query
                };
            })
            ->orderBy('created_at', 'desc')
            ->take($this->page * $this->perPage)
            ->get();

        $this->hasMorePages = $courses->count() === $this->page * $this->perPage;
        $this->loading = false;

        return view('livewire.public.viewallcourses.all-courses', [
            'courses' => $courses
        ]);
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->courseType = '';
        $this->priceRange = '';
        $this->page = 1;
    }
}
