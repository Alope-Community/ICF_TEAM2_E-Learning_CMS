<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class Enrolment extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return Relathionship
     */
    public function category()
    {
        return $this->belongsTo(CategoryCourse::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Create
     */
    public static function createEnrolment($request)
    {
        $data = self::create($request);
        return $data;
    }

    /**
     * Data Tables
     */
    public static function dataTables($course)
    {
        $data = self::select(['enrolments.*', 'courses.*', 'users.*']);

        return DataTables::eloquent($data)
            ->make(true);
    }
}
