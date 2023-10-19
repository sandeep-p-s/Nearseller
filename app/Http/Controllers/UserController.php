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
        $services = DB::table('service_details')->select('id','service_name')->where('is_approved', 'Y')->get();
        // $service = DB::table('service_details')->select('id','service_name')->first();
        return view('user.services', compact('services','service'));
    }
    // public function serviceMenus($id)
    // {
    //     $service = DB::table('service_details')->where('id', $id)->first();
    //     return view('services.show', compact('service'));
    // }
}
