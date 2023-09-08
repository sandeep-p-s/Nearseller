<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccount;
use App\Models\LogDetails;
use App\Models\Affiliate;
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
        return view('affiliate.dashboard',compact('userdetails','countAffiliate','countShops','userRole','loggeduser'));
    }


    function AffiliateAddNew()
        {
            $userRole = session('user_role');
            $userId = session('user_id');
            if($userId==''){return redirect()->route('logout');}
            $loggeduser     = UserAccount::sessionValuereturn($userRole);
            $userdetails    = DB::table('user_account')->where('id', $userId)->get();
            return view('affiliate.affilate_list',compact('userdetails','userRole','loggeduser'));
        }


    function AllAffiliatesList(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if($userId==''){
            return redirect()->route('logout');
        }
        $emal_mob   = $request->input('emal_mob');
        $afflitename   = $request->input('afflitename');
        $Affte_perant = DB::table('user_account')->select('id')->where('parent_id', $userId)->get();
        $parentafiltids = $Affte_perant->pluck('id')->toArray();
        $concatenatedIds = implode(',', $parentafiltids);
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
        $query->whereIn('affiliate.user_id', explode(',', $concatenatedIds));
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




}
