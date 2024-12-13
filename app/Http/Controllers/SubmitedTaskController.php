<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Submited;
use App\Models\Task;
use App\MyClass\Response;
use App\MyClass\Validations;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubmitedTaskController extends Controller
{
    public function index(Task $task)
    {
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

    public function create(Request $request, Task $task)
    {
        Validations::createSubmited($request);
        DB::beginTransaction();
        try {
            $isSubmited = DB::table('submiteds')
                ->where('user_id', $request->user()->id)
                ->where('task_id', $task->id)
                ->exists();

            if ($isSubmited) {
                return Response::success([
                    'message' => 'Anda Sudah Mengumpulkan Tugas',
                ]);
            } else {
                // Ambil file PDF dari request
                $pdfFile = $request->file('file');

                // Membuat nama file berdasarkan tanggal upload
                $timestamp = Carbon::now()->format('Y-m-d');
                $fileName = $task->task . "_" .  $timestamp . '.' . $pdfFile->getClientOriginalExtension();

                $path = $pdfFile->storeAs('public/task_submited', $fileName);

                $data = [
                    'user_id' => $request->user()->id,
                    'task_id' => $task->id,
                    'file' => $fileName,
                ];
                $submited = Submited::createSubmited($data);

                DB::commit();
                return Response::success([
                    'message' => 'Tugas Berhasil Di Upload',
                    'path' => $path
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }
}
