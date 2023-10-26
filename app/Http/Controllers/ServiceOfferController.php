<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Models\Offer;
use App\Models\LogDetails;
use App\Models\MenuMaster;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use App\Models\ServiceDetails;

class ServiceOfferController extends Controller
{
    public function list_service_offer()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $service_offer = DB::table('offers')->where('type',2)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('seller.service.offer.list_offer', compact('service_offer', 'loggeduser', 'userdetails','structuredMenu'));
    }

    public function add_service_offer()
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
        return view('seller.service.offer.add_offer', compact('loggeduser', 'userdetails','structuredMenu','userservicedets'));
    }

    public function store_service_offer(Request $request)
    {
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $validator = Validator::make(
            $request->all(),
            [
                'offer_to_display' => 'required|string',
                // 'conditions' => 'required|string|max:255',
                'from_date_time' => 'required|date',
                'to_date_time' => 'required|date',
                'offer_image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'offer_to_display.required' => 'The Display offer field is required',
                // 'conditions.required' => 'The conditions field is required.',
                // 'conditions.string' => 'The conditions field must be a string.',
                // 'conditions.max' => 'The conditions field may not be greater than :max characters.',

            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $service_offer = new Offer;
        $service_offer->type = 2;
        $service_offer->user_id = $request->serviceuser_name;
        $service_offer->offer_to_display = $request->offer_to_display;
        $service_offer->conditions = json_encode($request->car);
        $service_offer->from_date_time = $request->from_date_time;
        $service_offer->to_date_time = $request->to_date_time;
        $upload_path = 'uploads/service_offer/';
        $file_path = $request->file('offer_image');
        if ($file_path != '') {
            if ($file_path->isValid()) {
                $new_name = time() . '_' . $file_path->getClientOriginalName();
                $file_path->move($upload_path, $new_name);
                $service_offer->offer_image = $new_name;
            }
        }
        $service_offer->save();
        $service_offerid = $service_offer->id;
        $msg = 'New Service Successfully added. Service ID is: ' . $service_offerid;
            $LogDetails = new LogDetails();
            $LogDetails->user_id = $userId;
            $LogDetails->ip_address = $loggedUserIp;
            $LogDetails->log_time = $time;
            $LogDetails->status = $msg;
            $LogDetails->save();
        return redirect()->route('list.service_offer')->with('success', 'Service Offer saved successfully');
    }

    public function edit_service_offer(Request $request, $id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $productid = $request->input('productid');
        $ServiceDetails = ServiceDetails::select('service_details.*')
            ->where('service_details.id', $productid)
            ->first();
        $userservicedets = DB::table('user_account')
            ->select('id', 'name')
            ->where('role_id', 9)
            ->get();
        $serviceoffer = Offer::find($id);

        if (!$serviceoffer) {
            return redirect()->route('list.Service_offer')->with('error', 'Service offer not found.');
        }

        return view('seller.service.offer.edit_offer', compact('serviceoffer', 'loggeduser', 'userdetails','structuredMenu','userservicedets','ServiceDetails'));
    }

    public function update_service_offer(Request $request, $id)
    {

        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $serviceoffer = Offer::find($id);
        if (!$serviceoffer) {
            return redirect()->route('list.service_offer')->with('error', 'Service offer not found.');
        }
        $validator = Validator::make($request->all(), [
            'offer_to_display' => 'required|string',
            'car' => 'required|array',
            'from_date_time' => 'required|date',
            'to_date_time' => 'required|date',
            'offer_image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
        $serviceoffer->user_id = $request->serviceuser_name;
        $serviceoffer->offer_to_display = $request->offer_to_display;
        $serviceoffer->conditions = json_encode($request->car);
        $serviceoffer->from_date_time = $request->from_date_time;
        $serviceoffer->to_date_time = $request->to_date_time;
        $upload_path = 'uploads/service_offer/';
        $file_path = $request->file('offer_image');
        if ($file_path != '') {
            if ($file_path->isValid()) {
                $full_file_path = public_path($upload_path . $serviceoffer->offer_image);

                if (file_exists($full_file_path)) {
                    unlink($full_file_path);
                }
                $new_name = time() . '_' . $file_path->getClientOriginalName();
                $file_path->move($upload_path, $new_name);
                $serviceoffer->offer_image = $new_name;
            }
        }
        $serviceoffer->save();
        $msg = 'Service offers successfully Updated. Updated service ID is :  ' . $id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        return redirect()->route('list.service_offer')->with('success', 'Service offer updated successfully.');
    }

    public function delete_service_offer($id)
    {
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $service_offer = Offer::find($id);

        if (!$service_offer) {
            return redirect()->route('list.service_offer')->with('error', 'Service offer not found.');
        }
        $upload_path = 'uploads/Service_offer/';
        $file_path = $service_offer->offer_image;
        $full_file_path = public_path('uploads/service_offer/' . $file_path);
        //dd($full_file_path);
        if (file_exists($full_file_path)) {
            unlink($full_file_path);
        }

        $service_offer->delete();
        $msg = 'Service Offer deleted offer id : ' . $id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        return redirect()->route('list.service_offer')->with('success', 'Service offer deleted successfully.');
    }
}
