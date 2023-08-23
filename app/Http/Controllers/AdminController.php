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
    public function admindashboard()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if($userId=='')
        {
            return redirect()->route('logout');
        }
        if ($userRole === 'Super_admin') {
            $loggeduser='Super Admin';
        } elseif ($userRole === 'Seller') {
            $loggeduser='Seller';
        } elseif ($userRole === 'Affiliate') {
            $loggeduser='Affiliate';
        } elseif ($userRole === 'Customer') {
            $loggeduser='Customer';
        } elseif ($userRole === 'Affiliate_coordinator') {
            $loggeduser='Affiliate Co-ordinator';
        } elseif ($userRole === 'Product_adding_executive') {
            $loggeduser='Product Adding Executive';
        } elseif ($userRole === 'HR') {
            $loggeduser='HR';
        } elseif ($userRole === 'Shop_coordinator') {
            $loggeduser='Shop Co-ordinator';
        }
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $countUsers     = DB::table('user_account')->where('role_id', 4)->count();
        $countAffiliate = DB::table('user_account')->where('role_id', 3)->count();
        $countShops     = DB::table('user_account')->where('role_id', 2)->count();
        return view('admin.dashboard',compact('userdetails','countUsers','countAffiliate','countShops','userRole','loggeduser'));
    }
}
