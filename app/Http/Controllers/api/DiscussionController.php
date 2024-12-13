<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Discussion;
use App\MyClass\Response;
use App\MyClass\Validations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiscussionController extends Controller
{
    public function create(Request $request, Course $course)
    {
        Validations::createDiscusion($request);
        DB::beginTransaction();

        try {
            $data = [
                'course_id' => $course->id,
                'discussion' => $request->discussion
            ];

            Discussion::createDiscussion($data);

            DB::commit();
            return Response::success([
                'message' => 'Create Berhasil! Tunggu Jawaban'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return Response::success();
        }
    }
}
