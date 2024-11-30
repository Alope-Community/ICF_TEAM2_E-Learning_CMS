<?php

namespace App\Http\Controllers;

use App\Models\SocialAccount;
use App\Models\User;
use App\MyClass\Response;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialAccountController extends Controller
{
    public function redirectToSosial(){
        $provider = "github";
        return Socialite::driver($provider);
    }

    public function authWithGogle(){
        DB::beginTransaction();
        try {
            $user = Socialite::driver('github')->user();

            $findUser = User::where('gogle_id', $user->id)->first();

            if (!$findUser) {
                $user = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gogle_id' => $user->id,
                    'password' => Hash::make('admin@123'),
                ]);

                $token = $user->createToken(['Auth::login', ['*'], now()->addMinutes(120)])->plainTextToken;

                return Response::success([
                    'message' => 'Login Success',
                    'data' => [
                        'token' => $token
                    ],
                    'code' => 200
                ]);
            }else {
                $token = $findUser->createToken('Auth::login', ['*'], now()->addMinutes(120))->plainTextToken;

                return Response::success([
                    'message' => 'Login Success',
                    'data' => [
                        'token' => $token
                    ],
                    'code' => 200
                ]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            
            return Response::error($e);
        }
    }
    
}
