<?php

namespace App\Http\Controllers\Masters;

use DB;
use App\Models\masters\Attribute;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function list_attribute()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = User::sessionValuereturn($userRole);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $attributes = DB::table('attributes')->get();
        $total_attributes = DB::table('attributes')->count();
        $inactive_attributes = DB::table('attributes as a')->where('a.status','N')->count();
        return view('admin.masters.attribute.listAttribute',compact('loggeduser','userdetails','attributes','total_attributes','inactive_attributes'));

    }

    function add_attribute(Request $request)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = User::sessionValuereturn($userRole);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        return view('admin.masters.attribute.addAttribute',compact('loggeduser','userdetails'));
    }

    public function store_attribute(Request $request)
    {
        $request->validate([
            'attribute_name' => 'required|unique:attributes,attribute_name|regex:/^[a-zA-Z &]+$/|max:255|min:3',
        ], [
            // Custom error messages
        ]);

        $newattribute = new Attribute;
        $newattribute->attribute_name = ucfirst(strtolower($request->attribute_name));
        $newattribute->save();

        return response()->json(['success' => 'Attribute added successfully']);
    }
    }
