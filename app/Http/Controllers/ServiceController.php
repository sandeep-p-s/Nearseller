<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Models\LogDetails;
use App\Models\MenuMaster;
use App\Models\UserAccount;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\ServiceDetails;
use App\Models\AddServiceAttribute;

class ServiceController extends Controller
{
    public function list_service()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $services = DB::table('service_details')
            ->leftJoin('add_service_attributes', 'service_details.id', '=', 'add_service_attributes.service_id')
            ->select(
                'service_details.id',
                'service_details.service_name',
                'service_details.is_attribute',
                'service_details.is_approved',
                'add_service_attributes.attribute_1',
                'add_service_attributes.attribute_2',
                'add_service_attributes.attribute_3',
                'add_service_attributes.attribute_4',
                'add_service_attributes.offer_price',
                'add_service_attributes.mrp_price'
            )
            ->get();
        $userservicedets = DB::table('user_account')
            ->select('id', 'name')
            ->where('role_id', 9)
            ->get();
        return view('seller.service.add_services.list_service', compact('services', 'loggeduser', 'userdetails', 'structuredMenu', 'userservicedets'));
    }
    public function add_service()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userservicedets = DB::table('user_account')
            ->select('id', 'name')
            ->where('role_id', 9)
            ->get();
        return view('seller.service.add_services.add_service', compact('loggeduser', 'userdetails', 'structuredMenu', 'userservicedets'));
    }
    public function store_service(Request $request)
    {
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');

        $validator = Validator::make($request->all(), [
            'service_name' => 'required|string|max:255',
            'service_images' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $messages = [
            'service_name.required' => 'Service name field is required',
            'service_images.required' => 'Please upload an image',
        ];

        $validator->setCustomMessages($messages);

        if ($validator->fails()) {
            $errors = Arr::flatten($validator->errors()->getMessages());
            $errors = implode("\n", $errors);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $isAttribute = $request->input('customRadio');
        $service = new ServiceDetails;
        $service->service_id = $request->serviceuser_name;
        $service->service_name = $request->service_name;
        $upload_path = 'uploads/service_images/';
        $file_path = $request->file('service_images');

        if ($file_path != '') {
            if ($file_path->isValid()) {
                $new_name = time() . '_' . $file_path->getClientOriginalName();
                $file_path->move($upload_path, $new_name);
                $service->service_images = $new_name;
            }
        }

        $service->is_attribute = $isAttribute;
        $service->save(); // Save the service first

        // Now, retrieve the ID after saving the service
        $service_id = $service->id;

        if ($isAttribute === 'Y' && $request->has('car')) {
            $showStatus = $request->input('car.0.showstatus.0', '0');
            foreach ($request->input('car') as $attributes) {
                $addServiceAttribute = new AddServiceAttribute;
                $addServiceAttribute->service_id = $service_id; // Use the retrieved service ID

                $addServiceAttribute->attribute_1 = $attributes['attribute1'];
                $addServiceAttribute->attribute_2 = $attributes['attribute2'];
                $addServiceAttribute->attribute_3 = $attributes['attribute3'];
                $addServiceAttribute->attribute_4 = $attributes['attribute4'];
                $addServiceAttribute->offer_price = $attributes['offerprice'];
                $addServiceAttribute->mrp_price = $attributes['mrp'];
                $addServiceAttribute->call_shop = $attributes['callshop'];
                $addServiceAttribute->show_status = $showStatus;
                $addServiceAttribute->save();
            }
            $msg = 'New Service Successfully added. Service ID is: ' . $service_id;
            $LogDetails = new LogDetails();
            $LogDetails->user_id = $userId;
            $LogDetails->ip_address = $loggedUserIp;
            $LogDetails->log_time = $time;
            $LogDetails->status = $msg;
            $LogDetails->save();
        }

        return redirect()->route('list.service')->with('success', 'Service details saved successfully');
    }


    public function edit_service($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $service = ServiceDetails::find($id);

        if (!$service) {
            return redirect()->route('list.service')->with('error', 'Service not found.');
        }
        $attributes = DB::table('add_service_attributes')->where('service_id', $id)->get();
        return view('seller.service.add_services.edit_service', compact('loggeduser', 'userdetails', 'structuredMenu', 'service', 'attributes'));
    }

    public function update_service(Request $request, $id)
    {
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $validator = Validator::make($request->all(), [
            'service_name' => 'required|string|max:255',
            'service_images' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $messages = [
            'service_name.required' => 'Service name field is required',
        ];

        $validator->setCustomMessages($messages);

        $service = ServiceDetails::find($id);

        if (!$service) {
            return redirect()->route('list.service')->with('error', 'Service not found.');
        }
        $service->service_name = $request->service_name;
        if ($request->service_status === 'Active')
        {
            $service->service_status = 'Y';
        } else {
            $service->service_status = 'N';
        }
        $upload_path = 'uploads/service_images/';
        $file_path = $request->file('service_images');

        if ($file_path && $file_path->isValid()) {
            $full_file_path = public_path($upload_path . $service->service_images);

            if (file_exists($full_file_path)) {
                unlink($full_file_path);
            }

            $new_name = time() . '_' . $file_path->getClientOriginalName();
            $file_path->move($upload_path, $new_name);
            $service->service_images = $new_name;
        }
        $isAttribute = $request->input('customRadio', 'N');
        //dd($service->is_attribute);
        //dd($request->all());
        if ($isAttribute === 'Y' && $request->has('car')) {
            $service->is_attribute = 'Y';
            $service->save();

            foreach ($request->input('car') as $attributes) {
                $attributeId = $attributes['attribute_id'];
                $attribute = AddServiceAttribute::where('id', $attributeId)->first();

                if ($attribute) {
                    $attribute->attribute_1 = $attributes['attribute1'];
                    $attribute->attribute_2 = $attributes['attribute2'];
                    $attribute->attribute_3 = $attributes['attribute3'];
                    $attribute->attribute_4 = $attributes['attribute4'];
                    $attribute->offer_price = $attributes['offerprice'];
                    $attribute->mrp_price = $attributes['mrp'];
                    $attribute->call_shop = $attributes['callshop'];
                    $showStatus = isset($attributes['showstatus']) ? 1 : 0;
                    $attribute->show_status = $showStatus;
                    $attribute->save();
                } else {
                    $newAttribute = new AddServiceAttribute();
                    $newAttribute->service_id = $service->id;
                    $newAttribute->attribute_1 = $attributes['attribute1'];
                    $newAttribute->attribute_2 = $attributes['attribute2'];
                    $newAttribute->attribute_3 = $attributes['attribute3'];
                    $newAttribute->attribute_4 = $attributes['attribute4'];
                    $newAttribute->offer_price = $attributes['offerprice'];
                    $newAttribute->mrp_price = $attributes['mrp'];
                    $newAttribute->call_shop = $attributes['callshop'];
                    $showStatus = isset($attributes['showstatus']) ? 1 : 0;
                    $newAttribute->show_status = $showStatus;
                    $newAttribute->save();
                }
            }
        } else {
            $service->is_attribute = 'N';
            $service->save();

            AddServiceAttribute::where('service_id', $id)->delete();
        }
        $msg = 'Service Successfully Updated. Updated service ID is :  ' . $id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        return redirect()->route('list.service')->with('success', 'Service details updated successfully');
    }

    public function delete_service($id)
    {
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $service = ServiceDetails::find($id);

        if (!$service) {
            return redirect()->route('list.service')->with('error', 'Service not found.');
        }

        if ($service->is_attribute === 'Y') {
            $attributes = AddServiceAttribute::where('service_id', $service->id)->get();
            foreach ($attributes as $attribute) {
                $attribute->delete();
            }
        }

        $file_path = $service->service_images;
        $full_file_path = public_path('uploads/service_images/' . $file_path);

        if (is_file($full_file_path)) {
            unlink($full_file_path);
        }

        $service->delete();
        $msg = 'Service Product Deleted service id : ' . $id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        return redirect()->route('list.service')->with('success', 'Service and its attributes deleted successfully.');
    }

    public function AdmServiceApprovedAll(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $serviceid = $request->input('serviceid');
        $service_id = explode('#', $serviceid);
        $toregIDCount = count($service_id);
        $flg = 0;

        for ($i = 0; $i < $toregIDCount; $i++) {
            $serv_id = $service_id[$i];
            $serviceDetails = ServiceDetails::find($serv_id);

            if (!empty($serviceDetails) && $serviceDetails->is_approved != 'Y') {
                $serviceDetails->is_approved = 'Y';
                $serviceDetails->approved_by = $userId;
                $serviceDetails->approved_time = $time;
                $serviceDetails->save();
                $flg = 1;
            }
        }

        $msg = $flg ? 'Successfully Approved! Approved id : ' . $serviceid : 'No Services Approved';

        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();

        if ($flg == 1) {
            return response()->json(['result' => 1, 'mesge' => 'Service Successfully Approved']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'No Services Approved']);
        }
    }


    public function approved_service($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $service = ServiceDetails::find($id);

        if (!$service) {
            return redirect()->route('list.service')->with('error', 'Service not found.');
        }
        $attributes = DB::table('add_service_attributes')->where('service_id', $id)->get();
        return view('seller.service.add_services.service_approved', compact('loggeduser', 'userdetails', 'structuredMenu', 'service', 'attributes'));
    }

    public function UpdateServiceApproval(Request $request, $id)
    {
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $request->validate([
            'service_name' => 'required|string|max:255',
            'productapproval' => 'required|in:Y,N,R',
        ]);

        $service = ServiceDetails::find($id);

        if (!$service) {
            return redirect()->route('list.service')->with('error', 'Service not found.');
        }

        $service->service_name = $request->input('service_name');

        if ($request->input('productapproval') === 'Y') {
            $service->is_approved = 'Y';
        } elseif ($request->input('productapproval') === 'N') {
            $service->is_approved = 'N';
        } elseif ($request->input('productapproval') === 'R') {
            $service->is_approved = 'R';
        } else {
            $service->is_approved = 'N';
        }

        $service->save();

        $msg = 'Approved Status = ' . $service->is_approved . ' service approved id : ' . $id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        return redirect()->route('list.service')->with('success', 'Service has been approved.');
    }
}
