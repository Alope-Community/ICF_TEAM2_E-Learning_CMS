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
    public function categoryCourse()
    {
        return $this->belongsTo(CategoryCourse::class, 'category_course_id');
    }

    public static function dataTable($request)
    {
        if (auth()->user()->role == 'Admin') {
            $data = self::select(['courses.*', 'category_courses.user_id'])
                ->leftJoin('category_courses', 'courses.category_course_id', '=', 'category_courses.id');
        } elseif (auth()->user()->role == 'Teacher') {
            $data = self::select([
                'courses.*',
                'category_courses.user_id',
                'category_courses.name as categoryCourseName',
            ])
                ->leftJoin('category_courses', 'courses.category_course_id', '=', 'category_courses.id')
                ->where('category_courses.user_id', auth()->user()->id);;
        }

        return DataTables::eloquent($data)
            ->addColumn('action', function ($data) {
                $action = '
                    <div class="dropdown">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            pilih Aksi
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="' . route('discussion', $data->id) . '">Lihat Diskusi</a></li>
                            <li><button class="dropdown-item btn-edit" data-edit-href="' . route('course.update', $data->id) . '" data-get-href="' . route('course.edit', $data->id) . '">Edit</button></li>
                            <li><button class="dropdown-item btn-delete"" data-delete-href="' . route('course.destroy', $data->id) . '">Hapus</button></li>
                        </ul>
                    </div>
                ';
                return $action;
            })
            ->editColumn('image', function ($data) {
                return $data->image ? '<a href="' . $data->image . '" class="text-success">Lihat Gambar</a>' : "-";
            })
            ->editColumn('category_course_id', function ($data) {
                return $data->categoryCourse ? $data->categoryCourse->name : 'Tidak Diketahui';
            })
            ->editColumn('user_id', function ($data) {
                return $data->user_id ? $data->user_id : 'Tidak Ada User ID';
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
