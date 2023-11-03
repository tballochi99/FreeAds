<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function showIndex(): View
    {
        return view('index');
    }

    public function showRegister(): View
    {
        return view('register');
    }

    public function showLogin(): View
    {
        return view('login');
    }

}