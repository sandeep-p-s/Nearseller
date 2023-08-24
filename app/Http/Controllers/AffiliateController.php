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
        $userRole = session('user_role');
        $userId = session('user_id');
        $countries      = DB::table('country')->get();
        return view('affiliate.dashboard',compact('countries'));
    }
}
