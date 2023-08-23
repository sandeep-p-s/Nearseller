<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function sellerdashboard()
    {
        return view('seller.dashboard');
    }
}
