<?php

namespace App\Http\Controllers;

use DB;
use App\Models\UserAccount;
use App\Models\BusinessType;
use Illuminate\Http\Request;

class BusinessTypeController extends Controller
{
    public function list_business_type()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $businesstype = DB::table('business_type')->get();
        return view('admin.business_type.list', compact('businesstype','loggeduser','userdetails'));
    }

    public function add_business_type()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        return view('admin.business_type.add', compact('loggeduser','userdetails'));
    }

    public function store_business_type(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|min:5|max:255',
        ],
        [
            'business_name.required' => 'The business name field is required.',
            'business_name.string' => 'The business name must be a string.',
            'business_name.min' => 'The business name must be at least 5 characters.',
            'business_name.max' => 'The business name cannot exceed 255 characters.',
        ]
    );


        $businesstype = new BusinessType;
        $businesstype->business_name = $request->business_name;
        $businesstype->save();

        return redirect()->route('list.businesstype')->with('success', 'Business Type added successfully.');
    }

    public function edit_business_type($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $businesstype = BusinessType::find($id);

        if (!$businesstype) {
            return redirect()->route('list.businesstype')->with('error', 'Business Type not found.');
        }

        return view('admin.business_type.edit', compact('businesstype','loggeduser','userdetails'));
    }

    public function update_business_type(Request $request, $id)
    {
        $businesstype = BusinessType::find($id);
        if (!$businesstype) {
            return redirect()->route('list.businesstype')->with('error', 'Business Type not found.');
        }

        $request->validate([
            'business_name' => 'required|string|max:255',
        ]);

        $businesstype->business_name = $request->business_name;
        $businesstype->save();

        return redirect()->route('list.businesstype')->with('success', 'Business Type updated successfully.');
    }

    public function delete_business_type($id)
    {
        $businesstype = BusinessType::find($id);

        if (!$businesstype) {
            return redirect()->route('list.businesstype')->with('error', 'Business Type not found.');
        }

        $businesstype->delete();

        return redirect()->route('list.businesstype')->with('success', 'Business Type deleted successfully.');
    }
}
