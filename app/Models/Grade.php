<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function submited()
    {
        return $this->belongsTo(Submited::class, 'submited_id');
    }
}
