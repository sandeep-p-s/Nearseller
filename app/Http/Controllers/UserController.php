<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function productPage()
    {
        $category = DB::table('categories')->select('category_name')->get();
        //dd($category);
        return view('user.products', compact('category'));
    }

    public function servicePage()
    {
        $services = DB::table('service_details')->where('is_approved', 'Y')->get();
        return view('user.services', compact('services'));
    }
    // public function serviceMenus($id)
    // {
    //     $service = DB::table('service_details')->where('id', $id)->first();
    //     return view('services.show', compact('service'));
    // }
}
