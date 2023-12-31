<?php

namespace App\Http\Controllers\Masters;

use DB;
use App\Models\MenuMaster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\masters\Profession;
use App\Http\Controllers\Controller;

class ProfessionsController extends Controller
{
    public function list_profession()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = User::sessionValuereturn($userRole);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $professions = DB::table('professions')->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.masters.professions.listProfession',compact('loggeduser','userdetails','professions','structuredMenu'));

    }
    public function add_profession()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = User::sessionValuereturn($userRole);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.masters.professions.addProfession',compact('loggeduser','userdetails','structuredMenu'));
    }
    public function store_profession(Request $request)
    {
        $request->validate([
            'profession_name' => 'required|unique:professions,profession_name|string|max:255|min:4',
        ],
        [
            'profession_name.required' => 'The profession name field is missing.',
            'profession_name.string' => 'The profession name must be a string.',
            'profession_name.unique' => 'The profession name must be unique.',
            'profession_name.min' => 'The profession name must be at least 4 characters.',
            'profession_name.max' => 'The profession name cannot exceed 255 characters.',
        ]);

        $newprofession = new Profession;
        $newprofession->profession_name = ucfirst(strtolower($request->profession_name));
        $newprofession->save();

        return redirect()->route('list.profession')->with('success', 'Profession added successfully.');
    }
     public function edit_profession($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = User::sessionValuereturn($userRole);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $profession = Profession::find($id);

        if (!$profession) {
            return redirect()->route('list.profession')->with('error', 'Profession not found.');
        }

        return view('admin.masters.professions.editProfession', compact('userdetails','loggeduser','profession','structuredMenu'));
    }
    public function update_profession(Request $request,$id)
    {
        $profession = Profession::find($id);
        if (!$profession) {
            return redirect()->route('list.profession')->with('error', 'Profession not found.');
        }

        $request->validate([
            'profession_name' => ['required',Rule::unique('professions')->ignore($id),'string','max:255','min:4'],
            'status' => 'in:Y,N',
        ],
        [
            'profession_name.required' => 'The profession name field is missing.',
            'profession_name.string' => 'The profession name must be a string.',
            'profession_name.unique' => 'The profession name must be unique.',
            'profession_name.min' => 'The profession name must be at least 4 characters.',
            'profession_name.max' => 'The profession name cannot exceed 255 characters.',
            'status.in' => 'Invalid status value.',
        ]);
        $profession->profession_name = ucfirst(strtolower($request->profession_name));
        $profession->status = $request->status;
        $profession->save();

        return redirect()->route('list.profession')->with('success', 'Profession updated successfully.');
    }
    public function delete_profession($id)
    {
        $profession = Profession::find($id);

        if (!$profession) {
            return redirect()->route('list.profession')->with('error', 'Profession not found.');
        }

        $profession->delete();

        return redirect()->route('list.profession')->with('success', 'Profession deleted successfully.');
    }
}
