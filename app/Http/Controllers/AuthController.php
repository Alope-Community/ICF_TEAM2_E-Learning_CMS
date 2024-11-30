<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\MyClass\Response;
use App\MyClass\Validations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        Validations::register($request);
        DB::beginTransaction();

        try {
            $user = User::createUser($request->all());

            DB::commit();

            return Response::success([
                'message' => 'created data successfully',
                'data' => [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password,
                ], 
                'code' => 200,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }

    /**
     * @return for auth login
     */

    public function login(Request $request)
    {
        Validations::login($request);
        DB::beginTransaction();

        try {
            $credentials = $request->only(['email', 'password']);

            if (Auth::attempt($credentials)) {
                $user  = $request->user();
                $token = $user->createToken('Auth::login', ['*'], now()->addMinutes(120))->plainTextToken;

                DB::commit();

                return Response::success([
                    'message' => 'Login successfully',
                    'data' => [
                        'token' =>  $token
                    ]
                ]);
            } else {
                return Response::invalid([
                    'message' => 'Password Tidak Sesuai',
                    'code' => 422
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }


    public function logout(Request $request)
    {
        DB::beginTransaction();
        try {
			auth()->logout();
		} catch (\Exception $e) {}
        $request->user()->currentAccessToken()->delete();
        DB::commit();
        return Response::success([
            'mesagge' => 'logout Success',
            'code' => 200
        ]);
    }
}