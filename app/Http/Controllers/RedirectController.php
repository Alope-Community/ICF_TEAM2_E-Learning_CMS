<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RedirectController extends Controller
{

    public function dashboard () {
        return view ('dashboard',
        ['users' => User::all()]
    );
    }

}
