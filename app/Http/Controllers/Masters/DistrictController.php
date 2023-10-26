<?php

namespace App\Http\Controllers\Masters;

use DB;
use App\Models\MenuMaster;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\masters\District;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    public function list_district()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $districts = DB::table('district as d')
            ->select('d.district_name','d.id','st.state_name','ct.country_name','d.status as d_status','st.status as st_status','ct.status as ct_status')
            ->join('state as st','d.state_id','st.id')
            ->join('country as ct','st.country_id','ct.id')
            ->where('st.status','Y')
            ->where('ct.status','Y')
            ->orderBy('st.state_name', 'asc')
            ->orderBy('d.district_name', 'asc')
            ->get();
        $total_districts = DB::table('district')->count();
        $inactive_districts = DB::table('district as d')->where('d.status','N')->count();

        return view('admin.masters.district.listDistrict',compact('loggeduser','userdetails','districts','total_districts','inactive_districts','structuredMenu'));

    }
    public function add_district()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $states = DB::table('state as st')
        ->select('st.state_name','st.id', 'ct.country_name as country_name','st.status')
        ->join('country as ct', 'ct.id', 'st.country_id')
        ->where('st.status','Y')
        ->where('ct.status','Y')
        ->get();

        return view('admin.masters.district.addDistrict',compact('loggeduser','userdetails','states','structuredMenu'));
    }
    public function store_district(Request $request)
    {
        $request->validate([
            'state_name' => 'not_in:0',
            'district_name' => 'required|unique:district,district_name|string|max:255|min:4',
        ],
        [
            'state_name.not_in' => 'Please select state.',
            'district_name.required' => 'The district name field is missing.',
            'district_name.string' => 'The district name must be a string.',
            'district_name.unique' => 'The district name must be unique.',
            'district_name.min' => 'The district name must be at least 4 characters.',
            'district_name.max' => 'The district name cannot exceed 255 characters.',
        ]);

        $newdistrict = new District;
        $newdistrict->state_id = $request->state_name;
        $newdistrict->district_name = ucfirst(strtolower($request->district_name));
        $newdistrict->save();

        return redirect()->route('list.district')->with('success', 'District added successfully.');
    }
     public function edit_district($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $states = DB::table('state as st')
        ->select('st.state_name','st.id', 'ct.country_name as country_name','st.status')
        ->join('country as ct', 'ct.id', 'st.country_id')
        ->where('st.status','Y')
        ->where('ct.status','Y')
        ->get();
        $district = District::find($id);

        if (!$district) {
            return redirect()->route('list.shoptype')->with('error', 'District not found.');
        }

        return view('admin.masters.district.editDistrict', compact('district','userdetails','loggeduser','states','structuredMenu'));
    }
    public function update_district(Request $request,$id)
    {
        $district = District::find($id);
        if (!$district) {
            return redirect()->route('list.district')->with('error', 'District not found.');
        }

        $request->validate([
            'state_name' => 'not_in:0',
            'district_name' => ['required',Rule::unique('district')->ignore($id),'string','max:255','min:4'],
            'status' => 'in:Y,N',
        ],
        [
            'state_name.not_in' => 'Please select state.',
            'district_name.required' => 'The district name field is missing.',
            'district_name.string' => 'The district name must be a string.',
            'district_name.unique' => 'The district name must be unique.',
            'district_name.min' => 'The district name must be at least 4 characters.',
            'district_name.max' => 'The district name cannot exceed 255 characters.',
            'status.in' => 'Invalid status value.',
        ]);
        $district->state_id = $request->state_name;
        $district->district_name = ucfirst(strtolower($request->district_name));
        $district->status = $request->status;
        $district->save();

        return redirect()->route('list.district')->with('success', 'District updated successfully.');
    }
    public function delete_district($id)
    {
        $district = district::find($id);

        if (!$district) {
            return redirect()->route('list.district')->with('error', 'District not found.');
        }

        $district->delete();

        return redirect()->route('list.district')->with('success', 'District deleted successfully.');
    }

}
