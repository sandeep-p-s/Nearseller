<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAccount;
use App\Models\LogDetails;
use App\Models\OTPGenerate;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Exception;
use DB;
class UserLoggedController extends Controller
{
    function LoggedUserPage(Request $request, $sentoval)
    {
        $log_mobno = urldecode($sentoval);
        $logmobno = base64_decode($log_mobno);
        $valuexplode = explode('-', $logmobno);
        $emlormobno = $valuexplode[0];
        $logtype = $valuexplode[1];

        if ($logtype == 'mob') {
            $userAccount = UserAccount::where('mobno', $emlormobno)->first();
        } else if ($logtype == 'eml') {
            $userAccount = UserAccount::where('email', $emlormobno)->first();
        }

        if ($userAccount) {

            $role = $userAccount->role->role_name;
            //echo "<pre>";print_r($role);exit;
            // Redirect based on user's role
            if ($role === 'Super_admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'Seller') {
                return redirect()->route('seller.dashboard');
            } elseif ($role === 'affiliate') {
                return redirect()->route('affiliate.dashboard');
            } elseif ($role === 'Customer') {
                return redirect()->route('user.main');
            }
        } else {
            // Handle case when user is not found
            // For example, show an error message or redirect to a general error page
        }

    }
}
