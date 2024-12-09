<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CategoryCourse;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User Seed
        User::create([
            'name' => 'Fikry Ramadhan',
            'email' => 'fikry@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Admin'
        ]);
        User::create([
            'name' => 'Rizky',
            'email' => 'rizky@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Teacher'
        ]);
        User::create([
            'name' => 'Billy Jonathan',
            'email' => 'billy@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'User'
        ]);
        
        // Category Course Seed
        CategoryCourse::create([
            'name' => 'HTML Dasar',
            'description' => 'HTML (HyperText Markup Language) merupakan sebuah bahasa markup, bukan bahasa pemrograman',
            'image' => 'https://github.com/BillyJonathan29/assets-icf/html.png',
            'user_id' => 1
        ]);
        CategoryCourse::create([
            'name' => 'HTML Lanjutan',
            'description' => ' HTML tingkat lanjut merujuk pada fitur dan teknik dalam HTML yang lebih kompleks dan ....',
            'image' => 'https://github.com/BillyJonathan29/assets-icf/html.png',
            'user_id' => 1
        ]);
        CategoryCourse::create([
            'name' => 'CSS Dasar',
            'description' => 'Apa itu CSS? CSS adalah singkatan dari Cascading Style Sheets . CSS menjelaskan tentang ....',
            'image' => 'https://github.com/BillyJonathan29/assets-icf/py.png',
            'user_id' => 2
        ]);
        CategoryCourse::create([
            'name' => 'CSS Layouting',
            'description' => 'Tata letak grid CSS adalah sistem tata letak dua dimensi untuk web . Sistem ini memungkinkan Anda.....',
            'image' => 'https://github.com/BillyJonathan29/assets-icf/py.png',
            'user_id' => 2
        ]);
        CategoryCourse::create([
            'name' => 'CSS Zero To Hero',
            'description' => ' CSS Zero to Hero" mengajarkan dasar hingga mahir CSS, mulai dari selektor, tata letak, hingga animasi, untuk membuat ...',
            'image' => 'https://github.com/BillyJonathan29/assets-icf/js.png',
            'user_id' => 2
        ]);
        CategoryCourse::create([
            'name' => 'Web Responsive',
            'description' => ' Responsive Web adalah teknik desain web yang membuat tampilan situs menyesuaikan berbagai ukuran layar, dari desktop hingga ....',
            'image' => 'https://github.com/BillyJonathan29/assets-icf/css.png',
            'user_id' => 2
        ]);

        // Couse Seed
        Course::create([
            'name' => 'Perkenalan HTML',
            'description' => 'HTML (HyperText Markup Language) adalah bahasa markup standar yang digunakan untuk membuat dan menyusun halaman web. HTML berfungsi sebagai kerangka utama dari sebuah halaman web, memungkinkan pengembang untuk menyusun teks, gambar, tautan, tabel, formulir, dan elemen lainnya ke dalam sebuah tampilan yang dapat diakses melalui peramban (browser).',
            'course' => 'https://www.youtube.com/embed/1WF50180LOU?si=jwX6kZCmAssvpUyc',
            'category_course_id' => 1
        ]);
        // Couse Seed
        Course::create([
            'name' => 'Perkenalan CSS',
            'description' => 'CSS (Cascading Style Sheets) adalah bahasa desain yang digunakan untuk mengatur tampilan dan tata letak halaman web. Dengan CSS, pengembang dapat mengontrol bagaimana elemen HTML ditampilkan di layar, kertas cetak, atau perangkat lain.',
            'course' => 'https://www.youtube.com/embed/Qc0NjOvYZCE?si=g3773zTyCNFE-68-',
            'category_course_id' => 2
        ]);
        Course::create([
            'name' => 'Intro',
            'description' => ' Pada materi kali ini kita cuman akan mulai berkenalan dengan Web Responsive"..',
            'course' => 'https://www.youtube.com/embed/sAHcNLKWaa4',
            'category_course_id' => 6
        ]);
    }
}
