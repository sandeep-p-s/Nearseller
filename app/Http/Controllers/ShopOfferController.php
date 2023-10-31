<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Models\Offer;
use App\Models\LogDetails;
use App\Models\MenuMaster;
use App\Models\UserAccount;
use Illuminate\Http\Request;

class ShopOfferController extends Controller
{
    public function list_shop_offer()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = UserAccount::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $shop_offer = DB::table('offers')->where('type', 1)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
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
        return view('seller.offer.list_offer', compact('shop_offer', 'loggeduser', 'userdetails', 'structuredMenu','selrdetails'));
    }

    public function add_shop_offer()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = UserAccount::sessionValuereturn_s($roleid);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $usershopdets = DB::table('user_account')
            ->select('id', 'name')
            ->where('role_id', 2)
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
        return view('seller.offer.add_offer', compact('loggeduser', 'userdetails', 'structuredMenu', 'usershopdets','selrdetails'));
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
        return redirect()->route('list.shop_offer')->with('success', 'Shop Offer saved successfully');
    }

    public function edit_shop_offer($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = UserAccount::sessionValuereturn_s($roleid);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $usershopdets = DB::table('user_account')
            ->select('id', 'name')
            ->where('role_id', 2)
            ->get();
        $shopoffer = Offer::find($id);

        if (!$shopoffer) {
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

        return view('seller.offer.edit_offer', compact('shopoffer', 'loggeduser', 'userdetails', 'structuredMenu', 'usershopdets','selrdetails'));
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
            return redirect()->route('list.shopoffer')->with('error', 'Shop offer not found.');
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
        $shopoffer->save();
        $msg = 'Shop offers successfully Updated. Updated service ID is :  ' . $id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        return redirect()->route('list.shop_offer')->with('success', 'Shop offer updated successfully.');
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
            return redirect()->route('list.shop_offer')->with('error', 'Shop offer not found.');
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
        return redirect()->route('list.shop_offer')->with('success', 'Shop offer deleted successfully.');
    }
}
