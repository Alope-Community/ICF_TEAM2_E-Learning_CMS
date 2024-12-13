<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrolment;
use App\Models\Discussion;

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
}
