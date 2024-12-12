<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Submited;
use App\Models\Task;
use Illuminate\Http\Request;

class SubmitedTaskController extends Controller
{
    public function index(Task $task){
            if ($task) {
                $submited = Submited::where('task_id', $task->id)->get();
            } else {
                $submited = [];
            }

            $data = [
                'totalPengumpulan' => $submited ? $submited->count() : 0,
                'soalTugas' => $task ? $task->task : '-'
            ];
            return view('submited.index', [
                'data' => $data,
                'submited' => $submited
            ]);
    }

    public function create(Request $request, Task $task){
        
    }
}
