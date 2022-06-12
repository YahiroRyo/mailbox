<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check()) return redirect('/users/receive/mails');
        return view('index');
    }
}
