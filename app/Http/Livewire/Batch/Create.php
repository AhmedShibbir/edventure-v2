<?php

namespace App\Http\Livewire\Batch;

use App\Models\User;
use Livewire\Component;
use App\Models\Admin\Batch;
use Illuminate\Support\Str;
use App\Models\Admin\Course;
use App\Models\Admin\CourseCategory;

class Create extends Component
{
    public $title;
    public $student_limit;
    public $batch_running_days = 0;
    public $teacher_id;
    public $courseId;

    public $teachers;
    public $courses;
    public $categories;
    public $categoryId;

    public function updatedTitle()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:50'],
        ]);
    }

    public function updatedStudent_limit()
    {
        $this->validate([
            'student_limit' => ['required', 'numeric'],
        ]);
    }

    public function updatedBatch_running_days()
    {
        $this->validate([
            'batch_running_days' => 'required|numeric|gt:-1',
        ]);
    }

    public function updatedTeacher_id()
    {
        $this->validate([
            'teacher_id' => ['required'],
        ]);
    }

    public function updatedCourseId()
    {
        $this->validate([
            'courseId' => ['required'],
        ]);
    }

    protected $rules = [
        'title' => ['required', 'string', 'max:50'],
        'student_limit' => ['required', 'numeric'],
        'batch_running_days' => ['required', 'numeric', 'gt:-1'],
        'teacher_id' => ['required'],
        'courseId' => ['required'],
    ];

    public function saveBatch()
    {
        $data  = $this->validate();
        $batch = new Batch();
        $batch->title = $data['title'];
        $batch->slug = Str::slug($data['title']);
        $batch->batch_running_days = $data['batch_running_days'];
        $batch->teacher_id = $data['teacher_id'];
        $batch->student_limit = $data['student_limit'];
        $batch->course_id = $data['courseId'];
        $batch->status = 1;
        $batch->order = 0;

        $save = $batch->save();

        if ($save) {
            session()->flash('status', 'Batch successfully added!');
            return redirect()->route('batch.index');
        } else {
            session()->flash('failed', 'Batch added failed!');
            return redirect()->route('batch.create');
        }
    }

    public function mount()
    {
        $this->teachers = User::where('is_Admin', '=', '0')
            ->where('user_type', '=', '2')
            ->get();

        $this->categories = CourseCategory::all();
    }

    public function render()
    {
        $this->courses = Course::where('course_category_id', $this->categoryId)->get();
        return view('livewire.batch.create');
    }
}
