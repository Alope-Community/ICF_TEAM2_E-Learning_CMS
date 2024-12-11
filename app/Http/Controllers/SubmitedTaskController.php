<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Submited;
use App\Models\Task;
use Illuminate\Http\Request;

class SubmitedTaskController extends Controller
{
    public function index(Course $course){
        $task = Task::where('course_id', $course->id)->first();
        $submited = Submited::where('task_id', $task->id)->get();
        $data = [
            'totalPengumpulan' => $submited->count(),
            'namaTugas' => $course->name,
            'soalTugas' => $task->task
        ];

        return view('submited.index', [
            'data' => $data,
            'submited' => $submited
        ]);
    }
}
