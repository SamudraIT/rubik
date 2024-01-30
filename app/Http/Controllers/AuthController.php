<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function renderLogin()
    {
        return view('pages.auth.login');
    }

    public function renderRegister()
    {
        return view('pages.auth.register');
    }

}
