<?php

namespace App\Livewire\Admin\Course;

use App\Models\Chapter;
use App\Models\Lesson;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class LessonManager extends Component
{
    public $chapter;
    public $lessonTitle;
    public $editingLesson = null;
    public $editedTitle;

    protected $rules = [
        'lessonTitle' => 'required|string|max:255',
        'editedTitle' => 'required|string|max:255',
    ];

    public function mount(Chapter $chapter)
    {
        $this->chapter = $chapter;
    }

    public function addLesson()
    {
        $this->validate([
            'lessonTitle' => 'required|string|max:255'
        ]);

        $this->chapter->lessons()->create([
            'title' => $this->lessonTitle,
        ]);

        $this->reset('lessonTitle');
        $this->dispatch('notice', type: 'info', text: 'Lesson added successfully!');
    }

    public function startEditing(Lesson $lesson)
    {
        $this->editingLesson = $lesson;
        $this->editedTitle = $lesson->title;
    }

    public function cancelEditing()
    {
        $this->editingLesson = null;
        $this->editedTitle = '';
    }

    public function updateLesson()
    {
        if (!$this->editingLesson) {
            return;
        }

        $this->validate([
            'editedTitle' => 'required|string|max:255'
        ]);

        $this->editingLesson->update([
            'title' => $this->editedTitle
        ]);

        $this->editingLesson = null;
        $this->editedTitle = '';
        $this->dispatch('notice', type: 'info', text: 'Lesson updated successfully!');
    }

    public function deleteLesson($lessonId)
    {
        $lesson = Lesson::find($lessonId);
        if ($lesson) {
            $lesson->delete();
            $this->dispatch('alert', 'Lesson deleted successfully.');
        }
    }

    public function render()
    {
        return view('livewire.admin.course.lesson-manager', [
            'lessons' => $this->chapter->lessons
        ]);
    }
}
