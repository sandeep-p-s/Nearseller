<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function productPage()
    {
        return view('user.products');
    }

    public function servicePage()
    {
        return view('user.services');
    }
}
