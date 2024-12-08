<?php

namespace App\Http\Controllers;

use App\Models\CategoryCourse;
use App\Models\Course;
use App\Models\Enrolment;
use App\MyClass\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrolmentController extends Controller
{
    public function index(Course $course, Request $request){
        if ($request->ajax()) {
            Enrolment::dataTables($course->id);
        }
        $data = [
            'totalSiswa' => '200',
            'namaKelas' => $course->name
        ];
        return view('inrolment.index', [
            'data' => $data
        ]);
    }

    public function create(Request $request, CategoryCourse $categoryCourse){
        DB::beginTransaction();
        try {
            $data = [
                'category_id' => $categoryCourse->id,
                'user_id' => $request->user()->id
            ];
            Enrolment::createEnrolment($data);
            DB::commit();
            return Response::success([
                'message' => 'Daftar Berhasil'
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return Response::error($e);
        }
    }
}
