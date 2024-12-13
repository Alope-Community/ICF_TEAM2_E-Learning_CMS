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
        return $this->belongsTo(Task::class . 'task_id');
    }

    /**
     * Create Update delete
     */
    public static function createSubmited($request)
    {
        $data = self::create($request);
        return $data;
    }

    // public function FilePath()
    // {
    // 	return storage_path('app/public/storage/submited/' . $this->file);
    // }

    // public function saveFile($request)
    // {
    //     if ($request->file('file')) {
    //         $file = $request->file('file');
    //         $filename = date('YmdHis_') . $file->getClientOriginalName();
    //         $file->move(storage_path('app/public/storage/submited'), $filename);
    //         $this->update([
    //             'file' => $filename,
    //         ]);
    //     }

    //     return $this;
    // }
}
