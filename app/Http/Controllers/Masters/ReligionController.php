<?php

namespace App\Http\Controllers\Masters;

use DB;
use App\Models\MenuMaster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\masters\Religion;
use App\Http\Controllers\Controller;

class ReligionController extends Controller
{
    public function list_religion()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = User::sessionValuereturn($userRole);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $religions = DB::table('religions')->get();
        return view('admin.masters.religion.listReligion',compact('loggeduser','userdetails','religions','structuredMenu'));

    }
    public function add_religion()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = User::sessionValuereturn($userRole);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.masters.religion.addReligion',compact('loggeduser','userdetails','structuredMenu'));
    }
    public function store_religion(Request $request)
    {
        $request->validate([
            'religion_name' => 'required|unique:religions,religion_name|string|max:255|min:4',
        ],
        [
            'religion_name.required' => 'The religion name field is missing.',
            'religion_name.string' => 'The religion name must be a string.',
            'religion_name.unique' => 'The religion name must be unique.',
            'religion_name.min' => 'The religion name must be at least 4 characters.',
            'religion_name.max' => 'The religion name cannot exceed 255 characters.',
        ]);

        $newreligion = new Religion;
        $newreligion->religion_name = ucfirst(strtolower($request->religion_name));
        $newreligion->save();

        return redirect()->route('list.religion')->with('success', 'religion added successfully.');
    }
     public function edit_religion($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = User::sessionValuereturn($userRole);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $religion = Religion::find($id);

        if (!$religion) {
            return redirect()->route('list.religion')->with('error', 'religion not found.');
        }

        return view('admin.masters.religion.editReligion', compact('userdetails','loggeduser','religion','structuredMenu'));
    }
    public function update_religion(Request $request,$id)
    {
        $religion = Religion::find($id);
        if (!$religion) {
            return redirect()->route('list.religion')->with('error', 'religion not found.');
        }

        $request->validate([
            'religion_name' => ['required',Rule::unique('religions')->ignore($id),'string','max:255','min:4'],
            'status' => 'in:Y,N',
        ],
        [
            'religion_name.required' => 'The religion name field is missing.',
            'religion_name.string' => 'The religion name must be a string.',
            'religion_name.unique' => 'The religion name must be unique.',
            'religion_name.min' => 'The religion name must be at least 4 characters.',
            'religion_name.max' => 'The religion name cannot exceed 255 characters.',
            'status.in' => 'Invalid status value.',
        ]);
        $religion->religion_name = ucfirst(strtolower($request->religion_name));
        $religion->status = $request->status;
        $religion->save();

        return redirect()->route('list.religion')->with('success', 'religion updated successfully.');
    }
    public function delete_religion($id)
    {
        $religion = Religion::find($id);

        if (!$religion) {
            return redirect()->route('list.religion')->with('error', 'religion not found.');
        }

        $religion->delete();

        return redirect()->route('list.religion')->with('success', 'religion deleted successfully.');
    }
}
