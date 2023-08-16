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
                $valuexplode=explode('-',$logmobno);
                $emlormobno=$valuexplode[0];
                $logtype=$valuexplode[1];
                if($logtype=='mob')
                {
                    $userAccuntData = UserAccount::where('mobno', $emlormobno)->get();
                    foreach ($userAccuntData as $row) {
                        $id = $row->id;
                        $fname = $row->name;
                        $email = $row->email;
                        $mobno = $row->mobno;
                        $user_type = $row->user_type;
                    }


                }
                else if($logtype=='eml')
                {
                    $userAccuntData = UserAccount::where('email', $emlormobno)->get();
                    foreach ($userAccuntData as $row) {
                        $id = $row->id;
                        $fname = $row->name;
                        $email = $row->email;
                        $mobno = $row->mobno;
                    }


                }




            }


}
