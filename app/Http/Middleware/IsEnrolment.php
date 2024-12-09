<?php

namespace App\Http\Middleware;

use App\MyClass\Response as MyClassResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Exists;
use Symfony\Component\HttpFoundation\Response;

class IsEnrolment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $categoryId = $request->route('category');

        $isEnrolled = DB::table('enrolments')
                        ->where('user_id', $user->id)
                        ->where('category', $categoryId)
                        ->exists();

        if (!$isEnrolled) {
            return MyClassResponse::invalid([
                'message' => 'Anda Belum Terdaftar'
            ]);
        }
        
        return $next($request);
    }
}
