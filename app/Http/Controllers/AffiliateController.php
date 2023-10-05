<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccount;
use App\Models\LogDetails;
use App\Models\Affiliate;
use App\Models\SellerDetails;
use App\Models\MenuMaster;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Exception;
use DB;
class AffiliateController extends Controller
{
    public function affiliatedashboard()
    {
        $userRole   = session('user_role');
        $userId     = session('user_id');
        if($userId=='')
        {
            return redirect()->route('logout');
        }
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $countAffiliate = DB::table('user_account')->where('role_id', 3)->where('parent_id', $userId)->count();
        $countShops     = DB::table('user_account')->where('role_id', 2)->where('parent_id', $userId)->count();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('affiliate.dashboard',compact('userdetails','countAffiliate','countShops','userRole','loggeduser','structuredMenu'));
    }


    function AffiliatesList(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if($userId==''){
            return redirect()->route('logout');
        }
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('affiliate.affilate_list', compact('userdetails','loggeduser','structuredMenu'));
    }

    function ViewAffiliatesList(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if($userId==''){
            return redirect()->route('logout');
        }
        $emal_mob   = $request->input('emal_mob');
        $afflitename   = $request->input('afflitename');
        // $Affte_perant = DB::table('user_account')->select('id')->where('parent_id', $userId)->get();
        // $parentafiltids = $Affte_perant->pluck('id')->toArray();
        // $concatenatedIds = implode(',', $parentafiltids);
        $query = Affiliate::select('affiliate.*','professions.profession_name','marital_statuses.mr_name','religions.religion_name','country.country_name','state.state_name','district.district_name','bank_types.bank_name')
        ->leftJoin('professions', 'professions.id', 'affiliate.profession')
        ->leftJoin('marital_statuses', 'marital_statuses.id', 'affiliate.marital_status')
        ->leftJoin('religions', 'religions.id', 'affiliate.religion')
        ->leftJoin('country', 'country.id', 'affiliate.country')
        ->leftJoin('state', 'state.id', 'affiliate.state')
        ->leftJoin('district', 'district.id', 'affiliate.district')
         ->leftJoin('bank_types', 'bank_types.id', 'affiliate.bank_type')
        ->leftJoin('bank_details', 'bank_details.id', 'affiliate.branch_code');
        if ($emal_mob) {
            $query->where('affiliate.email', 'LIKE', '%' . $emal_mob . '%')
                ->orWhere('affiliate.mob_no', 'LIKE', '%' . $emal_mob . '%');
        }
        if ($afflitename) {
            $query->where('affiliate.name', 'LIKE', '%' . $afflitename . '%');
        }
        //$query->whereIn('affiliate.user_id', explode(',', $concatenatedIds));
        $query->where('affiliate.parent_id', $userId);
        $AffiliateDetails = $query->get();
        //echo $lastRegId = $query->toSql();exit;
        $AffiliateCount    = $AffiliateDetails->count();
        $countries      = DB::table('country')->get();
        $professions    = DB::table('professions')->where('status','Y')->get();
        $matstatus      = DB::table('marital_statuses')->where('status','Y')->get();
        $religions      = DB::table('religions')->where(['status' => 'Y'])->get();
        $bank_types     = DB::table('bank_types')->where(['status' => 'Y'])->get();
        return view('affiliate.affiliate_dets', compact('AffiliateDetails', 'AffiliateCount','countries','professions','matstatus','religions','bank_types'));
    }


    function ViewAffiliatesShopList($typeid)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if($userId==''){
            return redirect()->route('logout');
        }
        if($typeid==1){$shoporservice='Shops';
        }
        else  if($typeid==2){$shoporservice='Services';
        }
        else{
            return redirect()->route('logout');
        }
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('affiliate.shop_list', compact('loggeduser','userdetails','shoporservice','typeid','structuredMenu'));
    }

    function AllAffiliatesShopList(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if($userId==''){
            return redirect()->route('logout');
        }
        $emal_mob   = $request->input('emal_mob');
        $shopname   = $request->input('shopname');
        $ownername  = $request->input('ownername');
        $typeid     = $request->input('typeid');
        if($roleid==3)
            {
                $Affiliatereferal_id = DB::table('user_account')->select('referal_id')->where('id', $userId)->get();
                //echo $lastRegId = $sellerDetail->toSql();exit;
                foreach($Affiliatereferal_id as $refrlid)
                {
                    $referal_id=$refrlid->referal_id;
                }
            }
            else{
                $referal_id='';
            }


        $query = SellerDetails::select('seller_details.*','business_type.business_name','service_types.service_name','executives.executive_name','country.country_name','state.state_name','district.district_name')
        ->leftJoin('business_type', 'business_type.id', 'seller_details.busnes_type')
        ->leftJoin('service_types', 'service_types.id', 'seller_details.shop_service_type')
        ->leftJoin('executives', 'executives.id', 'seller_details.shop_executive')
        ->leftJoin('country', 'country.id', 'seller_details.country')
        ->leftJoin('state', 'state.id', 'seller_details.state')
        ->leftJoin('district', 'district.id', 'seller_details.district');
        $query->where('seller_details.parent_id', $userId);
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
        if ($referal_id) {
            $query->where('seller_details.referal_id', $referal_id);
        }
        if($roleid==2)
        {
            $query->where('seller_details.user_id', $userId);
        }
        $query->where('seller_details.shop_service_type',$typeid);
        $sellerDetails = $query->get();
        //echo $lastRegId = $query->toSql();exit;
        $sellerCount = $sellerDetails->count();
        if($typeid==1){$shoporservice='Shops';
        }
        else  if($typeid==2){$shoporservice='Services';
        }
        $countries      = DB::table('country')->get();
        $business       = DB::table('business_type')->where('status','Y')->get();
        $shopservice    = DB::table('service_types')->where('status','active')->get();
        $executives     = DB::table('executives')->where(['executive_type' => 1, 'status' => 'Y'])->get();
        $shoptypes      = DB::table('shop_type')->where('status','Y')->get();
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        return view('affiliate.shop_dets', compact('sellerDetails', 'sellerCount','countries','business','shopservice','executives','loggeduser','userdetails','referal_id','shoptypes','shoporservice','typeid'));
    }








}
