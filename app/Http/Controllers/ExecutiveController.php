<?php

namespace App\Http\Controllers;

use App\Models\Executive;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use DB;
class ExecutiveController extends Controller
{
    public function list_executive()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $executive = DB::table('executives')->get();

        return view('admin.executive.list', compact('executive', 'loggeduser', 'userdetails'));
    }
    public function add_executive()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();

        return view('admin.executive.add', compact('loggeduser', 'userdetails'));
    }

    public function store_executive(Request $request)
    {
        $request->validate(
            [
                'executive_name' => 'required|string|min:5|max:255',
            ],
            [
                'executive_name.required' => 'The executive name field is required.',
                'executive_name.string' => 'The executive name must be a string.',
                'executive_name.min' => 'The executive name must be at least 5 characters.',
                'executive_name.max' => 'The executive name cannot exceed 255 characters.',
            ]
        );

        $executive = new Executive();
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

        return view('admin.executive.edit', compact('executive', 'loggeduser', 'userdetails'));
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