<?php

namespace App\Http\Controllers;

use App\Models\ShopOffer;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use DB;
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
        
        $validatedData = $request->validate([
            'offer_to_display' => 'required|string',
            'conditions' => 'required|array',
            'conditions.*' => 'string',
            'from_date_time' => 'required|date',
            'to_date_time' => 'required|date',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $shop_offer = new ShopOffer();
        $shop_offer->offer_to_display = $validatedData['offer_to_display'];
        $shop_offer->conditions = json_encode($validatedData['conditions']);
        $shop_offer->from_date_time = $validatedData['from_date_time'];
        $shop_offer->to_date_time = $validatedData['to_date_time'];

        if ($request->hasFile('offer_image')) {
            $image = $request->file('offer_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $shop_offer->image = $imageName;
        }

        $shop_offer->save();

        return redirect()->route('list.shop_offer')->with('success', 'Shop Offer saved successfully');
    }

    // public function edit_business_type($id)
    // {
    //     $userRole = session('user_role');
    //     $userId = session('user_id');
    //     $loggeduser     = UserAccount::sessionValuereturn($userRole);
    //     $userdetails    = DB::table('user_account')->where('id', $userId)->get();
    //     $businesstype = BusinessType::find($id);

    //     if (!$businesstype) {
    //         return redirect()->route('list.businesstype')->with('error', 'Business Type not found.');
    //     }

    //     return view('admin.business_type.edit', compact('businesstype', 'loggeduser', 'userdetails'));
    // }

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

    // public function delete_business_type($id)
    // {
    //     $businesstype = BusinessType::find($id);

    //     if (!$businesstype) {
    //         return redirect()->route('list.businesstype')->with('error', 'Business Type not found.');
    //     }

    //     $businesstype->delete();

    //     return redirect()->route('list.businesstype')->with('success', 'Business Type deleted successfully.');
    // }
}
