<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\User;

class UserLoginController extends Controller
{
    public function view()
    {
        return view('users.login');
    }
    public function login(UserLoginRequest $request)
    {
        if (!User::where('email', $request->email)->has('active')->exists()) {
        }
        auth()->attempt($request->validated());
        return redirect('/');
    }
}
