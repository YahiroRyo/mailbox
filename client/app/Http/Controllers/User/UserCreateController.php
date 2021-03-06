<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Services\UserService;

class UserCreateController extends Controller
{
    private $user_service;
    public function __construct()
    {
        $this->user_service = new UserService();
    }
    public function view()
    {
        return view('users.create');
    }
    public function user_create(UserCreateRequest $request)
    {
        $validated = $request->validated();
        $this->user_service->user_create($validated['email'], $validated['password']);
        auth()->attempt($validated);
        return redirect('/');
    }
}
