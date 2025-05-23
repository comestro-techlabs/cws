<?php

namespace App\Livewire\Admin\PlacedStudent;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\PlacedStudent;
use Illuminate\Support\Facades\Storage;
use ImageKit\ImageKit;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Placed Student')]
class CallingPlacedStudent extends Component
{
    use WithFileUploads;

    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $isModalOpen = false;
    public $editMode = false;
    public $student;

    public $content;
    public $position;
    public $image;
    public $name;

    // Toggle status

    protected $rules = [
        'name' => 'required|min:2|max:100',
        'content' => 'required|max:500',
        'position' => 'required|max:100',
        'image' => 'image|max:2048',
    ];

    public function toggleStatus($id)
    {
        try {
            $student = PlacedStudent::findOrFail($id);
            $student->status = !$student->status;
            $student->save();

            session()->flash('success', 'Status updated successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Student not found.');
        }
    }
    public function addNewStudent()
    {
        $this->resetInputFields();
        $this->isModalOpen = true;
    }
    public function editStudent($studentId)
    {

        $this->resetInputFields();
        $this->editMode = true;

        $this->isModalOpen = true;
        $this->editMode = true;
        $this->student = PlacedStudent::findOrFail($studentId);
        $this->name = $this->student->name;
        $this->position = $this->student->position;
        $this->content = $this->student->content;
        $this->image = $this->student->image;

        $this->isModalOpen = true;
    }
    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->editMode = false;
    }
    private function resetInputFields()
    {
        $this->name = '';
        $this->name = '';
        $this->content = '';
        $this->position = '';
        $this->image = '';
    }
    public function save()
    {
        $this->validate();

        $studentData = [
            'name' => $this->name,
            'content' => $this->content,
            'position' => $this->position,
        ];

        $imageKit = new ImageKit(
            publicKey: env('IMAGEKIT_PUBLIC_KEY'),
            privateKey: env('IMAGEKIT_PRIVATE_KEY'),
            urlEndpoint: env('IMAGEKIT_URL_ENDPOINT')
        );

        if ($this->image) {

            if ($this->editMode && $this->student->image_file_id) {
                $imageKit->deleteFile($this->student->image_file_id);
            }

            $fileContent = file_get_contents($this->image->getRealPath());
            $fileName = uniqid() . '.' . $this->image->getClientOriginalExtension();

            $uploadFile = $imageKit->upload([
                "file" => base64_encode($fileContent),
                "fileName" => $fileName,
                "folder" => "/cws/placedstudent/"
            ]);

            if ($uploadFile->result && isset($uploadFile->result->url)) {
                $studentData['image'] = $uploadFile->result->url;
                $studentData['image_file_id'] = $uploadFile->result->fileId;

            }
        }

        if ($this->editMode) {
            // Optionally delete the old image from ImageKit here

            $this->student->update($studentData);
            session()->flash('success', 'Student updated successfully.');
        } else {
            PlacedStudent::create($studentData);
            session()->flash('success', 'Student created successfully.');
        }

        $this->closeModal();
        $this->resetInputFields();
    }


    // Delete student
    public function deleteStudent($id)
    {
        try {
            $student = PlacedStudent::findOrFail($id);
            $student->delete();

            session()->flash('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Student not found.');
        }
    }

    public function render()
    {
        $placedStudents = PlacedStudent::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('position', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        return view('livewire.admin.placed-student.calling-placed-student', [
            'placedStudents' => $placedStudents,
        ]);
    }
}
