<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Models\Offer;
use App\Models\LogDetails;
use App\Models\MenuMaster;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ServiceDetails;

class OfferController extends Controller
{

    public function list_offer()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $shop_offer = DB::table('offers')->get();
        $active_offers = DB::table('offers as o')->where('o.status', 'Y')->count();
        $inactive_offers = DB::table('offers as o')->where('o.status', 'N')->count();
        $approved_offers = DB::table('offers as o')->where('o.status', 'Y')->count();
        $notapproved_offers = DB::table('offers as o')->where('o.status', 'N')->count();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $roleIdsArray = explode(',', $roleid);
        if ((in_array('2', $roleIdsArray)) || (in_array('9', $roleIdsArray))) {
            $selrdetails = DB::table('seller_details')->select('busnes_type', 'term_condition')
                ->where('user_id', $userId)
                ->first();
        } else {
            $selrdetails = '';
        }
        return view('seller.offer.list_offer', compact('shop_offer', 'loggeduser', 'userdetails', 'structuredMenu', 'selrdetails', 'active_offers', 'inactive_offers', 'approved_offers', 'notapproved_offers'));
    }
    //Shop Offer
    public function list_shop_offer()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $shop_offer = DB::table('offers')->where('type', 1)->get();
        $active_offers = DB::table('offers as o')->where('o.status', 'Y')->where('o.type', '1')->count();
        $inactive_offers = DB::table('offers as o')->where('o.status', 'N')->where('o.type', '1')->count();
        $approved_offers = DB::table('offers as o')->where('o.approval_status', 'Y')->where('o.type', '1')->count();
        $notapproved_offers = DB::table('offers as o')->where('o.approval_status', 'N')->where('o.type', '1')->count();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $roleIdsArray = explode(',', $roleid);
        if ((in_array('2', $roleIdsArray)) || (in_array('9', $roleIdsArray))) {
            $selrdetails = DB::table('seller_details')->select('busnes_type', 'term_condition')
                ->where('user_id', $userId)
                ->first();
        } else {
            $selrdetails = '';
        }
        return view('seller.offer.list_offer', compact('shop_offer', 'loggeduser', 'userdetails', 'structuredMenu', 'selrdetails', 'active_offers', 'inactive_offers', 'approved_offers', 'notapproved_offers'));
    }

    public function add_shop_offer()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        // $usershopdets = DB::table('users')
        //     ->select('id', 'name')
        //     ->where('role_id', 2)
        //     ->get();
        $usershopdets = DB::select("SELECT id,name FROM users WHERE FIND_IN_SET('2', role_id)");

        $roleIdsArray = explode(',', $roleid);
        if ((in_array('2', $roleIdsArray)) || (in_array('9', $roleIdsArray))) {
            $selrdetails = DB::table('seller_details')->select('busnes_type', 'term_condition')
                ->where('user_id', $userId)
                ->first();
        } else {
            $selrdetails = '';
        }
        return view('seller.offer.add_offer', compact('loggeduser', 'userdetails', 'structuredMenu', 'usershopdets', 'selrdetails'));
    }

    public function store_shop_offer(Request $request)
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
                'offer_to_display' => 'required|string|unique:offers',
                // 'conditions' => 'required|string|max:255',
                'from_date_time' => 'required|date',
                'to_date_time' => 'required|date',
                'offer_image' => 'required|mimes:jpeg,png,jpg|max:2048',
                // 'serviceuser_name' => 'required'
            ],
            [
                'offer_to_display.required' => 'The Display offer field is required',
                // 'serviceuser_name.required' => 'Please select Service user in the list',
                'offer_to_display.unique' => 'This Offer name is already in use.',
                // 'conditions.required' => 'The conditions field is required.',
                // 'conditions.string' => 'The conditions field must be a string.',
                // 'conditions.max' => 'The conditions field may not be greater than :max characters.',

            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $shop_offer = new Offer;
        $shop_offer->user_id = $request->shopeuser_name;
        $shop_offer->type = 1;
        $shop_offer->offer_to_display = $request->offer_to_display;
        $shop_offer->conditions = json_encode($request->car);
        $shop_offer->from_date_time = $request->from_date_time;
        $shop_offer->to_date_time = $request->to_date_time;
        $upload_path = 'uploads/shop_offer/';
        $file_path = $request->file('offer_image');
        if ($file_path != '') {
            if ($file_path->isValid()) {
                $new_name = time() . '_' . $file_path->getClientOriginalName();
                $file_path->move($upload_path, $new_name);
                $shop_offer->offer_image = $new_name;
            }
        }
        $shop_offer->save();
        $shop_offerid = $shop_offer->id;
        $msg = 'New Service Successfully added. Service ID is: ' . $shop_offerid;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        return redirect()->route('addlist.shop_offer')->with('success', 'Shop Offer saved successfully');
    }

    public function edit_shop_offer($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $usershopdets = DB::table('users')
            ->select('id', 'name')
            ->where('role_id', 2)
            ->get();
        $shopoffer = Offer::find($id);

        if (!$shopoffer) {
            return redirect()->route('list.shop_offer')->with('error', 'Seller offer not found.');
        }
        $roleIdsArray = explode(',', $roleid);
        if ((in_array('2', $roleIdsArray)) || (in_array('9', $roleIdsArray))) {
            $selrdetails = DB::table('seller_details')->select('busnes_type', 'term_condition')
                ->where('user_id', $userId)
                ->first();
        } else {
            $selrdetails = '';
        }

        return view('seller.offer.edit_offer', compact('shopoffer', 'loggeduser', 'userdetails', 'structuredMenu', 'usershopdets', 'selrdetails'));
    }

    public function update_shop_offer(Request $request, $id)
    {
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $shopoffer = Offer::find($id);
        if (!$shopoffer) {
            return redirect()->route('list.shopoffer')->with('error', 'Seller offer not found.');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'offer_to_display' => 'required|string',
                'conditions' => 'required|string|max:255',
                'from_date_time' => 'required|date',
                'to_date_time' => 'required|date',
                'offer_image' => 'required|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'offer_to_display.required' => 'The Display offer field is required',
                'conditions.required' => 'The conditions field is required.',
                'conditions.string' => 'The conditions field must be a string.',
                'conditions.max' => 'The conditions field may not be greater than :max characters.',

            ]
        );
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
        $shopoffer->user_id = $request->shopeuser_name;
        $shopoffer->offer_to_display = $request->offer_to_display;
        $shopoffer->conditions = json_encode($request->car);
        $shopoffer->from_date_time = $request->from_date_time;
        $shopoffer->to_date_time = $request->to_date_time;
        $upload_path = 'uploads/shop_offer/';
        $file_path = $request->file('offer_image');
        if ($file_path != '') {
            if ($file_path->isValid()) {
                $full_file_path = public_path($upload_path . $shopoffer->offer_image);

                if (file_exists($full_file_path)) {
                    unlink($full_file_path);
                }
                $new_name = time() . '_' . $file_path->getClientOriginalName();
                $file_path->move($upload_path, $new_name);
                $shopoffer->offer_image = $new_name;
            }
        }
        if ($request->status === 'Active') {
            $shopoffer->status = 'Y';
        } else {
            $shopoffer->status = 'N';
        }
        $shopoffer->save();
        $msg = 'Shop offers successfully Updated. Updated service ID is :  ' . $id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        return redirect()->route('addlist.shop_offer')->with('success', 'Seller offer updated successfully.');
    }

    public function delete_shop_offer($id)
    {
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $shopoffer = Offer::find($id);

        if (!$shopoffer) {
            return redirect()->route('list.shop_offer')->with('error', 'Seller offer not found.');
        }
        $upload_path = 'uploads/shop_offer/';
        $file_path = $shopoffer->offer_image;
        $full_file_path = public_path('uploads/shop_offer/' . $file_path);
        //dd($full_file_path);
        if (file_exists($full_file_path)) {
            unlink($full_file_path);
        }

        $shopoffer->delete();
        $msg = 'Shop Offer deleted offer id : ' . $id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        return redirect()->route('list.shop_offer')->with('success', 'Seller offer deleted successfully.');
    }
    public function approved_shopoffer($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $usershopdets = DB::table('users')
            ->select('id', 'name')
            ->where('role_id', 2)
            ->get();
        $shopoffer = Offer::find($id);

        if (!$shopoffer) {
            return redirect()->route('list.shop_offer')->with('error', 'Seller offer not found.');
        }
        $roleIdsArray = explode(',', $roleid);
        if ((in_array('2', $roleIdsArray)) || (in_array('9', $roleIdsArray))) {
            $selrdetails = DB::table('seller_details')->select('busnes_type', 'term_condition')
                ->where('user_id', $userId)
                ->first();
        } else {
            $selrdetails = '';
        }

        return view('seller.offer.approved_shopoffer', compact('shopoffer', 'loggeduser', 'userdetails', 'structuredMenu', 'usershopdets', 'selrdetails'));
    }
    public function approvedstatus_shopoffer(Request $request, $id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $time = date('Y-m-d H:i:s');
        $shopoffer = Offer::find($id);
        if (!$shopoffer) {
            return redirect()->route('list.shopoffer')->with('error', 'Seller offer not found.');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'offer_to_display' => 'required|string',
                'conditions' => 'required|string|max:255',
                'from_date_time' => 'required|date',
                'to_date_time' => 'required|date',
                'offer_image' => 'required|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'offer_to_display.required' => 'The Display offer field is required',
                'conditions.required' => 'The conditions field is required.',
                'conditions.string' => 'The conditions field must be a string.',
                'conditions.max' => 'The conditions field may not be greater than :max characters.',

            ]
        );
        if ($request->status === 'Active') {
            $shopoffer->status = 'Y';
        } else {
            $shopoffer->status = 'N';
        }
        $shopoffer->approval_status = $request->shopofferapproved;
        $shopoffer->approved_by = $userId;
        $shopoffer->approved_time = $time;
        $shopoffer->save();

        if ($request->shopofferapproved == 'Y') {
            $appstatus = 'Shop Offer Successfully Approved';
        } else {
            $appstatus = 'Shop Offer Not Approved';
        }


        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $msg = 'Shop Offer Successfully Approved. Approved Category id is ' . $id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $request->es_email;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        return redirect()->route('list.shop_offer')->with('success', $appstatus);
    }
    public function AdmShopOfferApprovedAll(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $shopofferid = $request->input('shopofferid');
        $shopofferid_id = explode('#', $shopofferid);
        //echo "<pre>";print_r($categoryid_id);exit;
        $toregIDCount = count($shopofferid_id);
        $flg = 0;
        for ($i = 1; $i < $toregIDCount; $i++) {
            $shopofferid = $shopofferid_id[$i];
            // $categoryuser=explode('*',$shopofferidexplode);
            // $shopofferid=$categoryuser[0];
            $shopoffer = Offer::find($shopofferid);
            if ($shopoffer->approval_status == 'R') {
            } else {
                $shopoffer->approval_status = 'Y';
                $shopoffer->approved_by = $userId;
                $shopoffer->approved_time = $time;
                $shopoffer->save();
                $flg = 1;
            }
        }

        $msg = 'Shop Offer Successfully Approved';
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();

        if ($flg == 1) {
            return response()->json(['result' => 1, 'mesge' => 'Seller Offer Successfully Approved']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Not Approved']);
        }
    }


    //Service offer
    public function list_service_offer()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $service_offer = DB::table('offers')->where('type', 2)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $active_offers = DB::table('offers as o')->where('o.status', 'Y')->where('o.type', '2')->count();
        $inactive_offers = DB::table('offers as o')->where('o.status', 'N')->where('o.type', '2')->count();
        $approved_offers = DB::table('offers as o')->where('o.approval_status', 'Y')->where('o.type', '2')->count();
        $notapproved_offers = DB::table('offers as o')->where('o.approval_status', 'N')->where('o.type', '2')->count();
        $roleIdsArray = explode(',', $roleid);
        if ((in_array('2', $roleIdsArray)) || (in_array('9', $roleIdsArray))) {
            $selrdetails = DB::table('seller_details')->select('busnes_type', 'term_condition')
                ->where('user_id', $userId)
                ->first();
        } else {
            $selrdetails = '';
        }
        return view('seller.service.offer.list_offer', compact('service_offer', 'loggeduser', 'userdetails', 'structuredMenu', 'selrdetails', 'active_offers', 'inactive_offers', 'approved_offers', 'notapproved_offers'));
    }

    public function add_service_offer()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        // $userservicedets = DB::table('users')
        //     ->select('id', 'name')
        //     ->where('role_id', 9)
        //     ->get();
        $userservicedets = DB::select("SELECT id,name FROM users WHERE FIND_IN_SET('9', role_id)");

        $roleIdsArray = explode(',', $roleid);
        if ((in_array('2', $roleIdsArray)) || (in_array('9', $roleIdsArray))) {
            $selrdetails = DB::table('seller_details')->select('busnes_type', 'term_condition')
                ->where('user_id', $userId)
                ->first();
        } else {
            $selrdetails = '';
        }
        return view('seller.service.offer.add_offer', compact('loggeduser', 'userdetails', 'structuredMenu', 'userservicedets', 'selrdetails'));
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
                'offer_to_display' => 'required|string|unique:offers',
                // 'conditions' => 'required|string|max:255',
                'from_date_time' => 'required|date',
                'to_date_time' => 'required|date',
                'offer_image' => 'required|mimes:jpeg,png,jpg|max:2048',
                'serviceuser_name' => 'required'
            ],
            [
                'offer_to_display.required' => 'The Display offer field is required',
                'serviceuser_name.required' => 'Please select Service user in the list',
                'offer_to_display.unique' => 'This Offer name is already in use.',
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
        return redirect()->route('addlist.service_offer')->with('success', 'Service Offer saved successfully');
    }

    public function edit_service_offer(Request $request, $id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $productid = $request->input('productid');
        $ServiceDetails = ServiceDetails::select('service_details.*')
            ->where('service_details.id', $productid)
            ->first();
        $userservicedets = DB::table('users')
            ->select('id', 'name')
            ->where('role_id', 9)
            ->get();
        $serviceoffer = Offer::find($id);

        if (!$serviceoffer) {
            return redirect()->route('list.Service_offer')->with('error', 'Service offer not found.');
        }
        $roleIdsArray = explode(',', $roleid);
        if ((in_array('2', $roleIdsArray)) || (in_array('9', $roleIdsArray))) {
            $selrdetails = DB::table('seller_details')->select('busnes_type', 'term_condition')
                ->where('user_id', $userId)
                ->first();
        } else {
            $selrdetails = '';
        }

        return view('seller.service.offer.edit_offer', compact('serviceoffer', 'loggeduser', 'userdetails', 'structuredMenu', 'userservicedets', 'ServiceDetails', 'selrdetails'));
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
        if ($request->status === 'Active') {
            $serviceoffer->status = 'Y';
        } else {
            $serviceoffer->status = 'N';
        }
        $serviceoffer->save();
        $msg = 'Service offers successfully Updated. Updated service ID is :  ' . $id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        return redirect()->route('addlist.service_offer')->with('success', 'Service offer updated successfully.');
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
    public function approved_serviceoffer($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $userservicedets = DB::table('users')
            ->select('id', 'name')
            ->where('role_id', 9)
            ->get();
        $serviceoffer = Offer::find($id);

        if (!$serviceoffer) {
            return redirect()->route('list.Service_offer')->with('error', 'Service offer not found.');
        }
        $roleIdsArray = explode(',', $roleid);
        if ((in_array('2', $roleIdsArray)) || (in_array('9', $roleIdsArray))) {
            $selrdetails = DB::table('seller_details')->select('busnes_type', 'term_condition')
                ->where('user_id', $userId)
                ->first();
        } else {
            $selrdetails = '';
        }

        return view('seller.service.offer.approved_serviceoffer', compact('serviceoffer', 'loggeduser', 'userdetails', 'structuredMenu', 'userservicedets', 'selrdetails'));
    }
    public function approvedstatus_service(Request $request, $id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $time = date('Y-m-d H:i:s');
        $serviceoffer = Offer::find($id);

        if (!$serviceoffer) {
            return redirect()->route('list.Service_offer')->with('error', 'Service offer not found.');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'offer_to_display' => 'required|string',
                'conditions' => 'required|string|max:255',
                'from_date_time' => 'required|date',
                'to_date_time' => 'required|date',
                'offer_image' => 'required|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'offer_to_display.required' => 'The Display offer field is required',
                'conditions.required' => 'The conditions field is required.',
                'conditions.string' => 'The conditions field must be a string.',
                'conditions.max' => 'The conditions field may not be greater than :max characters.',

            ]
        );
        $serviceoffer->approval_status = $request->serviceofferapproved;
        $serviceoffer->approved_by = $userId;
        $serviceoffer->approved_time = $time;
        $serviceoffer->save();

        if ($request->serviceofferapproved == 'Y') {
            $appstatus = 'Service Offer Successfully Approved';
        } else {
            $appstatus = 'Service Offer Not Approved';
        }


        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $msg = 'Service Offer Successfully Approved. Approved Category id is ' . $id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $request->es_email;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        return redirect()->route('list.service_offer')->with('success', $appstatus);
    }
    public function AdmServiceOfferApprovedAll(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $serviceofferid = $request->input('serviceofferid');
        $serviceofferid_id = explode('#', $serviceofferid);
        //echo "<pre>";print_r($categoryid_id);exit;
        $toregIDCount = count($serviceofferid_id);
        $flg = 0;
        for ($i = 1; $i < $toregIDCount; $i++) {
            $serviceofferid = $serviceofferid_id[$i];
            // $categoryuser=explode('*',$shopofferidexplode);
            // $shopofferid=$categoryuser[0];
            $serviceoffer = Offer::find($serviceofferid);
            if ($serviceoffer->approval_status == 'R') {
            } else {
                $serviceoffer->approval_status = 'Y';
                $serviceoffer->approved_by = $userId;
                $serviceoffer->approved_time = $time;
                $serviceoffer->save();
                $flg = 1;
            }
        }

        $msg = 'Service Offer Successfully Approved';
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();

        if ($flg == 1) {
            return response()->json(['result' => 1, 'mesge' => 'Service Offer Successfully Approved']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Not Approved']);
        }
    }
}
