<?php

namespace App\Http\Controllers\Masters;

use DB;
use App\Models\MenuMaster;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\masters\State;
use App\Models\masters\Country;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class StateController extends Controller
{
    public function list_state()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $states = DB::table('state as st')
            ->select('st.state_name', 'st.id', 'st.status as st_status', 'ct.country_name as country_name', 'ct.status as ct_status')
            ->join('country as ct', 'ct.id', 'st.country_id')
            ->where('ct.status', 'Y')
            ->orderBy('st.state_name', 'asc')
            ->get();
        $total_states = DB::table('state')->count();
        $inactive_states = DB::table('state as s')->where('s.status', 'N')->count();
        // dd($country);
        return view('admin.masters.state.listState', compact('loggeduser', 'userdetails', 'states', 'total_states', 'inactive_states', 'structuredMenu'));
    }
    public function add_state()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $countries = DB::table('country as ct')
            ->where('ct.status', 'Y')
            ->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.masters.state.addState', compact('loggeduser', 'userdetails', 'countries', 'structuredMenu'));
    }
    public function store_state(Request $request)
    {
        $request->validate([
            'country_name' => 'not_in:0',
            'state_name' => [
                'required',
                'regex:/^[a-zA-Z &]+$/',
                'max:60',
                'unique:state,state_name,NULL,id,country_id,' . $request->country_name,
            ],
        ], [
            'country_name.not_in' => 'Please select a country.',
            'state_name.required' => 'The state name field is missing.',
            'state_name.regex' => 'Invalid format used.',
            'state_name.max' => 'The state name cannot exceed 60 characters.',
            'state_name.unique' => 'The state name is already taken in the selected country.',
        ]);

        $newstate = new State;
        $newstate->country_id = $request->country_name;
        $newstate->state_name = ucwords(strtolower($request->state_name));
        $newstate->save();

        return redirect()->route('list.state')->with('success', 'State added successfully.');
    }


    public function edit_state($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $countries = DB::table('country as ct')
            ->where('ct.status', 'Y')
            ->get();
        $state = state::find($id);

        if (!$state) {
            return redirect()->route('list.state')->with('error', 'State not found.');
        }

        return view('admin.masters.state.editState', compact('userdetails', 'loggeduser', 'countries', 'state', 'structuredMenu'));
    }
    public function update_state(Request $request, $id)
    {
        $state = state::find($id);
        if (!$state) {
            return redirect()->route('list.state')->with('error', 'State not found.');
        }

        $request->validate(
            [
                'country_name' => 'not_in:0',
                'state_name' => ['required', Rule::unique('state')->ignore($id), 'regex:/^[a-zA-Z &]+$/', 'max:60'],
                'status' => 'in:Y,N',
            ],
            [
                'country_name.not_in' => 'Please select country.',
                'state_name.required' => 'The state name field is missing.',
                'state_name.regex' => 'The state name is not in valid format.',
                'state_name.unique' => 'The state name must be unique.',
                // 'state_name.min' => 'The state name must be at least 4 characters.',
                'state_name.max' => 'The state name cannot exceed 60 characters.',
                'status.in' => 'Invalid status value.',
            ]
        );
        $state->state_name = ucwords(strtolower($request->state_name));
        $state->status = $request->status;
        $state->save();

        return redirect()->route('list.state')->with('success', 'State updated successfully.');
    }
    public function delete_state($id)
    {
        $state = state::find($id);

        if (!$state) {
            return redirect()->route('list.state')->with('error', 'State not found.');
        }

        $state->delete();

        return redirect()->route('list.state')->with('success', 'State deleted successfully.');
    }
}
