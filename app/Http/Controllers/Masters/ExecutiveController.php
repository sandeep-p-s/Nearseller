<?php

namespace App\Http\Controllers\Masters;

use App\Models\Executive;
use App\Models\UserAccount;
use App\Models\MenuMaster;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;

class ExecutiveController extends Controller
{
    public function list_executive()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $executive = DB::table('executives as ex')
        ->orderBy('ex.executive_name', 'asc')
        ->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.masters.executive.list', compact('executive', 'loggeduser', 'userdetails','structuredMenu'));
    }
    public function add_executive()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.masters.executive.add', compact('loggeduser', 'userdetails','structuredMenu'));
    }

    public function store_executive(Request $request)
    {
        //dd($request->all());
        $request->validate(
            [
                'executive_name' => 'required|string|min:5|max:255',
                'executive_type' => 'required|in:1,2',
            ],
            [
                'executive_name.required' => 'The executive name field is required.',
                'executive_name.string' => 'The executive name must be a string.',
                'executive_name.min' => 'The executive name must be at least 5 characters.',
                'executive_name.max' => 'The executive name cannot exceed 255 characters.',
            ]
        );
        $executive = new Executive();
        $executive->executive_type = $request->executive_type;
        $executive->executive_name = $request->executive_name;
        $executive->save();

        return redirect()->route('list.executive')->with('success', 'Executive added successfully.');
    }

    public function edit_executive($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $executive = Executive::find($id);

        if (!$executive) {
            return redirect()->route('list.executive')->with('error', 'Executive not found.');
        }
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.masters.executive.edit', compact('executive', 'loggeduser', 'userdetails','structuredMenu'));
    }

    public function update_executive_type(Request $request, $id)
    {
        $executive = Executive::find($id);
        if (!$executive) {
            return redirect()->route('list.executive')->with('error', 'Executive not found.');
        }

        $request->validate([
            'executive_name' => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        $executive->executive_name = $request->executive_name;
        $executive->executive_type = $request->executive_type;
        if ($request->status === 'Active')
        {
            $executive->status = 'Y';
        } else {
            $executive->status = 'N';
        }
        $executive->save();

        return redirect()->route('list.executive')->with('success', 'Executive updated successfully.');
    }

    public function delete_executive($id)
    {
        $executive = Executive::find($id);

        if (!$executive) {
            return redirect()->route('list.executive')->with('error', 'Executive not found.');
        }

        $executive->delete();

        return redirect()->route('list.executive')->with('success', 'Executive deleted successfully.');
    }
}