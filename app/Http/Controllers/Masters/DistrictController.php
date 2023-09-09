<?php

namespace App\Http\Controllers\Masters;

use DB;
use App\Models\masters\District;
use App\Models\UserAccount;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function list_district()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $districts = DB::table('district as d')
            ->select('d.district_name','d.id','st.state_name','ct.country_name')
            ->join('state as st','d.state_id','st.id')
            ->join('country as ct','st.country_id','ct.id')
            ->get();
        return view('admin.masters.district.listDistrict',compact('loggeduser','userdetails','districts'));

    }
    public function add_district()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        return view('admin.masters.district.adddistrict',compact('loggeduser','userdetails'));
    }
    public function store_district(Request $request)
    {
        $request->validate([
            'district_name' => 'required|unique:district,district_name|string|max:255|min:4',
        ],
        [
            'district_name.required' => 'The district name field is missing.',
            'district_name.string' => 'The district name must be a string.',
            'district_name.unique' => 'The district name must be unique.',
            'district_name.min' => 'The district name must be at least 4 characters.',
            'district_name.max' => 'The district name cannot exceed 255 characters.',
        ]);

        $newdistrict = new district;
        $newdistrict->district_name = ucfirst(strtolower($request->district_name));
        $newdistrict->save();

        return redirect()->route('list.district')->with('success', 'Profession added successfully.');
    }
     public function edit_district($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $district = district::find($id);

        if (!$district) {
            return redirect()->route('list.shoptype')->with('error', 'Shop Type not found.');
        }

        return view('admin.masters.district.editdistrict', compact('district','userdetails','loggeduser'));
    }
    public function update_district(Request $request,$id)
    {
        $district = district::find($id);
        if (!$district) {
            return redirect()->route('list.district')->with('error', 'Shop Type not found.');
        }

        $request->validate([
            'district_name' => ['required',Rule::unique('district')->ignore($id),'string','max:255','min:4'],
            'status' => 'in:Y,N',
        ],
        [
            'district_name.required' => 'The district name field is missing.',
            'district_name.string' => 'The district name must be a string.',
            'district_name.unique' => 'The district name must be unique.',
            'district_name.min' => 'The district name must be at least 4 characters.',
            'district_name.max' => 'The district name cannot exceed 255 characters.',
            'status.in' => 'Invalid status value.',
        ]);
        $district->district_name = ucfirst(strtolower($request->district_name));
        $district->status = $request->status;
        $district->save();

        return redirect()->route('list.district')->with('success', 'district updated successfully.');
    }
    public function delete_district($id)
    {
        $district = district::find($id);

        if (!$district) {
            return redirect()->route('list.district')->with('error', 'Shop Type not found.');
        }

        $district->delete();

        return redirect()->route('list.district')->with('success', 'district deleted successfully.');
    }

}
