<?php

namespace App\Http\Controllers;

use DB;
use Validator;
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
                'add_service_attributes.attribute_1',
                'add_service_attributes.attribute_2',
                'add_service_attributes.offer_price',
                'add_service_attributes.mrp_price'
            )
            ->get();
        return view('seller.service.add_services.list_service', compact('services', 'loggeduser', 'userdetails', 'structuredMenu'));
    }
    public function add_service()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('seller.service.add_services.add_service', compact('loggeduser', 'userdetails', 'structuredMenu'));
    }
    public function store_service(Request $request)
    {
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
        //dd($isAttribute);
        $service = new ServiceDetails;
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
        $service->save();
        if ($isAttribute === 'Y' && $request->has('car')) {
            foreach ($request->input('car') as $attributes) {
                $addServiceAttribute = new AddServiceAttribute;
                $addServiceAttribute->service_id = $service->id;
                $addServiceAttribute->attribute_1 = $attributes['attribute1'];
                $addServiceAttribute->attribute_2 = $attributes['attribute2'];
                $addServiceAttribute->attribute_3 = $attributes['attribute3'];
                $addServiceAttribute->attribute_4 = $attributes['attribute4'];
                $addServiceAttribute->offer_price = $attributes['offerprice'];
                $addServiceAttribute->mrp_price = $attributes['mrp'];
                $addServiceAttribute->call_shop = $attributes['callshop'];
                $addServiceAttribute->save();
            }
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
        $attributes = AddServiceAttribute::where('service_id', $id)->get();
        return view('seller.service.add_services.edit_service', compact('loggeduser', 'userdetails', 'structuredMenu', 'service', 'attributes'));
    }

    // public function update_service(Request $request, $id)
    // {
    //     $service = ServiceDetails::find($id);

    //     if (!$service) {
    //         return redirect()->route('list.service')->with('error', 'Service not found.');
    //     }

    //     $validator = Validator::make($request->all(), [
    //         'service_name' => 'required|string|max:255',
    //         'service_images' => 'required|mimes:jpeg,png,jpg,gif|max:2048',

    //     ]);
    //     $messages = [
    //         'service_name.required' => 'Service name field is required',
    //         'service_images.required' => 'Please upload an image',
    //     ];
    //     $validator->setCustomMessages($messages);


    //     $isAttribute = $request->input('customRadio') === 'on' ? 'Y' : 'N';
    //     $service = new ServiceDetails;
    //     $service->service_name = $request->service_name;
    //     $upload_path = 'uploads/service_images/';
    //     $file_path = $request->file('service_images');
    //     if ($file_path && $file_path->isValid()) {
    //         $full_file_path = public_path($upload_path . $service->service_images);

    //         if (file_exists($full_file_path)) {
    //             unlink($full_file_path);
    //         }
    //         $new_name = time() . '_' . $file_path->getClientOriginalName();
    //         $file_path->move($upload_path, $new_name);
    //         $service->service_images = $new_name;
    //     }
    //     $service->is_attribute = $isAttribute;
    //     $service->save();
    //     if ($isAttribute === 'Y') {
    //         if ($request->has('car')) {
    //             foreach ($request->input('car') as $attributes) {
    //                 $addServiceAttribute = new AddServiceAttribute;
    //                 $addServiceAttribute->service_id = $service->id;
    //                 $addServiceAttribute->attribute_1 = $attributes['attribute1'];
    //                 $addServiceAttribute->attribute_2 = $attributes['attribute2'];
    //                 $addServiceAttribute->attribute_3 = $attributes['attribute3'];
    //                 $addServiceAttribute->attribute_4 = $attributes['attribute4'];
    //                 $addServiceAttribute->offer_price = $attributes['offerprice'];
    //                 $addServiceAttribute->mrp_price = $attributes['mrp'];
    //                 $addServiceAttribute->call_shop = $attributes['callshop'];
    //                 $addServiceAttribute->save();
    //             }
    //         }
    //     }
    //     return redirect()->route('list.service')->with('success', 'Service details updated successfully');
    // }
    public function update_service(Request $request, $id)
    {
        $service = ServiceDetails::find($id);

        if (!$service) {
            return redirect()->route('list.service')->with('error', 'Service not found.');
        }

        $validator = Validator::make($request->all(), [
            'service_name' => 'required|string|max:255',
            'service_images' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $messages = [
            'service_name.required' => 'Service name field is required',
        ];

        $validator->setCustomMessages($messages);

        $isAttribute = $request->input('customRadio') === 'on' ? 'Y' : 'N';

        $service->service_name = $request->service_name;

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

        $service->is_attribute = $isAttribute;
        $service->save();

        if ($isAttribute === 'Y' && $request->has('car')) {
            AddServiceAttribute::where('service_id', $service->id)->delete();
            foreach ($request->input('car') as $attributes) {
                $addServiceAttribute = new AddServiceAttribute;
                $addServiceAttribute->service_id = $service->id;
                $addServiceAttribute->attribute_1 = $attributes['attribute1'];
                $addServiceAttribute->attribute_2 = $attributes['attribute2'];
                $addServiceAttribute->attribute_3 = $attributes['attribute3'];
                $addServiceAttribute->attribute_4 = $attributes['attribute4'];
                $addServiceAttribute->offer_price = $attributes['offerprice'];
                $addServiceAttribute->mrp_price = $attributes['mrp'];
                $addServiceAttribute->call_shop = $attributes['callshop'];
                $addServiceAttribute->save();
            }
        }

        return redirect()->route('list.service')->with('success', 'Service details updated successfully');
    }

    public function delete_service($id)
    {
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

        return redirect()->route('list.service')->with('success', 'Service and its attributes deleted successfully.');
    }
}
