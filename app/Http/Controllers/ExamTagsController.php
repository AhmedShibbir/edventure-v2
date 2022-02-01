<?php

namespace App\Http\Controllers;

use App\Models\ExamTag;
use App\Models\ExamTopic;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ExamTagsController extends Controller
{
    /**
     * Load exam tag index to create new tags
     * @return Application|Factory|View
     */
    public function index()
    {
        $exam_topics = ExamTopic::query()->get();
        $exam_tags = ExamTag::query()->with('examTopic')->paginate(5);
        return view('admin.pages.model_exam.exam_tag.index', compact('exam_topics','exam_tags'));
    }

    /**
     * Store new tags data
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $inputs =  $request->validate([
            'name' => 'required',
            'exam_topic_id' => 'required'
        ]);

        if($this->checkDuplicateTagName($inputs['exam_topic_id'],$inputs['name'])) {

            return redirect()->back()->with(['failed' => 'This tags is already added to this topic']);
        }

        ExamTag::create($inputs);
        return redirect()->back()->with(['status' => 'Tags Created Successfully']);
    }

    /**
     * Update specific tag data
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $inputs =  $request->validate([
            'name' => 'required',
            'exam_topic_id' => 'required'
        ]);

        if($this->checkDuplicateTagName($inputs['exam_topic_id'],$inputs['name'])) {

            return redirect()->back()->with(['failed' => 'This tags is already added to a topic']);
        }

        ExamTag::query()->where('id', $id)->update($inputs);

        return redirect()->back()->with(['status' => 'Tags Updated Successfully']);
    }

    /**
     * Delete specific tag
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        ExamTag::query()->find($id)->delete();
        return redirect()->back()->with(['status' => 'Tags Deleted Successfully']);
    }

    /**
     * Get specific tag data
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $tag = ExamTag::query()->where('id', $id)->with('examTopic')->first();
        return response()->json($tag);
    }

    /**
     * Check if the tag name is already assigned within a selected topic
     * Tag name should not duplicate for same topic
     * @param $topicId
     * @param $topicName
     * @return bool
     */
    private function checkDuplicateTagName($topicId,$topicName)
    {
        return ExamTag::query()
            ->where('exam_topic_id',$topicId)
            ->where('name',$topicName)
            ->exists();
    }
}
