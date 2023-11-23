<?php

namespace App\Http\Controllers\Masters;

use DB;
use App\Models\MenuMaster;
use App\Models\User;
use App\Models\BusinessType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class BusinessTypeController extends Controller
{
    public function list_business_type()
    {
        //
        //$userRole = session('user_role');
        $userId = session('user_id');
        $userRole = session('roleid');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        //$loggeduser     = User::sessionValuereturn($userRole);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $businesstype = DB::table('business_type')->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.masters.business_type.list', compact('businesstype', 'loggeduser', 'userdetails','structuredMenu'));
    }

    public function add_business_type()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.masters.business_type.add', compact('loggeduser', 'userdetails','structuredMenu'));
    }

    public function store_business_type(Request $request)
    {
        $request->validate(
            [
                'business_name' => 'required|regex:/^[A-Za-z\s]+$/|min:3|max:30|unique:business_type',
            ],
                [
                    'business_name.required' => 'The business name field is required.',
                    'business_name.regex' => 'The business name must contain only letters and spaces.',
                    'business_name.min' => 'The business name must be at least 5 characters.',
                    'business_name.max' => 'The business name cannot exceed 50 characters.',
                    'business_name.unique' => 'This business name is already in use.',

                ]
        );


        $businesstype = new BusinessType;
        $businesstype->business_name = ucfirst($request->business_name);
        $businesstype->save();

        return redirect()->route('list.businesstype')->with('success', 'Business Type added successfully.');
    }

    public function edit_business_type($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $businesstype = BusinessType::find($id);

        if (!$businesstype) {
            return redirect()->route('list.businesstype')->with('error', 'Business Type not found.');
        }

        return view('admin.masters.business_type.edit', compact('businesstype', 'loggeduser', 'userdetails','structuredMenu'));
    }

    public function update_business_type(Request $request, $id)
    {
        $businesstype = BusinessType::find($id);
        if (!$businesstype) {
            return redirect()->route('list.businesstype')->with('error', 'Business Type not found.');
        }

        $request->validate(
            [
                'business_name' => ['required','regex:/^[A-Za-z\s]+$/','min:3','max:30',Rule::unique('business_type')->ignore($id)],
            ],
                [
                    'business_name.required' => 'The business name field is required.',
                    'business_name.regex' => 'The business name must contain only letters and spaces.',
                    'business_name.min' => 'The business name must be at least 5 characters.',
                    'business_name.max' => 'The business name cannot exceed 50 characters.',
                    'business_name.unique' => 'This business name is already in use.',

                ]
        );

        $businesstype->business_name = ucfirst($request->business_name);
        if ($request->status === 'Active')
        {
            $businesstype->status = 'Y';
        } else {
            $businesstype->status = 'N';
        }
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
