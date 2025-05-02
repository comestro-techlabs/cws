<?php

namespace App\Livewire\Admin\Blog;

use App\Models\PostTopicPost;
use App\Models\PostChapter;
use App\Models\PostCourse;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Illuminate\Support\Str;

#[Layout('components.layouts.admin')]
#[Title('Post Chapter')]
class ManageChapter extends Component
{
    use WithPagination;

    public $course;
    public $isModalOpen = false;
    public $chapterId = null;
    public $chapter_name = '';
    public $chapter_description = '';
    public $order = '';
    public $course_title = '';
    public $topics = [['topic_name' => '', 'topic_description' => '', 'id' => null]];
    public $currentStep = 1;
    public $isopenTopic = false;
    protected $rules = [
        'chapter_name' => 'required|string|max:255',
        'chapter_description' => 'nullable|string',
        'order' => 'required|integer|min:1',
        'topics.*.topic_name' => 'nullable|string|max:255',
        'topics.*.topic_description' => 'nullable|string',
    ];

    public function mount(PostCourse $course)
    {
        $this->course = $course;
        $this->course_title = $course->title;
        $this->ensureTopicsInitialized();
    }

    public function openModal()
    {
        $this->resetForm();
        $this->currentStep = 1;
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    public function openTopic(){
        
        $this->isopenTopic = true;
    }
    public function closeTopic(){
        $this->isopenTopic = false;
    }
    public function nextStep()
    {
        // Validate chapter details before moving to topics
        $this->validate([
            'chapter_name' => 'required|string|max:255',
            'chapter_description' => 'nullable|string',
            'order' => 'required|integer|min:1',
        ]);
        $this->currentStep = 2;
    }

    public function previousStep()
    {
        $this->currentStep = 1;
    }

    public function addTopic()
    {
        $this->topics[] = ['topic_name' => '', 'topic_description' => '', 'id' => null];
        $this->ensureTopicsInitialized();
        $this->dispatch('topicsUpdated'); // Emit event to reinitialize TinyMCE
    }
    
    public function removeTopic($index)
    {
        unset($this->topics[$index]);
        $this->topics = array_values($this->topics);
        if (empty($this->topics)) {
            $this->topics = [['topic_name' => '', 'topic_description' => '', 'id' => null]];
        }
        $this->ensureTopicsInitialized();
        $this->dispatch('topicsUpdated'); // Emit event to reinitialize TinyMCE
    }

    public function store()
    {
        $validated = $this->validate();

        // Create chapter
        $chapter = PostChapter::create([
            'post_course_id' => $this->course->id,
            'chapter_name' => $this->chapter_name,
            'chapter_description' => $this->chapter_description,
            'chapter_slug' => $this->generateUniqueSlug($this->chapter_name, PostChapter::class, 'chapter_slug'),
            'order' => $this->order,
        ]);

        // Create topics
        foreach ($this->topics as $index => $topic) {
            if (trim($topic['topic_name']) !== '') {
                PostTopicPost::create([
                    'post_chapter_id' => $chapter->id,
                    'topic_name' => $topic['topic_name'],
                    'topic_description' => $topic['topic_description'],
                    'order' => $index + 1,
                    'topic_slug' => $this->generateUniqueSlug($topic['topic_name'], PostTopicPost::class, 'topic_slug'),
                ]);
            }
        }

        session()->flash('message', 'Chapter created successfully.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $chapter = PostChapter::findOrFail($id);
        $this->chapterId = $id;
        $this->chapter_name = $chapter->chapter_name;
        $this->chapter_description = $chapter->chapter_description;
        $this->order = $chapter->order;
        $this->topics = $chapter->topics->map(function ($topic) {
            return [
                'topic_name' => $topic->topic_name,
                'topic_description' => $topic->topic_description,
                'id' => $topic->id,
            ];
        })->toArray();

        if (empty($this->topics)) {
            $this->topics = [['topic_name' => '', 'topic_description' => '', 'id' => null]];
        }

        $this->currentStep = 1;
        $this->isModalOpen = true;
        $this->ensureTopicsInitialized();
    }

    public function update()
    {
        $validated = $this->validate();

        // Update chapter
        $chapter = PostChapter::findOrFail($this->chapterId);
        $chapter->update([
            'chapter_name' => $this->chapter_name,
            'chapter_description' => $this->chapter_description,
            'chapter_slug' => $this->generateUniqueSlug($this->chapter_name, PostChapter::class, 'chapter_slug'),
            'order' => $this->order,
        ]);

        // Update or create topics
        $existingTopicIds = $chapter->topics->pluck('id')->toArray();
        $updatedTopicIds = array_filter(array_column($this->topics, 'id'), fn($id) => !is_null($id));

        // Delete removed topics
        PostTopicPost::where('post_chapter_id', $chapter->id)
            ->whereNotIn('id', $updatedTopicIds)
            ->delete();

        // Create or update topics
        foreach ($this->topics as $index => $topic) {
            if (trim($topic['topic_name']) !== '') {
                if (isset($topic['id']) && in_array($topic['id'], $existingTopicIds)) {
                    PostTopicPost::find($topic['id'])->update([
                        'topic_name' => $topic['topic_name'],
                        'topic_description' => $topic['topic_description'],
                        'order' => $index + 1,
                        'topic_slug' => $this->generateUniqueSlug($topic['topic_name'], PostTopicPost::class, 'topic_slug'),
                    ]);
                } else {
                    PostTopicPost::create([
                        'post_chapter_id' => $chapter->id,
                        'topic_name' => $topic['topic_name'],
                        'topic_description' => $topic['topic_description'],
                        'order' => $index + 1,
                        'topic_slug' => $this->generateUniqueSlug($topic['topic_name'], PostTopicPost::class, 'topic_slug'),
                    ]);
                }
            }
        }

        session()->flash('message', 'Chapter updated successfully.');
        $this->closeModal();
    }

    public function delete($id)
    {
        PostChapter::findOrFail($id)->delete();
        session()->flash('message', 'Chapter deleted successfully.');
    }

    private function resetForm()
    {
        $this->chapterId = null;
        $this->chapter_name = '';
        $this->chapter_description = '';
        $this->order = '';
        $this->topics = [['topic_name' => '', 'topic_description' => '', 'id' => null]];
        $this->currentStep = 1;
        $this->resetErrorBag();
    }

    private function ensureTopicsInitialized()
    {
        if (!is_array($this->topics) || $this->topics === null) {
            $this->topics = [['topic_name' => '', 'topic_description' => '', 'id' => null]];
        }
    }

    private function generateUniqueSlug($name, $model, $column)
    {
        $slug = Str::slug($name);
        $uniqueSlug = $slug;
        $counter = 1;
        while ($model::where($column, $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $counter++;
        }
        return $uniqueSlug;
    }

    public function render()
    {
        $chapters = PostChapter::where('post_course_id', $this->course->id)
            ->orderBy('order')
            ->paginate(10);
        return view('livewire.admin.blog.manage-chapter', compact('chapters'));
    }
}