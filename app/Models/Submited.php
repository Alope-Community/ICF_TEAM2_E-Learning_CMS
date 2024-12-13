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
<<<<<<< HEAD
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
=======
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
>>>>>>> 83733bde31b9889f741b6d0331dd7788586e0937
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
