<?php

namespace App\MyClass;

class Validations
{
    public static function register($request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|min:7|max:20'
        ],[
            'name.required' => "Nama Wajib Diisi",
            'email.required' => "Email Wajib Diisi",
            'password.required' => "Password Wajib Diisi",
            'password.min' => "Password Minimal 7 Karakter",
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
}