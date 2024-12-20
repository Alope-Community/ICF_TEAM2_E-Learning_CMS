<?php

namespace App\Http\Controllers;

use App\Models\CategoryCourse;
use Exception;
use App\Models\Task;
use App\Models\Course;
use App\MyClass\Response;
use App\MyClass\Validations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Task::dataTable($request);
        }

        $coursesQuery = Course::select(['id', 'name']);

        if (auth()->user()->role !== 'Admin') {
            $coursesQuery->whereHas('categoryCourse', function ($query) {
                $query->where('user_id', auth()->user()->id);
            });
        }

        return view('task.index', [
            'courses' => $coursesQuery->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validations::task($request);

        try {
            $task = DB::table('tasks')
                ->where('course_id', $request->course_id)->exists();;
            if ($task) {
                return Response::invalid([
                    'message' => 'Tugas Course Tersebut Telah Ada'
                ]);
            } else {
                Task::create($request->all());

                DB::commit();

                return Response::success([
                    'message' => 'created data successfully',
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        DB::beginTransaction();

        try {
            return Response::success([
                'status' => 'success',
                'task' => $task,
                'code' => 200
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        DB::beginTransaction();

        try {
            $task->updateTask($request->all());

            DB::commit();
            return Response::success();
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        DB::beginTransaction();

        try {
            $task->deleteTask();

            DB::commit();
            return Response::success();
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }
}
