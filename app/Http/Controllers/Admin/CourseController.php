<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Course;
use App\Models\Admin\CourseLecture;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\IntermediaryLevel;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::join('intermediary_levels', 'courses.intermediary_level_id', '=', 'intermediary_levels.id')
        ->select('courses.*', 'intermediary_levels.title as name')
        ->orderByRaw('courses.created_at DESC')
        ->get();

        return view('admin.pages.course.index', compact('courses'));
    }

    public function create()
    {
        $intermediary_levels = IntermediaryLevel::where('status', 1)->get();
        return view('admin.pages.course.create', compact('intermediary_levels'));
    }

    public function show(Course $course)
    {
        $lectures = [];
        $course_topics = CourseTopic::where('course_id', $course->id)->get();
        foreach ($course_topics as $course_topic) {
            $lectures = CourseLecture::join('course_topics', 'course_lectures.topic_id', 'course_topics.id')
                ->where('course_lectures.course_id', $course->id)
                ->select('course_topics.*', 'course_lectures.title as lectureTitle', 'course_lectures.url as url')
                ->get();
            break;
        }
        return view('admin.pages.course.details', compact('course', 'course_topics', 'lectures'));
    }

    public function edit(Course $course)
    {
        return view('admin.pages.course.edit', compact('course'));
    }

    public function destroy(Course $course)
    {
        $delete = $course->delete();
        if ($delete) {
            return redirect()->route('course.index')->with('status', 'Course successfully deleted!');
        } else {
            return redirect()->route('course.index')->with('failed', 'Course deletion failed!');
        }
    }

    public function changeCourseStatus(Request $request)
    {
        $obj = Course::find($request->id);
        $obj->status = $request->status;
        $obj->save();

        return response()->json(['success' => 'Status change successfully.']);
    }

    public function addCourseLecture(Course $course)
    {
        return view('admin.pages.course.add_course_lecture_from_course_details', compact('course'));
    }
}
