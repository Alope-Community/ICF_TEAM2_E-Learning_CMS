<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class CategoryCourse extends Model
{
    use HasFactory;

    /**
     *  @return Relationship
     */
    public function course(){
        return $this->hasMany(Course::class, 'category_course_id');
    }

    /**
     * @return DataTable
     */
    public static function dataTable($request)
    {
        $data = self::select([ 'category_courses.*' ]);
        
        return \DataTables::eloquent($data)
            ->addColumn('action', function ($data) {
                $action = '
                	<div class="dropdown">
						<button class="btn btn-primary px-2 py-1 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Pilih Aksi
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item edit" href="javascript:void(0);" data-edit-href="" data-get-href="">
								<i class="fas fa-pencil-alt mr-1"></i> Edit
							</a>
							<a class="dropdown-item delete" href="javascript:void(0)" data-delete-message="Yakin ingin menghapus <strong>ini</strong>?" data-delete-href="">
								<i class="fas fa-trash mr-1"></i> Hapus
							</a>
						</div>
					</div>
                ';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
