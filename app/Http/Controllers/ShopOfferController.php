<?php

namespace App\Http\Controllers;

use App\Models\ShopOffer;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use DB;
use Validator;
use Illuminate\Support\Facades\Storage;
class ShopOfferController extends Controller
{
    public function list_shop_offer()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $shop_offer = DB::table('shop_offers')->get();
        return view('seller.offer.list_offer', compact('shop_offer', 'loggeduser', 'userdetails'));
    }

    public function add_shop_offer()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        return view('seller.offer.add_offer', compact('loggeduser', 'userdetails'));
    }

    public function store_shop_offer(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'offer_to_display' => 'required|string',
            'car' => 'required|array',
            'from_date_time' => 'required|date',
            'to_date_time' => 'required|date',
            'offer_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $shop_offer = new ShopOffer;

        $shop_offer->offer_to_display = $request->offer_to_display;
        $shop_offer->conditions = json_encode($request->car);
        $shop_offer->from_date_time = $request->from_date_time;
        $shop_offer->to_date_time = $request->to_date_time;
        $upload_path = 'uploads/shop_offer/';
        $file_path = $request->file('offer_image');
        if($file_path!='')
        {
            if ($file_path->isValid()) {
            $new_name = time() . '_' . $file_path->getClientOriginalName();
            $file_path->move($upload_path, $new_name);
            $shop_offer->offer_image = $new_name;
            }
        }
        $shop_offer->save();
        return redirect()->route('list.shop_offer')->with('success', 'Shop Offer saved successfully');
    }

    public function edit_shop_offer($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $shopoffer = ShopOffer::find($id);

        if (!$shopoffer) {
            return redirect()->route('list.shop_offer')->with('error', 'Shop offer not found.');
        }

        return view('seller.offer.edit_offer', compact('shopoffer', 'loggeduser', 'userdetails'));
    }

    // public function update_business_type(Request $request, $id)
    // {
    //     $businesstype = BusinessType::find($id);
    //     if (!$businesstype) {
    //         return redirect()->route('list.businesstype')->with('error', 'Business Type not found.');
    //     }

    //     $request->validate([
    //         'business_name' => 'required|string|max:255',
    //         'status' => 'required|in:Active,Inactive',
    //     ]);

    //     $businesstype->business_name = $request->business_name;
    //     if ($request->status === 'Active')
    //     {
    //         $businesstype->status = 'Y';
    //     } else {
    //         $businesstype->status = 'N';
    //     }
    //     $businesstype->save();

    //     return redirect()->route('list.businesstype')->with('success', 'Business Type updated successfully.');
    // }

    public function delete_shop_offer($id)
    {
        $shopoffer = ShopOffer::find($id);

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

        return redirect()->route('list.shop_offer')->with('success', 'Shop offer deleted successfully.');
    }
}
