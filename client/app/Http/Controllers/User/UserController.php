<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function user_logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
