<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\MyClass\Response;
use App\MyClass\Validations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{   
    public function profile(){
        return view('settigs.profile');
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

    public function updatePassword(Request $request){
        Validations::updatePassword($request, auth()->user()->id);
        DB::beginTransaction();

        try {
            auth()->user()->update([
                'password' => Hash::make($request->new_password)
            ]);
            DB::commit();

            return Response::success([
                'message' => 'Password has updated',
                'code' => 200
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }
}
