<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Course;
use App\Models\Enrolment;
use App\MyClass\Response;
use App\Models\Discussion;
use App\MyClass\Validations;
use Illuminate\Http\Request;
use App\Models\ReplyDiscussion;
use Illuminate\Support\Facades\DB;

class DiscussionController extends Controller
{
    public function index (Course $course)
    {
        $discussions = Discussion::where('course_id', $course->id)->get();
        // dd($discussions);
        $data = [
            'totalSiswa' => $discussions->count(),
            'namaKelas' => $discussions->first()->course->name
        ];
        return view('discussion.index', [
            'data' => $data,
            'discussion' => $discussions
        ]);
    }

    public function replyDiscussion (Request $request) {
        Validations::createReplyDiscussion($request);
        DB::beginTransaction();

        try {
            $user = ReplyDiscussion::createReplyDiscussion($request->all());
            DB::commit();

            return Response::success();
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }
}
