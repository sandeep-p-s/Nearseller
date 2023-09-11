<?php

namespace App\Http\Controllers\Masters;

use DB;
use App\Models\masters\State;
use App\Models\UserAccount;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function list_state()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $states = DB::table('state as st')
        ->select('st.state_name','st.id', 'ct.country_name as country_name','st.status')
        ->join('country as ct', 'ct.id', 'st.country_id')
        ->get();
        // dd($country);
        return view('admin.masters.state.listState', compact('loggeduser', 'userdetails', 'states'));
    }
    public function add_state()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $countries = DB::table('country')->get();
        return view('admin.masters.state.addState', compact('loggeduser', 'userdetails','countries'));
    }
    public function store_state(Request $request)
    {
        $request->validate(
            [
                'country_name' => 'not_in:0',
                'state_name' => 'required|unique:state,state_name|string|max:255|min:4',
            ],
            [
                'country_name.not_in' => 'Please select country.',
                'state_name.required' => 'The state name field is missing.',
                'state_name.string' => 'The state name must be a string.',
                'state_name.unique' => 'The state name must be unique.',
                'state_name.min' => 'The state name must be at least 4 characters.',
                'state_name.max' => 'The state name cannot exceed 255 characters.',
            ]
        );

        $newstate = new state;
        $newstate->country_id = $request->country_name;
        $newstate->state_name = ucfirst(strtolower($request->state_name));
        $newstate->save();

        return redirect()->route('list.state')->with('success', 'State added successfully.');
    }
    public function edit_state($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $countries = DB::table('country')->get();
        $state = state::find($id);

        if (!$state) {
            return redirect()->route('list.state')->with('error', 'State not found.');
        }

        return view('admin.masters.state.editState', compact('userdetails', 'loggeduser','countries', 'state'));
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
                'state_name' => ['required', Rule::unique('state')->ignore($id), 'string', 'max:255', 'min:4'],
                'status' => 'in:Y,N',
            ],
            [
                'country_name.not_in' => 'Please select country.',
                'state_name.required' => 'The state name field is missing.',
                'state_name.string' => 'The state name must be a string.',
                'state_name.unique' => 'The state name must be unique.',
                'state_name.min' => 'The state name must be at least 4 characters.',
                'state_name.max' => 'The state name cannot exceed 255 characters.',
                'status.in' => 'Invalid status value.',
            ]
        );
        $state->state_name = ucfirst(strtolower($request->state_name));
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
