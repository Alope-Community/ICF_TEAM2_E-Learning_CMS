<?php

namespace App\Http\Controllers;

use Exception;
use App\MyClass\Response;
use App\MyClass\Validations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function logout(Request $request) {
        // Hapus sesi Laravel
        Auth::logout();

        // Hapus semua cookie terkait sesi dan XSRF-TOKEN
        $cookieSession = cookie()->forget('laravel_session');
        $cookieXsrf = cookie()->forget('XSRF-TOKEN');

        // Regenerate session untuk keamanan tambahan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect atau kembalikan respons JSON
        return redirect('/')
            ->withCookie($cookieSession)
            ->withCookie($cookieXsrf);
    }
}
