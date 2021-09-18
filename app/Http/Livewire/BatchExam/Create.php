<?php

namespace App\Http\Livewire\BatchExam;

use Livewire\Component;
use App\Models\Admin\Exam;
use App\Models\Admin\Batch;
use App\Models\Admin\Course;
use App\Models\Admin\BatchExam;
use App\Models\Admin\CourseTopic;

class Create extends Component
{
    public $batchId = null;
    public $examId;

    public $batches;
    public $exams = [];

    public function updatedBatchId($value)
    {
        // $this->validate([
        //     'batchId' => 'required',
        // ]);

        // dd($this->batches->firstWhere('id', $value)->course_id);

        // $this->coursetopics = CourseTopic::whereCourseId($this->batches->firstWhere('id', $value)->course_id)->select('id', 'title')->orderBy('id')->get();
        // $this->coursetopicId = null;

        $courseId = Batch::find($value);
        $this->exams = Exam::where('course_id', $courseId->course_id)->get();
    }

    // public function updatedCoursetopicId($value)
    // {
    //     $this->exams = Exam::whereTopicId($value)->select('id', 'title', 'exam_type')->get();
    //     $this->examId = null;
    // }

    // public function updatedExamId()
    // {
    //     $this->validate([
    //         'examId' => 'required',
    //     ]);
    // }

    protected $rules = [
        'batchId' => 'required',
        'examId' => 'required',
    ];


    public function saveBatchExam()
    {
        $data = $this->validate();
        $batch_exam = new BatchExam();
        $batch_exam->batch_id = $data['batchId'];
        $batch_exam->exam_id = $data['examId'];
        $batch_exam->status = 1;

        $save = $batch_exam->save();

        if ($save) {
            session()->flash('status', 'Batch exam successfully added!');
            return redirect()->route('batch-exam.index');
        } else {
            session()->flash('failed', 'Batch exam added failed!');
            return redirect()->route('batch-exam.create');
        }
    }


    public function mount()
    {
        $this->batches = Batch::orderBy('title')->get();
    }

    public function render()
    {
        return view('livewire.batch-exam.create');
    }
}
