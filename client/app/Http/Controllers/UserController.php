<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function user_logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
