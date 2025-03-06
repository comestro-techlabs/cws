<?php

namespace App\Livewire\Admin\Course;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class ChapterManager extends Component
{
    public $course;
    public $chapterTitle;
    public $selectedChapter = null;
    public $lessonTitle;
    public $editingLesson = null;
    public $editedTitle;

    protected $rules = [
        'chapterTitle' => 'required|string|max:255',
        'lessonTitle' => 'required|string|max:255',
        'editedTitle' => 'required|string|max:255',
    ];

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function addChapter()
    {
        $this->validate([
            'chapterTitle' => 'required|string|max:255'
        ]);

        $this->course->chapters()->create([
            'title' => $this->chapterTitle,
        ]);

        $this->reset('chapterTitle');
        $this->dispatch('notice', type: 'info', text: 'Chapter added successfully!');
    }

    public function deleteChapter($chapterId)
    {
        $chapter = Chapter::find($chapterId);
        if ($chapter) {
            $chapter->lessons()->delete(); // Delete associated lessons first
            $chapter->delete();
            $this->selectedChapter = null;
            $this->dispatch('notice', type: 'info', text: 'Chapter deleted successfully!');

        }
    }

    public function selectChapter($chapterId)
    {
        $this->selectedChapter = Chapter::find($chapterId);
        $this->reset(['lessonTitle', 'editingLesson', 'editedTitle']);
    }

    public function addLesson()
    {
        if (!$this->selectedChapter) {
            return;
        }

        $this->validate([
            'lessonTitle' => 'required|string|max:255'
        ]);

        $this->selectedChapter->lessons()->create([
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

            $this->dispatch('notice', type: 'info', text: 'Lesson deleted successfully!');
        }
    }

    public function render()
    {
        return view('livewire.admin.course.chapter-manager', [
            'chapters' => $this->course->chapters
        ]);
    }
}
