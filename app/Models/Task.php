<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Date;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id'); // Relasi belongsTo
    }

    public static function dataTable($request)
    {
        // Tambahkan 'with' untuk memuat relasi
        $data = self::with(['course'])->select(['id', 'course_id', 'task', 'created_at']);

        return DataTables::eloquent($data)
            ->editColumn('course_id', function ($data) {
                // Ganti ID dengan nama course dari relasi
                return $data->course ? $data->course->name : 'Tidak Diketahui';
            })
            ->addColumn('action', function ($data) {
                $action = '
                    <div class="dropdown">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            pilih Aksi
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="'. route('task.lihat-tugas', $data->id) . '">Lihat Data Pengumpulan</a></li>
                            <li><button class="dropdown-item btn-edit" data-edit-href="' . route('task.update', $data->id) . '" data-get-href="' . route('task.edit', $data->id) . '" class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal"data-bs-target="#updateModal">Edit</button></li>
                            <li><button class="dropdown-item btn-delete"" data-delete-href="'. route('task.destroy', $data->id) . '">Hapus</button></li>
                        </ul>
                    </div>
                ';
                return $action;
            })
            ->editColumn('created_at', function ($data) {
                $date = Carbon::parse($data->created_at)->locale('id');
                $date -> settings(['formatFunction' => 'translatedFormat']);
                return $date->format('j F Y,  h:i a');
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function updateTask(array $request)
    {
        $this->update($request);
        return $this;
    }

    public function deleteTask()
    {
        $this->delete();
    }

}
