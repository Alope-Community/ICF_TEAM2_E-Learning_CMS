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
    public function index(CategoryCourse $categoryCourse)
    {
        
        $enrolemts = Enrolment::where('category_id', $categoryCourse->id)->get();
        $data = [
            'totalSiswa' => $enrolemts->count(),
            'namaKelas' => $categoryCourse->name
        ];
        return view('enrolement.index', [
            'data' => $data,
            'enrolment' => $enrolemts
        ]);
    }

    public function create(Request $request, CategoryCourse $categoryCourse)
    {
        DB::beginTransaction();
        try {
            $isEnrolment = DB::table('enrolments')
                ->where('user_id', $request->user()->id)
                ->where('category_id', $categoryCourse->id)
                ->exists();

            if ($isEnrolment) {
                return Response::success([
                    'message' => 'Anda Sudah Terdaftar'
                ]);
            } else {
                $data = [
                    'category_id' => $categoryCourse->id,
                    'user_id' => $request->user()->id
                ];
                Enrolment::createEnrolment($data);
                DB::commit();
                return Response::success([
                    'message' => 'Daftar Course Berhasil',
                    'code' => 200
                ]);
            }
        } catch (\Exception $e) {
            DB::rollback();

            return Response::error($e);
        }
    }

    public function boleh()
    {
        
    }
}
