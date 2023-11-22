<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Models\LogDetails;
use App\Models\MenuMaster;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\ServiceEmployee;

class ServiceEmployeeController extends Controller
{
    public function list_service_employee($serviceid)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $service_emp = DB::table('service_employees')->where('user_id',$serviceid)->get();
        $roleIdsArray = explode(',', $roleid);
        if ((in_array('2', $roleIdsArray)) || (in_array('9', $roleIdsArray)))
        {
            $selrdetails = DB::table('seller_details')->select('busnes_type','term_condition')
            ->where('user_id', $userId)
            ->first();
        }
        else{
            $selrdetails='';
        }
        return view('seller.service.employee.list_employee', compact('service_emp', 'loggeduser', 'userdetails','structuredMenu','selrdetails','serviceid'));
    }
    public function add_service_employee($serviceid)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $countries = DB::table('country as ct')
        ->orderByRaw('ct.id = ? desc', [1])
        ->orderBy('ct.country_name', 'asc')
        ->get();
        $userservicedets = DB::table('seller_details')
        ->select('id', 'shop_name')
        ->where('busnes_type', 2)
        ->where('seller_approved','Y')->where('id',$serviceid)
        ->get();
        $roleIdsArray = explode(',', $roleid);
        if ((in_array('2', $roleIdsArray)) || (in_array('9', $roleIdsArray)))
        {
            $selrdetails = DB::table('seller_details')->select('busnes_type','term_condition')
            ->where('user_id', $userId)
            ->first();
        }
        else{
            $selrdetails='';
        }
        return view('seller.service.employee.add_employee', compact('loggeduser', 'userdetails', 'countries','structuredMenu','userservicedets','selrdetails','serviceid'));
    }
    // public function getStates($country)
    // {
    //     $states = DB::table('state')->where('country_id', $country)->get();
    //     return response()->json($states);
    // }
    // public function getDistricts($state)
    // {
    //     $districts = DB::table('district')->where('state_id', $state)->get();
    //     return response()->json($districts);
    // }
    public function store_service_employee(Request $request)
    {

        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $validator = Validator::make($request->all(), [
            'serviceproviderid' => 'required',
            'employee_name' => 'required|string|max:50',
            'employee_id' => 'required|string|max:50|unique:service_employees',
            'designation' => 'required|string|max:80',
            'joining_date' => 'required|date',
            'aadhar_no' => 'required|string|max:12',
            'permanent_address' => 'required|string',
            'country' => 'required|exists:country,id',
            'state' => 'required|exists:state,id',
            'district' => 'required|exists:district,id',
            'pincode' => 'required|string|max:6',
            'present_address' => 'required|string',
            'present_country' => 'required|exists:country,id',
            'present_state' => 'required|exists:state,id',
            'present_district' => 'required|exists:district,id',
            'present_pincode' => 'required|string|max:6',
            'image' => 'required|mimes:jpeg,png,jpg|max:2048',

        ]);

        $messages = [
            'serviceproviderid.required' => 'Please select Service user in the list',
            'country.required' => 'Please select country in the list',
            'state.required' => 'Please select state in the list',
            'district.required' => 'Please select district in the list',
            'present_country.required' => 'Please select country in the list',
            'present_state.required' => 'Please select state in the list',
            'present_district.required' => 'Please select district in the list',
            'image.required' => 'Please upload an image',
        ];

        $validator->setCustomMessages($messages);

        if ($validator->fails()) {
            $errors = Arr::flatten($validator->errors()->getMessages());
            $errors = implode("\n", $errors);
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $service_emp = new ServiceEmployee;
        $service_emp->user_id = $request->serviceproviderid;
        $service_emp->employee_name = $request->employee_name;
        $service_emp->employee_id = $request->employee_id;
        $service_emp->designation = $request->designation;
        $service_emp->joining_date = $request->joining_date;
        $service_emp->aadhar_no = $request->aadhar_no;
        $service_emp->permanent_address = $request->permanent_address;
        $service_emp->country = $request->country;
        $service_emp->state = $request->state;
        $service_emp->district = $request->district;
        $service_emp->pincode = $request->pincode;
        $service_emp->is_same_permanent_address = $request->has('is_same_permanent_address') ? true : false;
        $service_emp->present_address = $request->present_address;
        $service_emp->present_country = $request->present_country;
        $service_emp->present_state = $request->present_state;
        $service_emp->present_district = $request->present_district;
        $service_emp->present_pincode = $request->present_pincode;
        $upload_path = 'uploads/service_employee/';
        $file_path = $request->file('image');
        if ($file_path != '') {
            if ($file_path->isValid()) {
                $new_name = time() . '_' . $file_path->getClientOriginalName();
                $file_path->move($upload_path, $new_name);
                $service_emp->image = $new_name;
            }
        }
        $service_emp->save();
        $service_empid = $service_emp->id;
        $msg = 'New Service Successfully added. Service ID is: ' . $service_empid;
            $LogDetails = new LogDetails();
            $LogDetails->user_id = $userId;
            $LogDetails->ip_address = $loggedUserIp;
            $LogDetails->log_time = $time;
            $LogDetails->status = $msg;
            $LogDetails->save();

        return redirect()->route('list.service_employee',$request->serviceproviderid)->with('success', 'Employee added successfully.');
    }

    public function edit_service_employee($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $userservicedets = DB::table('users')
        ->select('id', 'name')
        ->where('role_id', 9)
        ->get();
        $service_emp = ServiceEmployee::find($id);
        $countries      = DB::table('country')->get();
        $states = DB::table('state')->where('country_id', $service_emp->country)->get();
        $districts = DB::table('district')->where('state_id', $service_emp->state)->get();


        if (!$service_emp) {
            return redirect()->route('list.shop_offer')->with('error', 'Shop offer not found.');
        }
        $roleIdsArray = explode(',', $roleid);
        if ((in_array('2', $roleIdsArray)) || (in_array('9', $roleIdsArray)))
        {
            $selrdetails = DB::table('seller_details')->select('busnes_type','term_condition')
            ->where('user_id', $userId)
            ->first();
        }
        else{
            $selrdetails='';
        }

        return view('seller.service.employee.edit_employee', compact('service_emp', 'loggeduser', 'userdetails', 'countries','states','districts','structuredMenu','userservicedets','selrdetails'));
    }

    public function update_service_employee(Request $request, $id)
    {

        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $service_emp = ServiceEmployee::find($id);

        if (!$service_emp) {
            return redirect()->route('list.service_employee')->with('error', 'Employee not found.');
        }

        $validator = Validator::make($request->all(), [
            'Serviceproviderid' => 'required',
            'employee_name' => 'required|string|max:50',
            'employee_id' => 'required|string|max:50',
            'designation' => 'required|string|max:80',
            'joining_date' => 'required|date',
            'aadhar_no' => 'required|string|max:12',
            'permanent_address' => 'required|string',
            'country' => 'required|exists:country,id',
            'state' => 'required|exists:state,id',
            'district' => 'required|exists:district,id',
            'pincode' => 'required|string|max:6',
            'present_address' => 'required|string',
            'present_country' => 'required|exists:country,id',
            'present_state' => 'required|exists:state,id',
            'present_district' => 'required|exists:district,id',
            'present_pincode' => 'required|string|max:6',
            'image' => 'required|mimes:jpeg,png,jpg|max:2048',
        ]);


        $messages = [
            'Serviceproviderid.required' => 'Please select Service user in the list',
            'country.required' => 'Please select country in the list',
            'state.required' => 'Please select state in the list',
            'district.required' => 'Please select district in the list',
            'present_country.required' => 'Please select country in the list',
            'present_state.required' => 'Please select state in the list',
            'present_district.required' => 'Please select district in the list',
            'image.required' => 'Please upload an image',
        ];

        $validator->setCustomMessages($messages);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $service_emp->employee_name = $request->employee_name;
        $service_emp->employee_id = $request->employee_id;
        $service_emp->designation = $request->designation;
        $service_emp->joining_date = $request->joining_date;
        $service_emp->aadhar_no = $request->aadhar_no;
        $service_emp->permanent_address = $request->permanent_address;
        $service_emp->country = $request->country;
        $service_emp->state = $request->state;
        $service_emp->district = $request->district;
        $service_emp->pincode = $request->pincode;
        $service_emp->present_address = $request->present_address;
        $service_emp->present_country = $request->present_country;
        $service_emp->present_state = $request->present_state;
        $service_emp->present_district = $request->present_district;
        $service_emp->present_pincode = $request->present_pincode;

        $upload_path = 'uploads/service_employee/';
        $file_path = $request->file('image');

        if ($file_path && $file_path->isValid()) {
            $full_file_path = public_path($upload_path . $service_emp->image);

            if (file_exists($full_file_path)) {
                unlink($full_file_path);
            }
            $new_name = time() . '_' . $file_path->getClientOriginalName();
            $file_path->move($upload_path, $new_name);
            $service_emp->image = $new_name;
        }
        if ($request->status === 'Active')
        {
            $service_emp->status = 'Y';
        } else {
            $service_emp->status = 'N';
        }
        $service_emp->save();
        $msg = 'Service Employees successfully Updated. Updated service ID is :  ' . $id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        return redirect()->route('list.service_employee',$request->Serviceproviderid)->with('success', 'Employee updated successfully.');
    }


    public function delete_service_employee($id)
    {
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $service_emp = ServiceEmployee::find($id);

        if (!$service_emp) {
            return redirect()->route('list.service_employee',$service_emp->user_id)->with('error', 'Shop offer not found.');
        }
        $upload_path = 'uploads/service_employee/';
        $file_path = $service_emp->image;
        $full_file_path = public_path('uploads/service_employee/' . $file_path);
        //dd($full_file_path);
        if (file_exists($full_file_path)) {
            unlink($full_file_path);
        }

        $service_emp->delete();
        $msg = 'Service Employee deleted employee id : ' . $id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        return redirect()->route('list.service_employee',$service_emp->user_id)->with('success', 'Employee deleted successfully.');
    }
}
