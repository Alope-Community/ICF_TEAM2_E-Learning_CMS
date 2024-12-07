<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [''];

    /**
     * @return relationship
     *
     */
    public function categoryCourse(){
        return $this->belongsTo(CategoryCourse::class, 'category_course_id');
    }

    public static function dataTable($request)
    {
        $data = self::select(['courses.*']);

        return DataTables::eloquent($data)
            ->addColumn('action', function ($data) {
                $action = '
                	<div class="dropdown">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            pilih Aksi
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><button class="dropdown-item btn-edit" data-edit-href="' . route('course.update', $data->id) . '" data-get-href="' . route('course.edit', $data->id) . '">Edit</button></li>
                            <li><button class="dropdown-item btn-delete"" data-delete-href="'. route('course.destroy', $data->id) . '">Hapus</button></li>
                        </ul>
                    </div>
                ';
                return $action;
            })
            ->editColumn('image', function($data){
                return $data->image ? '<a href="'.$data->image.'" class="text-success">Lihat Gambar</a>' : "-";
            })
            ->rawColumns(['action', 'image'])
            ->make(true);
    }

    public static function createCourse($request)
    {
        $data = self::create($request);
        return $data;
    }

    public function editCourse(array $request)
    {
        $this->update($request);
        return $this;
    }

    public function deleteCourse()
    {
        return $this->delete();
    }


}
