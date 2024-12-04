<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    public static function dataTable($request)
    {
        $data = self::select([ 'course_id', 'task', 'created_at' ]);

        return DataTables::eloquent($data)
            ->addColumn('action', function ($data) {
                $action = '
                	 <button type="button"
                data-delete-message="Yakin ingin menghapus <strong>' . $data->name . '</strong>?"
                data-delete-href="' . route('user.destroy', $data->id) . '"
                class="btn mb-2 icon-left btn-outline-danger btn-delete">
                <i class="ti-trash"></i> Hapus
            </button>
                ';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
