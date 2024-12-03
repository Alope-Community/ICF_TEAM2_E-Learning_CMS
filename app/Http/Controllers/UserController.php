<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\User;
use App\MyClass\Validations;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index (Request $request) {
        if($request->ajax()) {
			return User::dataTable($request);
		}
        return view('user',[

        ]);
    }

    public function destroy ($id) {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus data'], 500);
        }
    }
}
