<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\UserAccount;
use App\Models\LogDetails;
use App\Models\Affiliate;
use App\Models\SellerDetails;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Exception;
use DB;

class SellerController extends Controller
{
    public function sellerdashboard()
    {
        $userRole   = session('user_role');
        $roleid     = session('roleid');
        $userId     = session('user_id');
        if($userId=='')
        {
            return redirect()->route('logout');
        }
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $countShops     = DB::table('user_account')->where('role_id', 2)->where('id', $userId)->count();
        return view('seller.dashboard',compact('userdetails','countShops','userRole','loggeduser'));
    }
}
