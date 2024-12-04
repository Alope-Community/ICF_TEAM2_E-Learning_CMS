<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CategoryCourse;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // CategoryCourse::create([
        //     'name' => 'React Series',
        //     'description' => 'Series ini kita akan membahas mengenai react.'
        // ]);
        // CategoryCourse::create([
        //     'name' => 'Laravel Series',
        //     'description' => 'Series ini kita akan membahas mengenai laravel.'
        // ]);
        // CategoryCourse::create([
        //     'name' => 'c++ Series',
        //     'description' => 'Series ini kita akan membahas mengenai react.'
        // ]);
        CategoryCourse::create([
            'name' => 'java Series',
            'description' => 'Series ini kita akan membahas mengenai react.',
            'image' => 'link'
        ]);
    }
}
