<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Course;
use App\MyClass\Response;
use App\MyClass\Validations;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryCourse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function get(CategoryCourse $categoryCourse)
    {
        try {
            $data = Course::where('category_course_id', $categoryCourse);
            if (!$data) {
                return Response::invalid([
                    'message' => 'Data Belum Ada',
                    'code' => 403
                ]);
            }
            return Response::success([
                'data' => $data,
                'title' => $categoryCourse->name
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

        return view('course.index', [
            'courseCategorys' => CategoryCourse::select(['id', 'name'])->get()
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
