<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discussion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function reply()
    {
        return $this->hasOne(ReplyDiscussion::class, 'discussion_id');
    }

    public static function createDiscussion($request)
    {
        $data = self::create($request);
        return $data;
    }
}
