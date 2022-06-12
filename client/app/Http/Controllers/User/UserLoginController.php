<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Models\User\Eloquent\User;

class UserLoginController extends Controller
{
    public function view()
    {
        return view('users.login');
    }
    public function user_login(UserLoginRequest $request)
    {
        if (!User::where('email', $request->email)->has('active')->exists()) {
        }
        auth()->attempt($request->validated());
        return redirect('/');
    }
}
