<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submited extends Model
{
    use HasFactory;

    /**
     * @return Relasi
     */
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function task(){
        return $this->belongsTo(Task::class. 'task_id');
    }

    /**
     * Create Update delete
     */
    public static function createSubmited($request){
        $data = self::create($request->all());
        $data->saveFile($request->file);

        return $data;
    }

    // public function FilePath()
	// {
	// 	return storage_path('app/public/storage/submited/' . $this->file);
	// }

    public function saveFile($request){
        if ($request->hasFile('file')) {
			$file = $request->file('file');
			$filename = date('YmdHis_') . $file->getClientOriginalName();
			$file->move(storage_path('app/public/storage/submited'), $filename);
			$this->update([
				'file' => $filename,
			]);
		}

		return $this;
    }
}
