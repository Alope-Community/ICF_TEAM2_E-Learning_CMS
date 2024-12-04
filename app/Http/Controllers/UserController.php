<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\User;
use App\MyClass\Response;
use App\MyClass\Validations;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index (Request $request) {
        if($request->ajax()) {
			return User::dataTable($request);
		}
        return view('user.user');
    }

    public function destroy (User $user) {
        DB::beginTransaction();
        try {
            $user->delete();

            DB::commit();
            return Response::success([
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }
}
