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
    public function index(Course $course)
    {
        $discussions = Discussion::where('course_id', $course->id)->get();

        $data = [
            'totalSiswa' => $discussions->count(),
            'namaKelas' => $course->name
        ];
        return view('discussion.index', [
            'data' => $data,
            'discussion' => $discussions
        ]);
    }

    public function replyDiscussion(Request $request, Discussion $discussion)
    {
        Validations::createReplyDiscussion($request);
        DB::beginTransaction();

        try {
            $reply = DB::table('reply_discussions')
                ->where('discussion_id', $discussion->id)->exists();;
            $data = [
                'discussion_id' => $discussion->id,
                'user_id' => auth()->user()->id,
                'message' => $request->message
            ];
            if ($reply) {
                return Response::invalid([
                    'message' => 'Anda Sudah Membalas'
                ]);
            } else {
                ReplyDiscussion::createReplyDiscussion($data);
                DB::commit();

                return Response::success();
            }
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }
    public function create(Request $request, Course $course)
    {
        Validations::createDiscusion($request);
        DB::beginTransaction();

        try {
            $data = [
                'course_id' => $course->id,
                'users_id' => $request->user()->id,
                'discussion' => $request->discussion
            ];

            Discussion::createDiscussion($data);
            DB::commit();
            return Response::success([
                'message' => 'Diskusi Berhasil Dikirim! Tunggu Jawaban'
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }
}
