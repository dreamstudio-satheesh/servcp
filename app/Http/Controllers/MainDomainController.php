<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainDomainController extends Controller
{
    public function login()
    {
        return view('main.login');
    }

    public function somepage()
    {
        return view('main.somepage');
    }
}
