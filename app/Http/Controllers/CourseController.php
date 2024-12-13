<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Course;
use App\MyClass\Response;
use App\MyClass\Validations;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryCourse;
use App\Models\Discussion;
use App\Models\Grade;
use App\Models\Submited;
use App\Models\Task;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function get(CategoryCourse $categoryCourse)
    {
        try {
            $data = Course::where('category_course_id', $categoryCourse->id)->get();
            if (!$data) {
                return Response::invalid([
                    'message' => 'Data Belum Ada',
                    'code' => 403
                ]);
            }
            return Response::success([
                'data' => $data,
                'title' => $categoryCourse->name,
                'description' => $categoryCourse->description
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }

    public function show(Course $course, Request $request)
    {
        DB::beginTransaction();
        $id = $request->user()->id;
        $task = Task::where('course_id', $course->id)->first();
        $submition = DB::table('submiteds')->where('task_id', $task->id)->where('user_id', $id)->first();
        $grade = Grade::where('submited_id', $submition->id)->first();
        $discussion = Discussion::where('course_id', $course->id)->limit(3)->get();
        try {
            return Response::success([
                'course' => $course,
                'task' => $task,
                'submited' => $submition,
                'grade' => $grade,
                'discussion' => $discussion
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Course::dataTable($request);
        }

        if (auth()->user()->role == 'Admin') {
            $data = CategoryCourse::select(['id', 'name'])->get();
        } else {
            $data = CategoryCourse::where('user_id', auth()->user()->id)->select(['id', 'name'])->get();
        }

        return view('course.index', [
            'courseCategorys' => $data
        ]);
    }

    public function create(Request $request)
    {
        Validations::createDataCourse($request);
        DB::beginTransaction();
        try {
            Course::createCourse($request->all());

            DB::commit();
            return Response::success([
                'message' => 'Data Berhasil Di buat'
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }

    public function edit(Course $course)
    {
        DB::beginTransaction();
        try {
            return Response::success([
                'course' => $course
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }

    public function update(Request $request, Course $course)
    {
        DB::beginTransaction();
        try {
            $course->editCourse($request->all());

            DB::commit();
            return Response::success();
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }

    public function destroy(Course $course)
    {
        DB::beginTransaction();
        try {
            $course->deleteCourse();

            DB::commit();
            return Response::success([
                'message' => 'Data telah di hapus'
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }
}
