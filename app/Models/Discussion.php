<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discussion extends Model
{
    use HasFactory;

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public static function dataTable($request)
    {
        $data = self::select(['discussions.*']);

        return DataTables::eloquent($data)
            ->editColumn('course_id', function($data){
                return $data->course ? $data->course->name : 'Tidak Diketahui';
            })
            ->editColumn('user_id', function($data){
                return $data->user ? $data->user->name : 'Tidak Diketahui';
            })
            ->make(true);
    }
}
