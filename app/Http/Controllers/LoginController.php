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
<<<<<<< HEAD
    // public function login(Request $request)
    // {
    //     Validations::login($request);
    //     DB::beginTransaction();
=======
    public function index(){
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        Validations::login($request);
        DB::beginTransaction();
>>>>>>> 260bb7c3cf85f6fb6608494e1b93865c5a356e38

    //     try {
    //         $credentials = $request->only(['email', 'password']);

    //         if (Auth::attempt($credentials)) {
    //             $request->session()->regenerate();
    //             // $token = $user->createToken('Auth::login', ['*'], now()->addMinutes(120))->plainTextToken;
    //             DB::commit();

    //             return redirect()->route('welcome');
    //         } else {
    //             return back()->withErrors([
    //                 'email' => 'Email atau password tidak sesuai.',
    //             ])->withInput();
    //         }
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         return Response::error($e);
    //     }
    // }

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
