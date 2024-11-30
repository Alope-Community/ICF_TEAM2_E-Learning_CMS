<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * @return relationship
     */
    public function categoryCourse(){
        return $this->belongsTo(CategoryCourse::class, 'category_course_id');
    }

    
}
