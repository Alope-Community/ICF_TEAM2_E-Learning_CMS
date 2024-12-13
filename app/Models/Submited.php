<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submited extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return Relasi
     */

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function grade()
    {
        return $this->hasOne(Grade::class, 'submited_id');
    }

    /**
     * Create Update delete
     */
    public static function createSubmited($request)
    {
        $data = self::create($request);
        return $data;
    }
}
