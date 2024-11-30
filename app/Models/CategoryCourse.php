<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryCourse extends Model
{
    use HasFactory;

    /**
     *  @return Relationship
     */
    public function course(){
        return $this->hasMany(Course::class, 'category_course_id');
    }
}
