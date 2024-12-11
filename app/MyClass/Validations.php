<?php

namespace App\MyClass;

use App\Rules\ValidateUserPassword;

class Validations
{
    public static function register($request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:7|max:20'
        ],[
            'name.required' => "Nama Wajib Diisi",
            'email.required' => "Email Wajib Diisi",
            'password.required' => "Password Wajib Diisi",
            'password.min' => "Password Minimal 7 Karakter",
        ]);
    }
    public static function updateProfil($request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users,email,'.auth()->user()->id,
        ],[
            'name.required' => "Nama Wajib Diisi",
            'email.required' => "Email Wajib Diisi",
        ]);
    }

    public static function login($request){
        $request->validate([
            'email' => "required|exists:users,email",
            'password' => "required",
        ],[
            'email.required' => "Email Wajib Diisi",
            'password.required' => "Password Wajib Diisi",
            'email.exists' => "Email Tidak Ditemukan",
            // 'password.min' => "Password Minimal 7 Karakter",
        ]);
    }

    public static function updatePassword($request){
        $request->validate([
            'old_password' => ['required', new ValidateUserPassword($request->user()->id)],
            'new_password' => 'required|min:7',
            'confirm_password' => 'required|same:new_password',
        ],[
            'old_password.required' => 'Password lama harus diisi',
            'new_password.required' => 'Password baru wajib di isi',
            'confirm_password.required' => 'Konfirmasi password baru wajib di isi',
            'confirm_password.same' => 'Konfirmasi password tisak sesuai dengan password baru amda',
        ]);
    }

    public static function createDataCategory($request){
        $request->validate([
            'name' => 'required|string|unique:category_courses,name',
            'image' => 'required',
            'description' => 'required'
        ]);
    }

    public static function createDataCourse($request){
        $request->validate([
            'name' => 'required|string|unique:courses,name',
            'course' => 'required',
            'description' => 'required',
            'category_course_id' => 'required',
        ]);
    }

    public static function task($request){
        $request->validate([
            'task' => 'required',
            'course_id' => 'required',
        ]);
    }
}
