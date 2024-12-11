<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class CategoryCourse extends Model
{
    use HasFactory;

    /**
     * @return protected
     */
    protected $guarded = [''];

    /**
     *  @return Relationship
     */
    public function course()
    {
        return $this->hasMany(Course::class, 'category_course_id');
    }

    /**
     * @return DataTable
     */
    public static function dataTable($request)
    {
        if (auth()->user()->role == 'Admin') {
            $data = self::select(['category_courses.*']);
        } else {
            $data = self::select(['category_courses.*'])
                        ->where('user_id', auth()->user()->id);
        }

        return DataTables::eloquent($data)
            ->addColumn('action', function ($data) {
                $action = '
                	<div class="dropdown">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            pilih Aksi
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="'. route('categoryCourse.lihat-siswa', $data->id) . '">Lihat Siswa</a></li>
                            <li><button class="dropdown-item btn-edit" data-edit-href="' . route('categoryCourse.update', $data->id) . '" data-get-href="' . route('categoryCourse.edit', $data->id) . '">Edit</button></li>
                            <li><button class="dropdown-item btn-delete"" data-delete-href="'. route('categoryCourse.destroy', $data->id) . '">Hapus</button></li>
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

    /**
     * @return CRUD
     */
    public static function createCategory($request)
    {
        $data = self::create($request);
        return $data;
    }

    public function editCategory(array $request)
    {
        $this->update($request);
        return $this;
    }

    public function deleteCategory()
    {
        return $this->delete();
    }
}
