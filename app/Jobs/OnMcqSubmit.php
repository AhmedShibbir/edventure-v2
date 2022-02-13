<?php

namespace App\Jobs;

use App\Models\McqMarkingDetail;
use App\Models\McqQuestion;
use App\Models\McqTotalResult;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OnMcqSubmit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $mcq;
    public $exam;
    public $exam_end_time;
    public $student_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mcq, $exam, $exam_end_time, $student_id)
    {
        $this->mcq = $mcq;
        $this->exam = $exam;
        $this->exam_end_time = $exam_end_time;
        $this->student_id = $student_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $detail_result = [];
        $total_marks = 0;
        foreach ($this->mcq as $key => $value) {
            array_push($detail_result,[
                'model_exam_id' => (int) $this->exam->id,
                'mcq_question_id' => $key,
                'student_id' => $this->student_id,
                'mcq_ans' => (int) $value,
                'gain_marks' =>  McqQuestion::query()->find($key)->answer == $value ? 1 : 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        foreach ($detail_result as $key => $value) {
            $total_marks +=  $value['gain_marks'];
        }

        $total_result = [
            'model_exam_id' => (int) $this->exam->id,
            'student_id' => $this->student_id,
            'exam_end_time' => $this->exam_end_time,
            'total_marks' => $total_marks,
            'duration' => $this->exam->duration * 60
        ];

        McqMarkingDetail::query()->insert($detail_result);
        McqTotalResult::query()->create($total_result);
    }
}