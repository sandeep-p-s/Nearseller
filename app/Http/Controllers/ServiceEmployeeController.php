<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Models\UserAccount;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\ServiceEmployee;

class ServiceEmployeeController extends Controller
{
    public function list_service_employee()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $service_emp = DB::table('service_employees')->get();
        return view('seller.service.employee.list_employee', compact('service_emp', 'loggeduser', 'userdetails'));
    }
    public function add_service_employee()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $countries      = DB::table('country')->get();
        return view('seller.service.employee.add_employee', compact('loggeduser', 'userdetails', 'countries'));
    }
    public function getStates($country)
    {
        $states = DB::table('state')->where('country_id', $country)->get();
        return response()->json($states);
    }
    public function getDistricts($state)
    {
        $districts = DB::table('district')->where('state_id', $state)->get();
        return response()->json($districts);
    }
    public function store_service_employee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_name' => 'required|string|max:255',
            'employee_id' => 'required|string|max:255|unique:service_employees',
            'designation' => 'required|string|max:255',
            'joining_date' => 'required|date',
            'aadhar_no' => 'required|string|max:255|unique:service_employees',
            'permanent_address' => 'required|string',
            'country' => 'required|exists:country,id',
            'state' => 'required|exists:state,id',
            'district' => 'required|exists:district,id',
            'pincode' => 'required|string|max:10',
            'present_address' => 'required|string',
            'present_country' => 'required|exists:country,id',
            'present_state' => 'required|exists:state,id',
            'present_district' => 'required|exists:district,id',
            'present_pincode' => 'required|string|max:10',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $messages = [
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
        if ($file_path != '') {
            if ($file_path->isValid()) {
                $new_name = time() . '_' . $file_path->getClientOriginalName();
                $file_path->move($upload_path, $new_name);
                $service_emp->image = $new_name;
            }
        }
        $service_emp->save();

        return redirect()->route('list.service_employee')->with('success', 'Employee added successfully.');
    }

    public function edit_service_employee($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $service_emp = ServiceEmployee::find($id);
        $countries      = DB::table('country')->get();
        $states = DB::table('state')->where('country_id', $service_emp->country)->get();
        $permanentSameAsPresent = true;
        $districts = DB::table('district')->where('state_id', $service_emp->state)->get();


        if (!$service_emp) {
            return redirect()->route('list.shop_offer')->with('error', 'Shop offer not found.');
        }

        return view('seller.service.employee.edit_employee', compact('service_emp', 'loggeduser', 'userdetails', 'countries','states','districts','permanentSameAsPresent'));
    }

    public function update_service_employee(Request $request, $id)
    {
        $service_emp = ServiceEmployee::find($id);

        if (!$service_emp) {
            return redirect()->route('list.service_employee')->with('error', 'Employee not found.');
        }

        $validator = Validator::make($request->all(), [
            'employee_name' => 'required|string|max:255',
            'employee_id' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'joining_date' => 'required|date',
            'aadhar_no' => 'required|string|max:255',
            'permanent_address' => 'required|string',
            'country' => 'required|exists:country,id',
            'state' => 'required|exists:state,id',
            'district' => 'required|exists:district,id',
            'pincode' => 'required|string|max:10',
            'present_address' => 'required|string',
            'present_country' => 'required|exists:country,id',
            'present_state' => 'required|exists:state,id',
            'present_district' => 'required|exists:district,id',
            'present_pincode' => 'required|string|max:10',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $messages = [
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
            return redirect()->back()->withErrors($validator)->withInput();
        }

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

        $service_emp->save();

        return redirect()->route('list.service_employee')->with('success', 'Employee updated successfully.');
    }


    public function delete_service_employee($id)
    {
        $service_emp = ServiceEmployee::find($id);

        if (!$service_emp) {
            return redirect()->route('list.shop_offer')->with('error', 'Shop offer not found.');
        }
        $upload_path = 'uploads/service_employee/';
        $file_path = $service_emp->image;
        $full_file_path = public_path('uploads/service_employee/' . $file_path);
        //dd($full_file_path);
        if (file_exists($full_file_path)) {
            unlink($full_file_path);
        }

        $service_emp->delete();

        return redirect()->route('list.service_employee')->with('success', 'Employee deleted successfully.');
    }
}
