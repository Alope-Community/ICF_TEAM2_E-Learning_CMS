<?php

namespace App\Http\Controllers;

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
        if($request->ajax()) {
			return Task::dataTable($request);
		}
        return view('teacher.task',[
                'courses' => Course::select(['id', 'name'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validations::task($request);

        try {
            Task::create($request->all());

            DB::commit();

            return Response::success([
                'message' => 'created data successfully',
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Task::find($id);

        if ($task) {
            return response()->json([
                'status' => 'success',
                'data' => $task
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Task tidak ditemukan.'
        ], 404);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
