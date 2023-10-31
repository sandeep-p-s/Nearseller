<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use App\Models\LogDetails;
use App\Models\OTPGenerate;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserLoggedController extends Controller
{
    function LoggedUserPage(Request $request, $sentoval)
    {
        $log_mobno = urldecode($sentoval);
        $logmobno = base64_decode($log_mobno);
        $valuexplode = explode('-', $logmobno);
        $emlormobno = $valuexplode[0];
        $logtype = $valuexplode[1];

        // if ($logtype == 'mob') {
        //     $userAccount = UserAccount::where('mobno', $emlormobno)->first();
        // } else if ($logtype == 'eml') {
        //     $userAccount = UserAccount::where('email', $emlormobno)->first();
        // }

        if (strpos($emlormobno, '@') !== false) {
            $email = $emlormobno;
            $mobile = null;
            $userAccount = UserAccount::where('email', $email)->first();
        }
        else{
            $email = null;
            $mobile = $emlormobno;
            $userAccount = UserAccount::where('mobno', $mobile)->first();
        }

        if ($userAccount) {

            $role = $userAccount->role->role_name;
            //$roleid = $userAccount->role->id;
            $roleid = $userAccount->role_id;
            //echo "<pre>";print_r($roleid);exit;
            $u_s_name = $userAccount->name;

            session(['user_role' => $role, 'user_id' => $userAccount->id, 'roleid' => $roleid, 'u_s_name' => $u_s_name]);
                return redirect()->route('admin.dashboard');



            // if ($role === 'Super_admin') {
            //     session(['user_role' => $role, 'user_id' => $userAccount->id, 'roleid' => $roleid]);
            //     return redirect()->route('admin.dashboard');

            // } elseif ($role === 'Seller') {
            //     session(['user_role' => $role, 'user_id' => $userAccount->id, 'roleid' => $roleid]);
            //     return redirect()->route('seller.dashboard');

            // } elseif ($role === 'Affiliate') {
            //     session(['user_role' => $role, 'user_id' => $userAccount->id, 'roleid' => $roleid]);
            //     return redirect()->route('affiliate.dashboard');

            // } elseif ($role === 'Customer') {
            //     session(['user_role' => $role, 'user_id' => $userAccount->id, 'roleid' => $roleid]);
            //     return redirect()->route('user.products');

            // } elseif ($role === 'Affiliate_coordinator') {
            //     session(['user_role' => $role, 'user_id' => $userAccount->id, 'roleid' => $roleid]);
            //     return redirect()->route('affiliate_coordinator.dashboard');

            // } elseif ($role === 'Product_adding_executive') {
            //     session(['user_role' => $role, 'user_id' => $userAccount->id, 'roleid' => $roleid]);
            //     return redirect()->route('product_add_executive.dashboard');

            // } elseif ($role === 'HR') {
            //     session(['user_role' => $role, 'user_id' => $userAccount->id, 'roleid' => $roleid]);
            //     return redirect()->route('hr.dashboard');

            // } elseif ($role === 'Shop_coordinator') {
            //     session(['user_role' => $role, 'user_id' => $userAccount->id, 'roleid' => $roleid]);
            //     return redirect()->route('shop_coordinator.dashboard');
            // }
         }
        //else {
        //     return redirect()->route('login');
        // }
    }

    public function logout()
    {
        //Auth::logout();
        Session::flush();
        return redirect('/login');
    }




}
