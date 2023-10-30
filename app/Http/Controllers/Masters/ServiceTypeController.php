<?php

namespace App\Http\Controllers\Masters;

use DB;
use App\Models\MenuMaster;
use App\Models\ServiceType;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ServiceTypeController extends Controller
{
    public function list_service_type()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = UserAccount::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $servicetype = DB::table('service_types as srt')
        ->join('business_type as bt', 'srt.business_type_id', '=', 'bt.id')
        ->select('srt.*', 'bt.business_name')
        ->orderBy('srt.service_name', 'asc')
        ->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.masters.service_type.list', compact('servicetype','userdetails','loggeduser','structuredMenu'));
    }

    public function add_service_type()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = UserAccount::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $businesstype = DB::table('business_type as bt')
        ->where('bt.status','Y')
        ->get();
        return view('admin.masters.service_type.add',compact('loggeduser','userdetails','structuredMenu','businesstype'));
    }

    public function store_service_type(Request $request)
    {
        $request->validate(
        [
            'service_name' => 'required|regex:/^[A-Za-z\s]+$/|min:5|max:60|unique:service_types',
            'business_name' => 'required|not_in:0',
        ],
        [
            'service_name.required' => 'The service name field is required.',
            'service_name.regex' => 'The service name must contain only letters and spaces.',
            'service_name.min' => 'The service name must be at least 5 characters.',
            'service_name.max' => 'The service name cannot exceed 60 characters.',
            'service_name.unique' => 'This service name is already in use.',
            'business_name.not_in' => 'Please select a Business Type in the list.',

        ]);

        $servicetype = new ServiceType;
        $servicetype->service_name = ucfirst($request->service_name);
        $servicetype->business_type_id = $request->business_name;
        $servicetype->save();

        return redirect()->route('list.servicetype')->with('success', 'Service Type added successfully.');
    }

    public function edit_service_type($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = UserAccount::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $businesstype = DB::table('business_type as bt')
        ->where('bt.status','Y')
        ->get();
        $servicetype = ServiceType::find($id);

        if (!$servicetype) {
            return redirect()->route('list.servicetype')->with('error', 'Service Type not found.');
        }

        return view('admin.masters.service_type.edit', compact('servicetype','loggeduser','userdetails','structuredMenu','businesstype'));
    }

    public function update_service_type(Request $request, $id)
    {
        $servicetype = ServiceType::find($id);
        if (!$servicetype) {
            return redirect()->route('list.servicetype')->with('error', 'Service Type not found.');
        }

        $request->validate(
            [
                'service_name' => ['required','regex:/^[A-Za-z\s]+$/','min:5','max:60',Rule::unique('service_types')->ignore($id)],
                'business_name' => 'required|not_in:0',
            ],
            [
                'service_name.required' => 'The service name field is required.',
                'service_name.regex' => 'The service name must contain only letters and spaces.',
                'service_name.min' => 'The service name must be at least 5 characters.',
                'service_name.max' => 'The service name cannot exceed 60 characters.',
                'business_name.not_in' => 'Please select a Business Type in the list.',
                'service_name.unique' => 'This service name is already in use.',

            ]);

        $servicetype->service_name = ucfirst($request->service_name);
        $servicetype->business_type_id = $request->business_name;
        if ($request->status === 'Active')
        {
            $servicetype->status = 'Y';
        } else {
            $servicetype->status = 'N';
        }
        $servicetype->save();

        return redirect()->route('list.servicetype')->with('success', 'Service Type updated successfully.');
    }

    public function delete_service_type($id)
    {
        $servicetype = ServiceType::find($id);

        if (!$servicetype) {
            return redirect()->route('list.servicetype')->with('error', 'Service Type not found.');
        }

        $servicetype->delete();

        return redirect()->route('list.servicetype')->with('success', 'Service Type deleted successfully.');
    }
}
