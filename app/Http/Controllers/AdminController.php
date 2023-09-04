<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAccount;
use App\Models\LogDetails;
use App\Models\SellerDetails;
use App\Models\Affiliate;
use App\Models\ServiceType;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Exception;
use DB;
class AdminController extends Controller
{
    function admindashboard()
    {
        $userRole   = session('user_role');
        $userId     = session('user_id');
        if($userId=='')
        {
            return redirect()->route('logout');
        }
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $countUsers     = DB::table('user_account')->where('role_id', 4)->count();
        $countAffiliate = DB::table('user_account')->where('role_id', 3)->count();
        $countShops     = DB::table('user_account')->where('role_id', 2)->count();
        return view('admin.dashboard',compact('userdetails','countUsers','countAffiliate','countShops','userRole','loggeduser'));
    }

    function ShopApproval()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if($userId==''){return redirect()->route('logout');}
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        return view('admin.shop_approval',compact('userdetails','userRole','loggeduser'));
    }

    function AllShopsList(Request $request)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if($userId==''){
            return redirect()->route('logout');
        }
        $emal_mob   = $request->input('emal_mob');
        $shopname   = $request->input('shopname');
        $ownername  = $request->input('ownername');
        $referalid  = $request->input('referalid');
        $query = SellerDetails::select('seller_details.*','business_type.business_name','service_types.service_name','executives.executive_name','country.country_name','state.state_name','district.district_name')
        ->leftJoin('business_type', 'business_type.id', 'seller_details.busnes_type')
        ->leftJoin('service_types', 'service_types.id', 'seller_details.shop_service_type')
        ->leftJoin('executives', 'executives.id', 'seller_details.shop_executive')
        ->leftJoin('country', 'country.id', 'seller_details.country')
        ->leftJoin('state', 'state.id', 'seller_details.state')
        ->leftJoin('district', 'district.id', 'seller_details.district');
        if ($emal_mob) {
            $query->where('shop_email', 'LIKE', '%' . $emal_mob . '%')
                ->orWhere('shop_mobno', 'LIKE', '%' . $emal_mob . '%');
        }
        if ($shopname) {
            $query->where('seller_details.shop_name', 'LIKE', '%' . $shopname . '%');
        }
        if ($ownername) {
            $query->where('seller_details.owner_name', 'LIKE', '%' . $ownername . '%');
        }
        if ($referalid) {
            $query->where('seller_details.referal_id', $referalid);
        }
        $sellerDetails = $query->get();
        //echo $lastRegId = $query->toSql();exit;
        $sellerCount = $sellerDetails->count();
        return view('admin.shop_dets', compact('sellerDetails', 'sellerCount'));
    }



}
