<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Models\Role;
use App\Models\UserAccount;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\RolePermission;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use App\Models\LogDetails;
use App\Models\SellerDetails;
use App\Models\Affiliate;
use App\Models\ServiceType;
use App\Models\MenuMaster;
use App\Models\UserPage;
use App\Models\RolePage;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Exception;

class CustomerController extends Controller
{

    function CustomerApproval($typeid)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggeduser = UserAccount::sessionValuereturn_s($roleid);
        $userdetails = DB::table('user_account')
            ->where('id', $userId)
            ->get();
        $alluserdetails = DB::table('user_account')
            ->select('user_account.id', 'user_account.name', 'user_account.email', 'user_account.mobno', 'user_account.user_status', 'roles.role_name')
            ->join('roles', 'user_account.role_id', '=', 'roles.id')
            ->where('roles.is_active', '1')
            ->get();
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
        return view('custapproval.cust_user', compact('userdetails', 'userRole', 'loggeduser', 'alluserdetails', 'structuredMenu','selrdetails'));
    }

    function AllCustomerList(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $emal_mob = $request->input('emal_mob');
        $uname = $request->input('uname');
        $query = UserAccount::select('user_account.*', 'roles.role_name')->leftJoin('roles', 'user_account.role_id', 'roles.id')->where('roles.is_active', '1')->where('roles.id', '4');
        $query ->orderBy('user_account.name', 'asc');
        $alluserdetails = $query->get();
        //echo $lastRegId = $query->toSql();exit;
        $allusercount = $alluserdetails->count();
        $roles = DB::table('roles')->where('roles.is_active', '1')->where('id', '!=', 1) ->orderBy('role_name', 'asc')->get();
        return view('custapproval.user_dets', compact('alluserdetails', 'allusercount', 'roles'));
    }

    function AdmCustomerViewEdit(Request $request)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $id = $request->input('userid');
        $query = UserAccount::select('user_account.*', 'roles.role_name')
            ->leftJoin('roles', 'user_account.role_id', 'roles.id')->where('roles.is_active', '1')
            ->where('user_account.id', $id);
        $alluserdetails = $query->first();
        //echo $lastRegId = $query->toSql();exit;
        $roles = DB::table('roles')
            ->where('id', $alluserdetails->role_id)->where('roles.is_active', '1')
            ->get();
        return view('custapproval.user_viewedit', compact('alluserdetails', 'roles'));
    }

    function AdmUpdateCustomerDetails(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $validatedData = $request->validate([
            'userstatus' => 'required',
        ]);
        $useridhid = $request->useridhid;
        $user = UserAccount::findOrFail($useridhid);
        $user->user_status = $request->userstatus;
        $user->ip = $loggedUserIp;
        $submt = $user->save();

        $msg = 'Successfully Suspend User!.Suspend User updated id : ' . $useridhid;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $request->es_email;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
    }
    function AdmCustomerDeletePage(Request $request)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $userid = $request->input('userid');
        $user = UserAccount::find($userid);
        $delteuser = $user->delete();
        $msg = 'User Deleted customer id : ' . $userid;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $user->email;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        if ($delteuser > 0) {
            return response()->json(['result' => 1, 'mesge' => 'Deleted Successfully']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Failed']);
        }
    }


    public function AdmCustomersApprovedAll(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $shopid = $request->input('customerid');
        $shopid_userid = explode('#', $shopid);
        //echo "<pre>";print_r($product_id);exit;
        $toregIDCount = count($shopid_userid);
        $flg = 0;
        for ($i = 1; $i < $toregIDCount; $i++) {
                $shopidexplode = $shopid_userid[$i];
                $shops_user=explode('*',$shopidexplode);
                $shopserviceid=$shops_user[0];
                $user = UserAccount::find($shopserviceid);
                $user->user_status = 'Y';
                $user->save();
                $flg = 1;
            }

        $msg = 'Customer Successfully Activate';
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();

        if ($flg == 1) {
            return response()->json(['result' => 1, 'mesge' => 'Successfully Activated']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Not Activate']);
        }
    }


}
