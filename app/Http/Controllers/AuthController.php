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
    public function register(Request $request){
        Validations::register($request);
        DB::beginTransaction();

        try {
            $user = User::createUser($request->all());

            $token = $user->createToken([
                'name' => 'Auth::register',
                'expiration' => 36000,
            ])->plainTextToken;

            DB::commit();

            return Response::success([
                'message' => 'created data successfully',
                'code' => 200,
                'data' => [
                    'token' => $token,
                ],
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }

    /**
     * @return for auth login
     */

    public function login(Request $request){
        Validations::login($request);
        DB::beginTransaction();

        try {

            $credentials = $request->only(['email', 'password']);

            if(Auth::attempt($credentials)){
                $user  = $request->user();
                $token = $user->createToken('Auth::login')->plainTextToken;

                DB::commit();

                return Response::success([
                    'message' => 'Login successfully',
                    'data' => [
                        'token' =>  $token
                    ]
                ]);
            } else {
                $e = throw new Exception("Login unsuccess", 1);
                return Response::error($e);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }

    public function getProfileAuth(Request $request){
        $data = [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
        ];
        return Response::success([
            'message' => 'Get data success',
            'data' => $data,
            'code' => 200
        ]);
    }
}
