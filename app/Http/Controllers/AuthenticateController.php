<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticateController extends Controller
{
    public function getLogin()
    {
        return view('authenticate.login');
    }

    public function postLogin(Request $request)
    {
        dd($request);
    }

    public function getRegister()
    {
        return view('authenticate.register');
    }

    public function postRegister(Request $request)
    {
        dd($request);
    }
}
