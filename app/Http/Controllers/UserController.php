<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\DataTables\UserDataTable;
=======
use App\Models\User;
>>>>>>> 260bb7c3cf85f6fb6608494e1b93865c5a356e38
use Illuminate\Http\Request;

class UserController extends Controller
{
<<<<<<< HEAD
    public function index (UserDataTable $dataTable) {
        return $dataTable->render('user');
=======
    public function index () {
        return view('user', [
            // 'users' => User::all()
        ]);
>>>>>>> 260bb7c3cf85f6fb6608494e1b93865c5a356e38
    }
}
